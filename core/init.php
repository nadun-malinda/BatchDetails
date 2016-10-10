<?php
session_start();
//error_reporting(0);

require 'database/connect.php';
require 'functions/users.php';

$current_file = explode('/', $_SERVER['SCRIPT_NAME']);
$current_file = end($current_file);

if(logged_in() === true) {
	$user_id = $_SESSION['user_id'];

	if($current_file != "change_password.php" && $current_file != "logout.php" && is_password_recoverd($user_id) === true) {
		header("Location: change_password.php");
		exit();

	}

}
?>