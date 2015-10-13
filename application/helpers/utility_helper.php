<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

if (!function_exists('make_tiny()')) {

	function make_tiny($url) {
		$ch      = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, 'http://tinyurl.com/api-create.php?url='.$url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

}

if (!function_exists('tiny_site_url()')) {

	function tiny_site_url() {
		echo make_tiny(current_url());
	}

}

//Debug variable function
if (!function_exists('var_dump_pretty()')) {
	function var_dump_pretty($value, $exit = true) {

		echo '<pre>';
		var_dump($value);
		echo '</pre>';
		if ($exit) {
			exit();
		}

	}
}

//Get Default Profile Picture
if (!function_exists('get_no_profile_picture()')) {

	function get_no_profile_picture($gender) {

		$no_profile_pic = "assets/img/no-profile-picture-";

		switch ($gender) {
			case 'M':
				$no_profile_pic .= "male.jpg";
				break;
			case 'F':
				$no_profile_pic .= "female.jpg";
				break;
			default:
				$no_profile_pic .= "neutral.jpg";
				break;
		}

		return base_url($no_profile_pic);

	}

}

//Store Session Info
if (!function_exists('set_session_user()')) {

	function set_session_user($username, $userObj) {

		$CI = get_instance();

		$data_user["username"]  = $username;
		$data_user["fullname"]  = $userObj->no_usuario;
		$data_user["firstname"] = strpos($userObj->no_usuario, ' ') !== false?substr($userObj->no_usuario, 0, strpos($userObj->no_usuario, " ")):$$userObj->no_usuario;
		$data_user["picture"]   = $userObj->url_foto;
		$data_user["iduser"]    = 0;

		$CI->session->set_userdata('user', $data_user);

	}

}

//Store previous URL in a cookie
if (!function_exists('store_prev_url_cookies()')) {

	function store_prev_url_cookies() {

		$CI = get_instance();

		$prev_url = $CI->input->cookie('agence_prev_url', TRUE);

		if ($prev_url === false) {

			$CI->load->library('user_agent');

			$prev_url = $CI->agent->is_referral()?$CI->agent->referrer():'home';
			$prev_url = str_replace("==", "", $prev_url);

			$cookie = array(
				'name'   => 'prev_url',
				'value'  => base64_encode($prev_url),
				'expire' => '86500',
				'prefix' => 'agence_',
			);

			$CI->input->set_cookie($cookie);
		}

		return base64_encode($prev_url);
	}

}

//Read previous URL in a cookie
if (!function_exists('read_prev_url_cookie()')) {

	function read_prev_url_cookies() {

		$CI = get_instance();

		$hash_url = $CI->input->cookie('agence_prev_url', TRUE);

		if ($hash_url === false) {
			return base_url();
		}

		//Delete cookie
		delete_cookie('agence_prev_url');

		return base64_decode($hash_url);
	}

}

//Save custom values to cookies
if (!function_exists('set_custom_cookie()')) {

	function set_custom_cookie($name, $value) {

		$CI = get_instance();

		$cookie = array(
			'name'   => $name,
			'value'  => $value,
			'expire' => '600',
			'prefix' => 'agence_',
		);

		$CI->input->set_cookie($cookie);

	}

}

//Get Month name list for SELECT Tag HTML.
if (!function_exists('list_month_name()')) {

	function list_month_name() {

		$CI   = get_instance();
		$html = "";

		for ($i = 1; $i <= 12; $i++) {
			$html .= '<option value="'.sprintf("%02d", $i).'">'.
			$CI->calendar->get_month_name(sprintf("%02d", $i)).
			'</option>';
		}
		echo $html;
	}

}

//Get Month name list for SELECT Tag HTML.
if (!function_exists('list_future_years()')) {

	function list_future_years() {

		$CI       = get_instance();
		$html     = "";
		$cur_year = date("Y", $CI->calendar->local_time);

		for ($i = $cur_year; $i <= $cur_year+10; $i++) {
			$html .= '<option value="'.sprintf("%04d", $i).'">'.
			sprintf("%04d", $i).
			'</option>';
		}
		echo $html;
	}

}

//Get Month name list for SELECT Tag HTML.
if (!function_exists('list_countries()')) {

	function list_countries() {

		$CI        = get_instance();
		$countries = $CI->geography_model->get_countries();
		$html      = "";

		foreach ($countries as $country) {
			$html .= '<option value="'.$country->country_id.'">'.
			$country->country_name.
			'</option>';
		}
		echo $html;
	}

}

//Setup Pagination
if (!function_exists('_setup_pager()')) {

	function setup_pager($current_page, $num_pages, $page_select_lenght) {

		// Keep in mind the current page number will be in the middle of buttonset
		// To calculate the middle, simply we shift the bits to the left to divide between 2
		$middle = $page_select_lenght >> 1;

		// Calculate page number to the left
		$minimum_page = $current_page-$middle;

		// Calculate page number to the right, using shifting method to divide between 2
		$maximum_page = $middle+$current_page;

		$show_first_page_link = true;
		$show_last_page_link  = true;

		if ($minimum_page <= 1) {
			$minimum_page         = 1;
			$show_first_page_link = false;
		}

		if ($maximum_page < $page_select_lenght || $maximum_page > $num_pages-1) {
			$maximum_page        = $num_pages;
			$show_last_page_link = false;
		} else {
			$maximum_page = $page_select_lenght;

		}

		//Create the object with calculated values.
		$obj                       = new stdClass();
		$obj->minimum_page         = $minimum_page;
		$obj->maximum_page         = $maximum_page;
		$obj->current_page         = $current_page;
		$obj->show_first_page_link = $show_first_page_link;
		$obj->show_last_page_link  = $show_last_page_link;

		return $obj;

	}

}

if (!function_exists('get_query_string()')) {

	function get_url_string() {

		$q_string = "&";
		$CI       = get_instance();

		$get_vars = $CI->input->get();

		if ($get_vars) {
			foreach ($get_vars as $key => $value) {
				if ($key != "page" && $value != "") {
					$q_string .= $key."=".urlencode($value)."&";
				}

			}

			return rtrim($q_string, "&");
		}

		return "";

	}

}

if (!function_exists('load_modal_html()')) {
	function load_modal_html() {

		echo '
<!-- Modal Dialog -->
<div class="form-horizontal modal fade" id="modalPermissions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="modalTitle">Mercados Autorizadas</h4>
      </div>
      <div class="modal-body">
        <form class="form-inline" role="form">
          <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	            <div class="input-group">
		            <input type="text" class="form-control" id="filterDataPerm" placeholder="Filtrar Mercados">
		            <span class="input-group-btn">
		          		<button class="btn btn-success" type="button">Buscar</button>
		        	</span>
	        	</div>
        	</div>

          </div>

          <div class="form-group">
            <div class="col-md-offset-2 col-md-8" id = "dataPopulated">
	        <!-- Data popuplated here -->
        	</div>

          </div>

        </form>

		  <nav>
		    <ul class="pagination">
		      <li><a href="#"><span aria-hidden="true">«</span><span class="sr-only">Anterior</span></a></li>
		      <li class="active"><span>1 <span class="sr-only">(current)</span></span></li>
		      <li><a href="#">2</a></li>
		      <li><a href="#">3</a></li>
		      <li><a href="#">4</a></li>
		      <li><a href="#">5</a></li>
		      <li><a href="#"><span aria-hidden="true">»</span><span class="sr-only">Seguinte</span></a></li>
		    </ul>
		  </nav>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success">Ok</button>
      </div>
    </div>
  </div>
</div> <!-- Modal Markets-->


			';

	}
}
