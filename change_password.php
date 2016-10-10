<?php
require 'core/init.php'; 
protect_page(); 
set_admin_email_redirect();
$user_id = $_SESSION['user_id'];

if(isset($_POST)) {
	if(!empty($_POST)) {
		$current_password = md5($_POST['current_password']);
		$new_password = $_POST['new_password'];
		$new_password_again = $_POST['new_password_again'];

		if(empty($current_password) || empty($new_password) || empty($new_password_again)) {
			//some or all inputs are empty
			$errors[] = "You need to fill all fields inorder to update password!";

		}else if($current_password != admin_password_from_user_id($user_id)) {
			//current username is wrong
			$errors[] = "Your current password is incorrect!";

		}else if(strlen($new_password) < 8) {
			//new password must contain atleast 8 characters
			$errors[] = "Your password must contain atleast 8 characters!";

		}else if(strcmp($new_password, $new_password_again) != 0) {
			//if new usernames are not equal
			$errors[] = "Your Passwords are doesn't match!";

		}else {
			//if all done,
			//update username
			if(update_admin_password($new_password, $user_id)) {
				//when update is successfull
				//redirect to home with success message
				header("Location: home.php?message=success_password_changed");
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
		<a href="change_username.php" class="list-group-item">
			<span class="glyphicon glyphicon-pencil"></span> Edit Username
		</a>
		<a href="change_password.php" class="list-group-item active">
			<span class="glyphicon glyphicon-pencil"></span> Edit Password
		</a>
	</div>
</div>
<div class="col-md-10">
	<h1 class="page-header">Change Password</h1>

		<form action="" method="post" role="form" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-md-3" for="current_password">Current Password: </label>
				<div class="col-md-4">
					<input type="password" name="current_password" id="current_password" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="new_password">New Password: </label>
				<div class="col-md-4">
					<input type="password" name="new_password" id="new_password" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="new_password_again">New Password Again: </label>
				<div class="col-md-4">
					<input type="password" name="new_password_again" id="new_password_again" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-offset-3 col-md-4">
					<input type="submit" class="btn btn-success btn-md" style="width:100%;" value="Update password">
				</div>
			</div>
		</form>
</div>

<?php  include 'includes/overall_footer.php'; ?>