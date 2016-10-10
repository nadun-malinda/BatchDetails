<?php
//sanitize the user inputs
function sanitize($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);	

	return $data;
}

//validate email address
function validate_email($email) {
	//Remove all illegal characters from email
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);

	//Validate email
	if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		return true; //email is valid

	}else {
		return false; //email is not valid
	}
}

//view all details from the batch_year
function view_details($batch_year) {
	global $link;
	$batch_year = sanitize($batch_year);
	$batch_year = (int)$batch_year;
	$sql = "SELECT * FROM `members` WHERE `batch_year` = '$batch_year' ORDER BY `reg_number` ASC";
	$result = mysqli_query($link, $sql);

	return $result;
}

//view all details from the registration number
function view_details_from_regnumber($reg_number) {
	global $link;
	$reg_number = sanitize($reg_number);
	$sql = "SELECT * FROM `members` WHERE `reg_number` = '$reg_number'";
	$result = mysqli_query($link, $sql);

	$data = mysqli_fetch_assoc($result);
	return $data;
}

//view and order by descending order of distinct batch years
function view_batch() {
	global $link;
	$sql = "SELECT DISTINCT `batch_year` FROM `members` ORDER BY `batch_year` DESC";
	$result = mysqli_query($link, $sql);

	return $result;

}

//count the number of members in a particular batch
function member_count($batch_year) {
	global $link;
	$batch_year = sanitize($batch_year);
	$batch_year = (int)$batch_year;
	$sql = "SELECT DISTINCT `reg_number` FROM `members` WHERE `batch_year` = '$batch_year'";
	$result = mysqli_query($link, $sql);

	$mc = mysqli_num_rows($result);
	return $mc;
}

//count the number of rows in a result set
function row_count($sql) {
	global $link;
	//$sql = "SELECT * FROM `members`";
	$result = mysqli_query($link, $sql);

	$rowcount = mysqli_num_rows($result);
	return $rowcount;
}

//check whether a particular registration number is already exists or not
function user_exists($reg_number) {
	global $link;
	$reg_number = sanitize($reg_number);
	$sql = "SELECT * FROM `members` WHERE `reg_number`= '$reg_number'";
	$result = row_count($sql);

	return $result;
}

//adding a particular member in database - successfull registration
function add_member($reg_number, $name_with_initials, $full_name, $sex, $batch_year, $tp_mobile, $tp_home, $address, $district, $email) {
	global $link;
	$sql = "INSERT INTO `members` (`reg_number`, `name_with_initials`, `full_name`, `sex`, `batch_year`, `tp_mobile`, `tp_home`, `address`, `district`, `email`) VALUES('$reg_number', '$name_with_initials', '$full_name', '$sex', '$batch_year', '$tp_mobile', '$tp_home', '$address', '$district', '$email')";

	mysqli_query($link, $sql);
}

//delete entries from database
function delete_member($reg_number) {
	global $link;
	$sql = "DELETE FROM `members` WHERE `reg_number` = '$reg_number'";

	mysqli_query($link, $sql);
}

//delete entire batch from database
function delete_batch($batch_year) {
	global $link;
	$sql = "DELETE FROM `members` WHERE `batch_year` = '$batch_year'";

	mysqli_query($link, $sql);
}

//update entries of database using registration number
//return true if update is successfull, false otherwise
function update_from_regnumber($reg_number, $name_with_initials, $full_name, $sex, $tp_mobile, $tp_home, $address, $district, $email) {
	$reg_number = sanitize($reg_number);
	$name_with_initials = sanitize($name_with_initials);
	$full_name = sanitize($full_name);
	$tp_mobile = sanitize($tp_mobile);
	$tp_home = sanitize($tp_home);
	$address = sanitize($address);
	$district = sanitize($district);
	$email = sanitize($email);

	global $link;
	$sql = "UPDATE `members` SET `name_with_initials` = '$name_with_initials', `full_name` = '$full_name', `sex` = '$sex', `tp_mobile` = '$tp_home', `tp_home` = '$tp_home', `address` = '$address', `district` = '$district', `email` = '$email' WHERE `reg_number` = '$reg_number'";

	$result = mysqli_query($link, $sql);

	return $result;
}

//add a HTML selecetd field to <select><option> if person is a male. Default is female
function male_or_female($value) {
	$value = strtolower($value);
	$male = "male";
	if($value == $male) {
		echo "selected";
	}
}

//get batch year from url
function batch_year_from_url($url) {
	$basename = basename($url);
	$basename_after_extension = strpbrk($basename, "?");
	$batch_year = substr($basename_after_extension, 1, 4);

	return $batch_year;
}

//get registration number from url
function reg_number_from_url($url) {
	$basename = basename($url);
	$basename_after_extension = strpbrk($basename, "?");
	$reg_number = substr($basename_after_extension, 1, 9);

	return $reg_number;
}

//function for display registration number with slashes (Ex:- FS/2012/555)
function display_regnumber($reg) {
	$institute = substr($reg, 0, 2);
	$batch = substr($reg, 2, 4);
	$number = substr($reg, 6);

	$reg_number = $institute.'/'.$batch.'/'.$number;

	return $reg_number;
}

//function to set registration number without slashes (Ex:- FS2012555)
function remove_slashes_of_regnumber($reg) {
	$institute = substr($reg, 0, 2);
	$batch = substr($reg, 3, 4);
	$number = substr($reg, 8);

	$reg_number = $institute.''.$batch.''.$number;

	return $reg_number;
}

//function for check admin's username
function admin_exists($username) {
	$username = sanitize($username);
	global $link;

	$sql = "SELECT `user_id` FROM `admin` WHERE `username` = '$username'";
	$result = mysqli_query($link, $sql);

	return (mysqli_num_rows($result) == 1) ? true : false;

}

//function for get admin's user_id from username and password combination
function user_id_of_admin($username, $password) {
	$username = sanitize($username);
	$password = md5($password);
	global $link;

	$sql = "SELECT `user_id` FROM `admin` WHERE `username` = '$username' AND `password` = '$password'";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result);

	return $row['user_id'];
}

//function for check username/password combination is correct or not
function login($username, $password) {
	$user_id = user_id_of_admin($username, $password);
	$username = sanitize($username);
	$password = md5($password);
	global $link;

	$sql = "SELECT `user_id` FROM `admin` WHERE `username` = '$username' AND `password` = '$password'";
	$result = mysqli_query($link, $sql);

	return (mysqli_num_rows($result) == 1) ? $user_id : false;
}

//function for loogged_in users
function logged_in() {
	return (isset($_SESSION['user_id'])) ? true : false;
}

//function for get admin's username from user_id
function admin_username_from_user_id($user_id) {
	$user_id = sanitize($user_id);
	global $link;
	$sql = "SELECT `username` FROM `admin` WHERE `user_id` = '$user_id'";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result);

	return $row['username'];
}

//function for get admin's password from user_id
function admin_password_from_user_id($user_id) {
	$user_id = sanitize($user_id);
	global $link;
	$sql = "SELECT `password` FROM `admin` WHERE `user_id` = '$user_id'";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result);

	return $row['password'];
}

// function for update admin's username
function update_admin_username($username) {
	$user_id = $_SESSION['user_id'];
	$username = sanitize($username);
	global $link;
	$sql = "UPDATE `admin` SET `username` = '$username' WHERE `user_id` = '$user_id'";
	$result = mysqli_query($link, $sql);

	return $result;

}

// function for update admin's password
function update_admin_password($password, $ui) {
	//$ui is for user_id
	//this is usefull, when user is not logged in - that means $_SESSION function cannot grab user id
	if(logged_in() === true) {
		$user_id = $_SESSION['user_id'];

	}else {
		$user_id = $ui;

	}

	$password = md5($password);
	global $link;
	$sql = "UPDATE `admin` SET `password` = '$password', `password_recovery` = 0 WHERE `user_id` = '$user_id'";
	$result = mysqli_query($link, $sql);

	return $result;

}

//function for set admin's email
function set_admin_email($email) {
	$email = sanitize($email);
	$user_id = $_SESSION['user_id'];
	global $link;
	$sql = "UPDATE `admin` SET `email` = '$email' WHERE `user_id` = '$user_id'";
	//$sql = "INSERT INTO `admin` (`email`) VALUES('$email')";
	$result = mysqli_query($link, $sql);

	return $result;
}

//function for check whether admin set his email for security purposes
function is_set_admin_email() {
	global $link;
	$user_id = $_SESSION['user_id'];
	$sql = "SELECT `email` FROM `admin` WHERE `user_id` = '$user_id'";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result);

	return ($row['email'] != "") ? true : false;
}

//function for check whether admin email is exists or not
function admin_email_exists($email) {
	$email = sanitize($email);
	global $link;
	$sql = "SELECT `user_id` FROM `admin` WHERE `email` = '$email'";
	$result = mysqli_query($link, $sql);

	return (mysqli_num_rows($result) == 1) ? true : false;
}


//get admin's user_id from admin's email
function user_id_from_admin_email($email) {
	global $link;
	$email = sanitize($email);
	$sql = "SELECT `user_id` FROM `admin` WHERE `email` = '$email'";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result);

	return $row['user_id'];
}

//when password is recoverd throught email, password_recovery field will 1
function is_password_recoverd($user_id) {
	global $link;
	$sql = "SELECT `password_recovery` FROM `admin` WHERE `user_id` = '$user_id'";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result);

	return ($row['password_recovery'] == 1) ? true : false ;

}

//function for recover username and password
function recover($mode, $email) {
	$mode = sanitize($mode);
	$email = sanitize($email);
	$admin_username = admin_username_from_user_id(user_id_from_admin_email($email));

	if($mode == 'username') {
		//recover username
		$subject = "Your Username";
		$body = "Hello Admin.\n\nYour username is : " . $admin_username . "\n\n-BatchDetails";
		mail($email, $subject, $body);

	}else if($mode == 'password') {
		//recover password
		$generated_password = substr(md5(rand(999, 999999)), 0, 8);
		$user_id = user_id_from_admin_email($email);
		update_admin_password($generated_password, $user_id);

		global $link;
		$sql = "UPDATE `admin` SET `password_recovery` = '1' WHERE `user_id` = '$user_id'";
		mysqli_query($link, $sql);

		$subject = "Your Password Recovery";
		$body = "Hello Admin.\n\nYour new password is : " . $generated_password . "\n\n-BatchDetails";
		mail($email, $subject, $body);

	}

}


//remove first zero from tp number
function remove_first_zero($tp_number) {
	$tp_without_zero = substr($tp_number, 1);
	return $tp_without_zero;

}

//validate telephone number
function telephone($tp_number) {
	$length = strlen($tp_number);

	#without zero(ex:- 716547892)
	return ($length != 9) ? false : true;
}

//set active class for current page
function active_page() {
	$current_file = explode('/', $_SERVER['SCRIPT_NAME']);
	$current_file = end($current_file);

	if($current_file == "home.php") {
		return 0;

	}else if($current_file == "change_username.php") {
		return 1;

	}else if($current_file == "change_password.php") {
		return 2;

	}else if($current_file == "about.php") {
		return 3;

	}else if($current_file == "help.php") {
		return 4;

	}
}



/* GENERAL FUNCTIONS */
//output errors
function output_errors($errors) {
	return "<ul class=\"err-ul\"><li>" . implode("</li><li>", $errors) . "</li></ul>";
}

//function for protecting pages from not loggeed in users
function protect_page() {
	if(logged_in() === false) {
		header("Location: protected.php");
		exit();
	}
}

//function for redirect logged in users - this is usefull when logged in user trying to access login page again..
function logged_in_redirect() {
	if(logged_in() === true) {
		header("Location: index.php");
	}
}

//function for redirect users who alredy set admin email to index.php
//this will prevent overwrite admin email again and again
function set_admin_email_redirect() {
	if(is_set_admin_email() === false) {
		header("Location: set_admin_email.php");
	}
}

//check whether user change the default username and password or not
function check_default_credentials() {
	$user_id = $_SESSION['user_id'];
	$username = admin_username_from_user_id($user_id);
	$password = admin_password_from_user_id($user_id);

	$default_username = "username";
	$default_password = md5("password");

	if((strcmp($username, $default_username) == 0) && (strcmp($password, $default_password) == 0)) {
		//user doesn't change default username and password yet
		echo " <div class=\"alert alert-danger\"> ";
		echo "	<a href=\"#\" class=\"close\" data-dismiss=\"alert\" area-label=\"close\">&times;</a> ";
		echo "<strong>You did not change your default credentials yet!</strong>";
		echo "<p>We strongly recommended that, you must change your username and password immediately.</p><br>";
		echo "<a href=\"change_username.php\" class=\"btn btn-warning btn-md\" style=\"margin-right:10px;\"><span class=\"glyphicon glyphicon-pencil\"></span> Change Username</a>";
		echo "<a href=\"change_password.php\" class=\"btn btn-warning btn-md\"><span class=\"glyphicon glyphicon-pencil\"></span> Change Password</a>";
		echo "</div>";

	}else if(strcmp($username, $default_username) == 0) {
		//user doesn't change default username yet
		echo " <div class=\"alert alert-danger\"> ";
		echo "	<a href=\"#\" class=\"close\" data-dismiss=\"alert\" area-label=\"close\">&times;</a> ";
		echo "<strong>You did not change your default credentials yet!</strong>";
		echo "<p>We strongly recommended that, you must change your username immediately.</p><br>";
		echo "<a href=\"change_username.php\" class=\"btn btn-warning btn-md\"><span class=\"glyphicon glyphicon-pencil\"></span> Change Username</a>";
		echo "</div>";

	}else if(strcmp($password, $default_password) == 0) {
		//user doesn't change default password yet
		echo " <div class=\"alert alert-danger\"> ";
		echo "	<a href=\"#\" class=\"close\" data-dismiss=\"alert\" area-label=\"close\">&times;</a> ";
		echo "<strong>You did not change your default credentials yet!</strong>";
		echo "<p>We strongly recommended that, you must change your password immediately.</p><br>";
		echo "<a href=\"change_password.php\" class=\"btn btn-warning btn-md\"><span class=\"glyphicon glyphicon-pencil\"></span> Change Password</a>";
		echo "</div>";

	}
}