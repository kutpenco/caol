<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/**
 * Classe para conexões com fatura
 * */

class cao_fatura_model extends MY_Model {

	public function cao_fatura() {
		parent::__construct();
		$this->_table      = 'cao_fatura';
		$this->primary_key = 'co_fatura';
		$this->load->library('calendar');
	}

	private function prepare_data() {

		return $this->db
		            ->select("
				              	periodo,
				              	ano_emissao,
				              	mes_emissao,
				              	no_usuario,
				              	receita_liquida,
				              	custo_fixo,
				              	comissao,
				              	lucro")
		->from("view_relatorios");

	}

	private function create_dataset_average($lista_consultores) {

		$obj_dataset  = new stdClass();
		$rs_get_custo = $this->get_avg_custo_fixo($lista_consultores);

		$data = array();

		$epoch_time = strtotime($rs_get_custo->min_ano_emissao."-".$rs_get_custo->min_mes_emissao."-01")*1000;
		$data[]     = array($epoch_time, $rs_get_custo->avg_custo_fixo);

		$last_day_month = date("t", strtotime($rs_get_custo->max_ano_emissao."-".$rs_get_custo->max_mes_emissao."-01"));
		$epoch_time     = strtotime($rs_get_custo->max_ano_emissao."-".$rs_get_custo->max_mes_emissao."-".$last_day_month)*1000;
		$data[]         = array($epoch_time, $rs_get_custo->avg_custo_fixo);

		return $data;

	}

	private function draw_average_line($lista_consultores) {

		$data = $this->create_dataset_average($lista_consultores);

		$obj_graph = new stdClass();

		$obj_points = new stdClass();
		$obj_lines  = new stdClass();

		$obj_lines->show = "true";

		$obj_points->fillColor = "#FF0000";
		$obj_points->show      = true;

		$obj_graph->label  = "Custo Fixo Médio";
		$obj_graph->data   = $data;
		$obj_graph->yaxis  = 2;
		$obj_graph->color  = "#FF0000";
		$obj_graph->points = $obj_points;
		$obj_graph->lines  = $obj_lines;

		return $obj_graph;

	}

	private function get_avg_custo_fixo($lista_consultores) {

		$query = $this->db
		              ->select_avg('custo_fixo', 'avg_custo_fixo')
		              ->select_min('ano_emissao', 'min_ano_emissao')
		              ->select_min('mes_emissao', 'min_mes_emissao')
		              ->select_max('ano_emissao', 'max_ano_emissao')
		              ->select_max('mes_emissao', 'max_mes_emissao')
		              ->where_in("co_usuario", $lista_consultores)
		              ->get('view_relatorios');

		if ($query && $query->num_rows > 0) {
			$row                 = $query->row();
			$row->num_ano        = ceil(($row->max_ano_emissao+$row->max_mes_emissao/12)-($row->min_ano_emissao+$row->min_mes_emissao/12));
			$row->num_meses      = ($row->max_ano_emissao*12+$row->max_mes_emissao)-($row->min_ano_emissao*12+$row->min_mes_emissao);
			$row->avg_custo_fixo = abs($row->avg_custo_fixo);
			return $row;
		}

		return false;

	}

	private function get_max_bar_Y($lista_consultores) {

		$maxY = 0;
		$row  = $this->get_summary_receita($lista_consultores);

		if ($row) {
			$maxY = $row->max_receita_liquida > abs($row->avg_custo_fixo)?$row->max_receita_liquida:abs($row->avg_custo_fixo);

			return $maxY*1.3;
		}

		return false;

	}

	private function validate_data_pie($lista_consultores, $co_usuario, $value) {

		$total_receita = $this->get_summary_receita($lista_consultores);

		$percent = $value/$total_receita->sum_receita_liquida*100;

		return $percent >= 1;

	}

	private function get_summary_receita($lista_consultores) {

		$maxY  = 0;
		$query = $this->db
		              ->select_avg('custo_fixo', 'avg_custo_fixo')
		              ->select_max('receita_liquida', 'max_receita_liquida')
		              ->select_sum('receita_liquida', 'sum_receita_liquida')
		              ->where_in("co_usuario", $lista_consultores)
		              ->get('view_relatorios');

		if ($query && $query->num_rows > 0) {
			return $query->row();
		}

		return false;

	}

	public function get_relatorio_tabela($lista_consultores) {

		$obj_report = new stdClass();

		if ($lista_consultores == null) {
			return false;
		}

		$record_consultores = $this->cao_usuario_model->list_consultor($lista_consultores);

		if ($record_consultores) {

			$month_offset = intval(30/count($record_consultores));

			foreach ($record_consultores as $key => $row) {

				$row->total_receita_liquida = 0;

				$row->total_receita_liquida = 0;
				$row->total_custo_fixo      = 0;
				$row->total_comissao        = 0;
				$row->total_lucro           = 0;

				$query = $this->prepare_data()
				              ->where("co_usuario", $row->co_usuario)
					->order_by("ano_emissao, mes_emissao")
					->get();

				if ($query && $query->num_rows > 0) {

					$row->report_data = $query->result();

					foreach ($row->report_data as $report) {
						$row->total_receita_liquida += $report->receita_liquida;
						$row->total_custo_fixo += $report->custo_fixo;
						$row->total_comissao += $report->comissao;
						$row->total_lucro += $report->lucro;

						// Como o range de funcionários é por mês, a separação de barras sería conforme o dia.
						// Máximo 30 funcionários por mês.

						$last_day_month = date("t", strtotime($report->ano_emissao."-".$report->mes_emissao."-01"));
						$day_offset     = ($key+1)*$month_offset;

						$day_offset = $last_day_month < $day_offset?$last_day_month:$day_offset;

						$report->epoch_time = strtotime($report->ano_emissao."-".$report->mes_emissao."-".$day_offset)*1000;
						$report->human_time = $report->ano_emissao."-".$report->mes_emissao."-".$day_offset;

					}

				} else {
					$row->report_data = false;
				}

			}

			$obj_report->dataset = $record_consultores;
			$obj_report->offset  = $month_offset;
			$obj_report->maxY    = 0;

			return $obj_report;
		}

		return false;

	}

	public function get_relatorio_grafico($lista_consultores) {

		$obj_graph = new stdClass();
		$json      = "";

		$report = $this->get_relatorio_tabela($lista_consultores);

		if ($report) {

			$records = $report->dataset;

			foreach ($records as $key => $row) {

				if ($row->report_data) {
					if ($key > 0 && $json != "") {
						$json .= ",";
					}

					$obj_graph = new stdClass();

					$obj_graph->label           = $row->no_usuario;
					$obj_graph->data            = array();
					$obj_graph->bars            = new stdClass();
					$obj_graph->bars->show      = true;
					$obj_graph->bars->align     = "right";
					$obj_graph->bars->barWidth  = 24*60*60*600*($report->offset-1);
					$obj_graph->bars->lineWidth = "1";

					foreach ($row->report_data as $field => $details) {

						$obj_graph->data[] = array(
							$details->epoch_time, floatval($details->receita_liquida),
						);

					}

					$json .= json_encode($obj_graph);

				}

			}

			if ($json != "") {
				$json .= ",";
			}

			$line_custo_medio = $this->draw_average_line($lista_consultores);

			$json .= json_encode($line_custo_medio);

			$obj_graph->dataset = $json;
			$obj_graph->maxY    = $this->get_max_bar_Y($lista_consultores);

		} else {
			$obj_graph->dataset = false;
			$obj_graph->maxY    = 0;
		}

		return $obj_graph;

	}

	public function get_relatorio_pizza($lista_consultores) {

		$obj_graph = new stdClass();
		$json      = "";

		$report = $this->get_relatorio_tabela($lista_consultores);

		if ($report) {

			$records = $report->dataset;

			foreach ($records as $key => $row) {

				if ($row->report_data) {
					if ($key > 0 && $json != "") {
						$json .= ",";
					}

					$obj_graph = new stdClass();

					$obj_graph->label = $row->no_usuario;
					$obj_graph->data  = 0;

					foreach ($row->report_data as $field => $details) {

						$obj_graph->data += floatval($details->receita_liquida);

					}

					// Selecionar dados para o gráfico que sejam maiores ou iguais a 1%
					if ($this->validate_data_pie($lista_consultores, $row->co_usuario, $obj_graph->data)) {
						$json .= json_encode($obj_graph);
					}

				}

			}

			$obj_graph->dataset = $json;
			$obj_graph->maxY    = 0;
		} else {
			$obj_graph->dataset = false;
			$obj_graph->maxY    = 0;
		}

		return $obj_graph;

	}

	public function get_relatorio_consultor($lista_consultores, $tipo_relatorio) {

		switch ($tipo_relatorio) {
			case 'report':
				return $this->get_relatorio_tabela($lista_consultores);
				break;
			case 'chart':
				return $this->get_relatorio_grafico($lista_consultores);
				break;
			case 'pie':
				return $this->get_relatorio_pizza($lista_consultores);
				break;
		}
	}

}
