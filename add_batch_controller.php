<?php
require 'core/init.php';
protect_page();

if(isset($_POST) && !empty($_POST)) { //if form is submitted

	if(!empty($_POST['batch_year'])) { //if submited form is not containing an empty value for batch_year
		$batch_year = sanitize($_POST['batch_year']);
		$batch_year = (int)$batch_year;

		if(!filter_var($batch_year, FILTER_VALIDATE_INT) === true) {
			//if input is not an integer
			//$errors[] = "Your input must be an integer (Ex:- 2012)";
			//$err_code[] = 0;
			header("Location: home.php?message=not_integer");

		}else { // if input is an integer - that's what we want
			//check it's length
			//and if no errors, redirect
			if(strlen($batch_year) > 4 || strlen($batch_year) < 4) {
				//$errors[] = "Batch year must contain exactly 4 numbers (Ex:- 2012)";
				//$err_code[] = 1;
				header("Location: home.php?message=exactly_four_digits");

			}else {
				//redirect to add_member page 
				header("Location: add_member.php?$batch_year");

			}

		}


	}else {
		//$errors[] = "You must enter a batch for add a new batch!";
		//$err_code[] = 2;
		header("Location: home.php?message=no_inputs");
	}
	/*
	if(!empty($err_code)) {
		//if there is/are any error(s), redirect to home.php with $errors array
		$errors = http_build_query($err_code);
		header("Location: home.php?$errors"); 

	}
	*/

}else {
	$err_code[] = "Form is not submitted!";
}


/*
if(isset($_POST)) {
	if(!empty($_POST['batch_year'])) {
		$batch_year = sanitize($_POST['batch_year']);
		$batch_year = (int)$batch_year;

		if(filter_var($batch_year, FILTER_VALIDATE_INT) === false) {
			//if input is not an integer
			$errors[] = "Your input must be an integer!";

		}else if(strlen($batch_year) > 4 || strlen($batch_year) < 4){
			$errors[] = "Batch Year Must Exactly Has 4 Numbers. (Ex:- 2014)";

		}
	}else {
		$errors[] = "You Must Enter Batch Year of New Batch!";
	}

	if(empty($errors)) {

		header("Location: add_member.php?$batch_year");
	}else {

		header("Location: home.php?aParam='.$errors");
	}

}
*/
?>