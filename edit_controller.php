<?php
require 'core/init.php'; 
protect_page();

if(isset($_POST)) {
	$reg_number = remove_slashes_of_regnumber($_POST['reg_number']);
	$name_with_initials = $_POST['name_with_initials'];
	$full_name = $_POST['full_name'];
	$sex = $_POST['sex'];
	$batch = $_POST['batch'];
	$tp_mobile = $_POST['mobile_number']; 
	$tp_home = $_POST['home_number'];
	$address = $_POST['address'];
	$district = $_POST['district'];
	$email = $_POST['email'];

	$message_success = "updatesuccess";
	$message_fail = "updatefail";
	$redirect_success = "batch.php?$batch&$message_success";
	$redirect_fail = "edit.php?$reg_number&$message_fail";


	$result = update_from_regnumber($reg_number, $name_with_initials, $full_name, $sex, $tp_mobile, $tp_home, $address, $district, $email); 

	if($result) {
		//redirect when success
		header("Location: $redirect_success");
	}else {
		//redirect when fails
		header("Location: $redirect_fail");
	}
}

?>