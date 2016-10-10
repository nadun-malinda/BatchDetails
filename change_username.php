<?php
require 'core/init.php'; 
protect_page();
set_admin_email_redirect(); 
$user_id = $_SESSION['user_id'];

if(isset($_POST)) {
	if(!empty($_POST)) {
		$current_username = $_POST['current_username'];
		$new_username = $_POST['new_username'];
		$new_username_again = $_POST['new_username_again'];
		/*
		$current_password = md5($_POST['current_password']);
		$new_password = $_POST['new_password'];
		$new_password_again = $_POST['new_password_again'];
		*/

		if(empty($current_username) || empty($new_username) || empty($new_username_again)) {
			//some or all inputs are empty
			$errors[] = "You need to fill all fields inorder to update username!";

		}else if($current_username != admin_username_from_user_id($user_id)) {
			//current username is wrong
			$errors[] = "Your current username is incorrect!";

		}else if(admin_exists($new_username)) {
			//username is already exists.which means, that user or another user already taken this username
			$errors[] = "This admin is already exists. Try another username!";

		}else if(strcmp($new_username, $new_username_again) != 0) {
			//if new usernames are not equal
			$errors[] = "Your Usernames are doesn't match!";

		}else {
			//if all done,
			//update username
			if(update_admin_username($new_username)) {
				//when update is successfull
				//redirect to home with success message
				header("Location: home.php?message=success_username_changed");
				exit();

			}else {
				//update fails
				$errors[] = "Something went wrong. Try again!";

			}

		}

	}
}else {
	echo "Not set";
}
include 'includes/overall_head.php'; 
check_default_credentials();
?>

<div class="col-md-2">

	<?php
		if(!empty($errors)) {
			echo " <div class=\"alert alert-danger\"> ";
			echo "	<a href=\"#\" class=\"close\" data-dismiss=\"alert\" area-label=\"close\">&times;</a> ";
			echo "<strong>";
			echo output_errors($errors);
			echo "</strong>";
			echo "</div>";
		}
	?>

	<div class="list-group">
		<a href="change_username.php" class="list-group-item active">
			<span class="glyphicon glyphicon-pencil"></span> Edit Username
		</a>
		<a href="change_password.php" class="list-group-item">
			<span class="glyphicon glyphicon-pencil"></span> Edit Password
		</a>
	</div>
</div>
<div class="col-md-10">
	<h1 class="page-header">Change Username</h1>

		<form action="" method="post" role="form" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-md-3" for="current_username">Current Username: </label>
				<div class="col-md-4">
					<input type="text" name="current_username" id="current_username" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="new_username">New Username: </label>
				<div class="col-md-4">
					<input type="text" name="new_username" id="new_username" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="new_username_again">New Username Again: </label>
				<div class="col-md-4">
					<input type="text" name="new_username_again" id="new_username_again" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-3 col-md-4">
					<input type="submit" class="btn btn-success btn-md" style="width:100%;" value="Update username">
				</div>
			</div>
		</form>
</div>

<?php  include 'includes/overall_footer.php'; ?>