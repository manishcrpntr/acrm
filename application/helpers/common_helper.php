<?php

function report_error(){
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
}

function pr($data,$die=1){
	print_r("<pre>");
	print_r($data);
	if($die==1){
		die;
	}
}
function last_query($die=0){
	print_r("<pre>");
	$ci=& get_instance();
	echo $ci->db->last_query();
	if($die==1){
		die;
	}
}

function no_form_input_specified($get_post_data){
	if(!isset($get_post_data) || $get_post_data=="" || empty($get_post_data)){
		redirect("/home");
	}
}

function generate_random_string($len = 10,$without_time = 0){
	$characters = '01234abcdefghizABCDZ0123EFGHIJKLMNOPQRSTjklmn56789opqrstuvwxyUVWXY456789';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $len; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	if($without_time == 0){
		return $randomString."-".strtotime("now");
	} else {
		return $randomString;
	}
}


function generate_strong_password($len = 8){
	$character_set_array = array(
		array('count' => 5, 'characters' => 'abcdefghijklmnopqrstuvwxyz'),
		array('count' => 2, 'characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'),
		array('count' => 2, 'characters' => '0123456789'),
		array('count' => 1, 'characters' => '-)(!@#$<>:="?{}~'),
	);
	$temp_array = array();
	foreach ($character_set_array as $character_set) {
		for ($i = 0; $i < $character_set['count']; $i++) {
			$temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
		}
	}
	shuffle($temp_array);
	return implode('', $temp_array);
}

function check_session(){
	$obj =& get_instance();
	if($obj->session->userdata('logged_in')==''){
		$returnURL = "";
		$uri_segment = $obj->uri->segment(1);
		if($uri_segment!="home"){
			$urldata = $obj->uri->segment_array();
			$urldata =  implode("/",$urldata);
			$returnURL = '?return_url='.$urldata;
		} 
		redirect("home/login".$returnURL);
	}
}

function upload_images($filename = null, $folder_name){
	$min_width = 400;
	$min_height = 400;
	$obj =& get_instance();
	$videoExts = allowed_image_ext();	  
	$name = $_FILES[$filename]['name'];
	$tmp_name = $_FILES[$filename]['tmp_name'];
	$ext = pathinfo($name,PATHINFO_EXTENSION);

    $rand = generateRandomStr();
	$renamedfile = $rand.".".$ext;
	$target_path = UPLOAD_IMAGES."$folder_name/".$renamedfile;
	if(move_uploaded_file($tmp_name,$target_path))	{
		resize_image($target_path, $min_width, $min_height );
		return trim($target_path);
	}
}

function cal_date_diff($date1,$date2 = null){
	$obj =& get_instance();
	$obj->load->database();
	if($date2 == NULL){
		$date2 = date("Y-m-d");
	}
	$sql_string = "SELECT DATEDIFF('$date1','$date2') AS DiffDate";
	$query_row =  $obj->db->query($sql_string)->row_array();
	$diff = $query_row['DiffDate'];
	return $diff;
	
}

function generate_drop_down($value, $text, $table, $type='html',$selected_value=null){
	$obj =& get_instance();
	$obj->load->database();
	$query = $obj->db->query("SELECT $value, $text FROM $table");
	if($query->num_rows() > 0)	{
		$output = "";
		foreach($query->result_array() as $table_data){
			if($type == 'html'){
				
				$selected="";
				if($selected_value == $table_data[$value]){
					$selected = 'selected';
				}
				$output.='<option value="'.$table_data[$value].'" '.$selected.'>'.ucfirst($table_data[$text]).'</option>';
			} else {
				$output[$table_data[$value]] = ucfirst($table_data[$text]);
			}
			
		}
		return $output;
	} else {
		return 0;
	}
}

function get_company_list($type, $selected_value = NULL){
	return generate_drop_down('id', 'company_name', 'companies', $type,$selected_value);
}

function get_user_role_list($type, $selected_value = NULL){
	return generate_drop_down('id', 'name', 'user_roles', $type,$selected_value);
}

function get_target_duration_list($type, $selected_value = NULL){
	return generate_drop_down('id', 'name', 'target_duration', $type,$selected_value);
}

function get_subscription_plan_list($type, $selected_value = NULL){
	return generate_drop_down('id', 'name', 'subscription_plan', $type,$selected_value);
}

function get_sales_stages_list($type, $selected_value = NULL){
	return generate_drop_down('id', 'name', 'sales_stages', $type,$selected_value);
}

function active_inactive_dp($type="html", $selectedstats = null ){
	$array = array(
		"1"=>"Active",
		"2"=>"Suspended",
	);
	$html = "";
	if($type=="html"){
		foreach($array as $key => $value){
			$selected = "";
			if($key == $selectedstats && $selectedstats!=""){
				$selected = 'selected';
			}
			$html .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
		}
		return $html;
	} else {
		return $array;
	}
}

function generate_table_head($array = ""){
	$html = "<tr>";
	foreach($array as $key => $inner_array){
		$class = ' class="'.$inner_array['class'].'"';
		$html .= '<th'.$class.'>'.$inner_array['col'].'</th>'."\n";
	}
	$html .= "</tr>";
	return $html;
}

function aes_encrypt($string) {
	$output = false;
	$output = base64_encode(@openssl_encrypt($string, ENCRYPTION_METHOD, SECRET_KEY));    
	return $output;
}

function aes_decypt($string) {
	$output = false;
	$output = base64_decode($string);
	$output = @openssl_decrypt($output, ENCRYPTION_METHOD, SECRET_KEY);
	return $output;
}


function load_required_js($page_name){
	$js_list =  array(
		"dashboard" => array('dashboard_activity.js'),
		"setting" => array('settings_page.js'),
		"sidebar" => array('sidebar_activities.js'),
		"company" => array('company.js'),
		"user" => array('user.js'),
		
	);
	return $js_list[$page_name];
}


?>