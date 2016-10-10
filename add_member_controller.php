<?php
require 'core/init.php';
protect_page();

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(!empty($_POST['batch'])) {
		$batch_year = $_POST['batch'];
	}
	
	if(empty($_POST['reg_number'])) {
		$errors[] = "Registration Number is Required!";
		//$errors[] = 0;

	}else if(user_exists($_POST['reg_number']) > 0) {
		$errors[] = "Registration number is allready exists!";
		//$errors[] = 1;

		} else {
			$reg_number_prefix = "FS$batch_year";
			$reg_number = $reg_number_prefix.''.sanitize($_POST['reg_number']);
	}

	if(empty($_POST['name_with_initials'])) {
		$errors[] = "Name With Initials is Required!";
		//$errors[] = 2;

	}else {
		$name_with_initials = sanitize($_POST['name_with_initials']);
	}

	if(empty($_POST['full_name'])) {
		$errors[] = "Full Name is Required!";
		//$errors[] = 3;

	}else {
		$full_name = sanitize($_POST['full_name']);
	}

	if(isset($_POST['sex'])) {
		$sex = $_POST['sex'];
	}

	if(empty($_POST['mobile_number'])) {
		$errors[] = "Your Mobile Number is Required!";
		//$errors[] = 4;

	}else {
		$tp_mobile = sanitize($_POST['mobile_number']);
		$tp_mobile = remove_first_zero($tp_mobile);

		if(filter_var($tp_mobile, FILTER_VALIDATE_INT) === false) {
			$errors[] = "Mobile Telephone number must contain only numbers!";

		}else if(telephone($tp_mobile) === false) {
			$errors[] = "Mobile Telephone number must contain exactly 10 digits!";

		}

	}

	if(isset($_POST['home_number'])) {
		$tp_home = sanitize($_POST['home_number']);
		$tp_home = remove_first_zero($tp_home);

		if(filter_var($tp_home, FILTER_VALIDATE_INT) === false) {
			$errors[] = "Home Telephone number must contain only numbers!";

		}else if(telephone($tp_home) === false) {
			$errors[] = "Home Telephone number must contain exactly 10 digits!";

		}
	}

	if(empty($_POST['address'])) {
		$errors[] = "Your Address is Required!";
		//$errors[] = 5;

	}else {
		$address = sanitize($_POST['address']);

	}

	if(isset($_POST['district'])) {
		$district = sanitize($_POST['district']);

	}

	if(empty($_POST['email'])) {
		$errors[] = "Your Email is Required!";
		//$errors[] = 6;

	}else {
		//$email = sanitize($_POST['email']);
		if(validate_email($_POST['email'])) {
			$email = $_POST['email'];

		}else {
			$errors[] = "Email is not valid!";

		}

	}

}

$redirect_url = "batch.php?$batch_year";

if(isset($_GET['success']) && empty($_GET['success'])) {
	echo "You have been registerd successfully!";

}else {
	if(empty($_POST) === false && empty($errors) === true) {
		$tp_mobile = sanitize($_POST['mobile_number']);
		$tp_home = sanitize($_POST['home_number']);
		add_member($reg_number, $name_with_initials, $full_name, $sex, $batch_year, $tp_mobile, $tp_home, $address, $district, $email);
		//redirect
		header("Location: $redirect_url?success");
		echo "<h2>Congratz!</h2>";

	}else if(empty($errors) === false) {
		echo output_errors($errors);
		echo "<br>Go back and fill all details..!";
	}
}

?>