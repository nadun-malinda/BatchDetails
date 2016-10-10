<?php
require 'core/init.php';  

if(logged_in() === true) {
	if(is_set_admin_email()) {
		//if admin already set his email, redirect him to home
		header("Location: home.php");

	}else {
		//if admin not set his email, redirect him to special page for enter email
		header("Location: set_admin_email.php");

	}
	
}else {
	header("Location: login.php");
}
?>