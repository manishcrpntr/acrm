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

function check_session($user_type = NULL){
	$obj =& get_instance();
	if($obj->session->userdata('logged_in')==''){
		$returnURL = "";
		$uri_segment = $obj->uri->segment(1);
		if($uri_segment!="home"){
			$urldata = $obj->uri->segment_array();
			$urldata =  implode("/",$urldata);
			$returnURL = '?return_url='.$urldata;
		} 
		$url = "";
		if($user_type == ""){
			$url = "user/login".$returnURL;
		} else {
			$url  = "$user_type/login".$returnURL;
		}
		redirect($url);
	}
}

function allowed_video_ext(){
	return array("mp4",'3gp','avi','mov','mpeg');
}

function allowed_image_ext(){
	return array('jpg','jpeg','gif','bmp','png','');
}

function upload_images($filename = null, $folder_name){
	$min_width = 400;
	$min_height = 400;
	$obj =& get_instance();
	$videoExts = allowed_image_ext();	  
	$name = $_FILES[$filename]['name'];
	$tmp_name = $_FILES[$filename]['tmp_name'];
	$ext = pathinfo($name,PATHINFO_EXTENSION);

    $rand = generate_random_string();
	$renamedfile = $rand.".".$ext;
	$target_path = UPLOAD_IMAGES."$folder_name/".$renamedfile;
	if(move_uploaded_file($tmp_name,$target_path))	{
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
			} 
			else if($type == 'special'){
				$output[$table_data[$value]] = $table_data;
			}
			else {
				$output[$table_data[$value]] = ucfirst($table_data[$text]);
			}
			
		}
		return $output;
	} else {
		return 0;
	}
}

function user_list_role_wise($userId,$companyId,$user_role_id,$selected_value=null)
{
	$obj =& get_instance();
	$obj->load->database();

	$data = array();
    if($user_role_id == 1)
    {
        $obj->db->select("u.id, CONCAT(`u`.`first_name`,' ',`u`.`last_name`) as `empname`,`ur`.`name` as `role`,`ur`.`id` as `role_id`");
		$obj->db->from('users as u');
		$obj->db->where(array('u.status' => '1', 'u.is_deleted' => '0', 'u.id !=' => $userId, 'u.company_id'=> $companyId));
        $obj->db->join('user_roles as ur', 'ur.id=u.user_role_id', 'left');
        $obj->db->order_by("ur.id", "asc");
		$result = $obj->db->get() or die( 'MySQL Error: ' . $obj->db->_error_number()); 
        $data = $result->result_array();
    
    }
    else
    {
        $obj->db->select("u.id, CONCAT(`u`.`first_name`,' ',`u`.`last_name`) as `empname`,`ur`.`name` as `role`,`ur`.`id` as `role_id`");
		$obj->db->from('users as u');
		$obj->db->where(array('u.status' => '1', 'u.is_deleted' => '0', 'u.id !=' => $userId, 'u.reports_to_user_id' => $userId, 'u.company_id'=> $companyId));
        $obj->db->join('user_roles as ur', 'ur.id=u.user_role_id', 'left');
        $obj->db->order_by("ur.id", "asc");
		$result = $obj->db->get() or die( 'MySQL Error: ' . $obj->db->_error_number()); 
        $data = $result->result_array();
    }

	$obj->db->select("u.id, CONCAT(`u`.`first_name`,' ',`u`.`last_name`) as `empname`,`ur`.`name` as `role`,`ur`.`id` as `role_id`");
	$obj->db->from('users as u');
	$obj->db->where(array('u.status' => '1', 'u.is_deleted' => '0', 'u.id' => $userId, 'u.company_id'=> $companyId));
    $obj->db->join('user_roles as ur', 'ur.id=u.user_role_id', 'left');
    $obj->db->order_by("ur.id", "asc");
	$result = $obj->db->get() or die( 'MySQL Error: ' . $obj->db->_error_number()); 
    $owndetail = $result->result_array();

    $data = array_merge($data,$owndetail);

    $user_role_wise = array();

    if(isset($data) && !empty($data))
    {
        foreach ($data as $key => $value) 
        {
            $user_role_wise[$value['role_id']][] = $value;
        }
    }

	$html = '';
    if(isset($user_role_wise['2']) && !empty($user_role_wise['2']))
    {
        $html .='<optgroup label="Resional Managers">';
        foreach ($user_role_wise['2'] as $rmkey => $rmvalue) 
        {
        	$selected="";
			if($selected_value == $rmvalue['id']){
				$selected = 'selected';
			}
            $html .='<option value="'.$rmvalue['id'].'" '.$selected.'>'.$rmvalue['empname'].' ('.$rmvalue['role'].')</option>';
        }
        $html .='</optgroup>';
    }

    if(isset($user_role_wise['3']) && !empty($user_role_wise['3']))
    {
        $html .='<optgroup label="Team Leaders">';
        foreach ($user_role_wise['3'] as $tlkey => $tlvalue) 
        {
        	$selected="";
			if($selected_value == $tlvalue['id']){
				$selected = 'selected';
			}
            $html .='<option value="'.$tlvalue['id'].'" '.$selected.'>'.$tlvalue['empname'].' ('.$tlvalue['role'].')</option>';
        }
        $html .='</optgroup>';
    }

    if(isset($user_role_wise['4']) && !empty($user_role_wise['4']))
    {
        $html .='<optgroup label="Other Users">';
        foreach ($user_role_wise['4'] as $ukey => $uvalue) 
        {
        	$selected="";
			if($selected_value == $uvalue['id']){
				$selected = 'selected';
			}
            $html .='<option value="'.$uvalue['id'].'" '.$selected.'>'.$uvalue['empname'].' ('.$uvalue['role'].')</option>';
        }
        $html .='</optgroup>';
    }
    return $html;
}

function get_lead_source($result_type=null)
{
	$lead_source = array('1'=> 'Cold Call','2'=> 'Existing Customer','3'=> 'Self Generated','4'=> 'Employee','5'=> 'Partner','6'=> 'Public Relation','7'=> 'Direct Mail','8'=> 'Conference','9'=> 'Trade Show','10'=> 'Web Site','11'=> 'Worth Of Mouth');
	$output = '';
	if($result_type == 'select')
	{
		foreach ($lead_source as $key => $value) 
		{
			$output .= '<option value="'.$key.'">'.$value.'</option>';
		}
	}
	else
	{
		if(count($lead_source[$result_type])>0)
		{
			$output .= $lead_source[$result_type];
		}
	}

	return $output;
}

function get_opportunity_type($result_type=null)
{
	$oppr_type = array('1'=> 'New Business','2'=> 'Existing Business');

	$output = '';
	if($result_type == 'select')
	{
		foreach ($oppr_type as $key => $value) 
		{
			$output .= '<option value="'.$key.'">'.$value.'</option>';
		}
	}
	else
	{
		if(count($oppr_type[$result_type])>0)
		{
			$output .= $oppr_type[$result_type];
		}
	}
	return $output;
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

function get_sales_stages_list_with_prob($type, $selected_value = NULL){
	return generate_drop_down('id', 'name,probability', 'sales_stages', $type,$selected_value);
}

function get_uom_list($type, $selected_value = NULL){
	return generate_drop_down('code', 'name', 'uom', $type,$selected_value);
}

function get_account_number($type, $selected_value = NULL){
	return generate_drop_down('id', 'code', 'uom', $type,$selected_value);
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
		"items" => array('items.js'),
		"item_service" => array('item_service_module.js'),
		"sales" => array('sales_module.js'),
		"account" => array('account.js'),
		"contact" => array('contact.js'),
		"lead" => array('lead.js'),
		"opportunity" => array('opportunity.js'),
		"target" => array('target.js')
	);
	return $js_list[$page_name];
}

function convert_db_date_time($date){
	return date(DISPLAY_FORMAT,strtotime($date));
}

function get_only_date($date){
	return date(DISPLAY_DATE_FORMAT,strtotime($date));
}

function truncated_string($string,$len) {
 if(strlen($string)>$len) {
  $new = substr($string, 0,$len);
  $new .= ". . ."; 
 } else {
  $new = $string; 
 }
 return $new;
}

function get_all_email_templates($type, $selected_value = NULL ){
	return generate_drop_down('template_key', 'subject', 'email_template', $type,$selected_value);
}

function get_company_email_templates($type, $selected_value = NULL ){
	$obj =& get_instance();
	$obj->load->database();
	$obj->sessionData = $obj->session->userdata();
	$logged_in_company = $obj->sessionData['company_id'];
	$value = "template_key";
	$text = "subject";
	$query = $obj->db->query("SELECT $value, $text FROM company_email_templates WHERE company_id = '$logged_in_company'" );
	if($query->num_rows() > 0)	{
		$output = "";
		foreach($query->result_array() as $table_data){
			if($type == 'html'){
				
				$selected="";
				if($selected_value == $table_data[$value]){
					$selected = 'selected';
				}
				$output.='<option value="'.$table_data[$value].'" '.$selected.'>'.ucfirst($table_data[$text]).'</option>';
			} 
			else if($type == 'special'){
				$output[$table_data[$value]] = $table_data;
			}
			else if($type == 'data'){
				$output[$table_data[$value]] = ucfirst($table_data[$text]);
			}
			
		}
		return $output;
	} else {
		return 0;
	}

}

function generate_new_company_templates($company_id){
	$obj =& get_instance();
	$obj->load->database();
	$raw_query = "SELECT * FROM email_template WHERE is_global= 0 AND status = 1 AND is_deleted = 0";
	$res = $obj->db->query($raw_query);
	if($res->num_rows() > 0){
		$output = "";
		foreach($res->result_array() as $table_data){
			$output = $table_data;
			unset($output['id']);
			unset($output['is_global']);
			$output['company_id'] = $company_id;
			$data = $obj->db->insert("company_email_templates", $output);
		}
	} else {
		return 0;
	}
	
}


function get_all_email_template_constants(){
	$constants =  array(
		"{{base_url}}"=>"Application Path",
		"{{app_name_full}}"=> "Application Full Name",
		"{app_name_short}} "=>"Application Short Name ",
		"{{company_name}}"=>"Company Name",
		"{{user_full_name}}"=>"User Full Name",
		"{{user_first_name}}"=>"User First Name",
		"{{user_last_name}}"=>"User Last Name",
		"{{user_id}}"=> "User Login ID",
		"{{user_email}}"=> "User Email ID",
		"{{password}}"=>"Current Non Encrypted Password ",
		"{{employee_name}}"=>"Employee Name",
		"{{employee_email}}"=>"Employee Email",
		"{{new_random_password}}"=>"New Generated Password",
	);
	
	return $constants;
}

function get_current_user_id(){
	$obj =& get_instance();
	$sessionData = $obj->session->userdata();
	return (isset($sessionData['logged_in']) && $sessionData['logged_in']!="") ? $sessionData['logged_in'] : 0;
}

function get_current_company(){
	$obj =& get_instance();
	$sessionData = $obj->session->userdata();
	return (isset($sessionData['company_id']) && $sessionData['company_id']!="") ? $sessionData['company_id'] : 0;
}

function get_service_items($array_name = NULL , $all_data = 0, $type = 'array'){
	$json_data = file_get_contents('assets/data/item_service_options.json');
	$json_obj = json_decode($json_data, true);
	
	if($all_data == 1 || $array_name== ""){
		return $json_obj;	
	} else {
		$data = $json_obj[$array_name] ;
		if($type == 'array'){
			return $data;
		} else if($type == 'html_options'){
			$html_options = '';
			foreach( $data as $key => $inner_array ){
				$html_options .= '<option value="'.$inner_array['id'].'">'.$inner_array['value'].'</option>';
			}
			return $html_options;
		}
	}
}


function get_global_settings($specfic_setting = null){
	$obj =& get_instance();
	$obj->load->database();
	$specific_setting_where = "";
	if($specfic_setting != ""){
		$specific_setting_where = " AND name='$specfic_setting'";
	}
	
	$raw_query = "SELECT name, sys_value FROM system_settings WHERE status = 1 and is_deleted = 0  $specific_setting_where";
	$res = $obj->db->query($raw_query);
	if($res->num_rows() > 0){
		$output = [];
		foreach($res->result_array() as $settings){
			$output[$settings['name']] = $settings['sys_value'];
		}
		return $output;
	} else {
		return 0;
	}
}

?>