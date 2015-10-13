<?php //var_dump_pretty($relatorio);?>
<?php if ($relatorio):?>
<div class="row">
	<div class="col-xs-12">
<?php foreach ($relatorio as $row):?>
		<h2><?=$row->no_usuario;?></h2>

		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Período</th>
						<th>Receita Líquida</th>
						<th>Custo Fixo</th>
						<th>Comissão</th>
						<th>Lucro</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td>Total</td>
						<td class="currency"><?=$row->total_receita_liquida;?></td>
						<td class="currency"><?=$row->total_custo_fixo;?></td>
						<td class="currency"><?=$row->total_comissao;?></td>
						<td class="currency"><?=$row->total_lucro;?></td>
					</tr>
				</tfoot>
				<tbody>
<?php foreach ($row->report_data as $report):?>
<tr>
						<td><?=$report->periodo;?></td>
						<td class="currency"><?=$report->receita_liquida;?></td>
						<td class="currency"><?=$report->custo_fixo;?></td>
						<td class="currency"><?=$report->comissao;?></td>
						<td class="currency"><?=$report->lucro;?></td>
					</tr>

<?php endforeach;?>
</tbody>
			</table>
		</div>

<?php endforeach;?>
</div>
	<!-- /.row -->
</div>
<script src="<?=base_url('assets/js/autonumeric-helper.js');?>"></script>
<?php endif;?>