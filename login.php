<?php
require 'core/init.php';  
logged_in_redirect();

if(isset($_POST) && !empty($_POST)) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password)) {
		//username or password is empty
		$errors[] = "You need to enter a username and password!";

	}else if(admin_exists($username) === false) {
		//if user is not actualy an admin
		$errors[] = "you can't access!. Please contact your administrator.";

	}else {
		$login = login($username, $password);

		if($login === false) {
			$errors[] = "your username and password combination is incorrect!";

		}else {
			//set user sessions
			$_SESSION['user_id'] = $login;
			//redirect to home
			header("Location: index.php");
			exit();
		}		
	}

}

include 'includes/overall_head.php'; 
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

		if(isset($_GET['message']) && $_GET['message'] == "email_send") {
			echo " <div class=\"alert alert-success\"> ";
			echo "	<a href=\"#\" class=\"close\" data-dismiss=\"alert\" area-label=\"close\">&times;</a> ";
			echo "<strong>Thanks, We've emailed you!<br>";
			echo "Check your email and login.</strong>";
			echo "</div>";

		}
	?>

	<div class="list-group">
		<a href="#" class="list-group-item active">
			<span class="glyphicon glyphicon-log-in"></span> Login
		</a>
		<a href="about.php" class="list-group-item">
			<span class="glyphicon glyphicon-info-sign"></span> About
		</a>
		<a href="help.php" class="list-group-item">
			<span class="glyphicon glyphicon-question-sign"></span> Help
		</a>
	</div>
</div>
<div class="col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading text-center login-ph">
			<h3>Login</h3>
		</div>
		<div class="panel-body">
			<form role="form" action="login.php" method="post" class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-md-3" for="username">Username: </label>
					<div class="col-md-6">
						<input type="text" name="username" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="password">Password: </label>
					<div class="col-md-6">
						<input type="password" name="password" class="form-control">
					</div>
				</div>
				<!--
				<div class="form-group">
					<div class="col-md-offset-3 col-md-6">
						<div class="checkbox">
							<label><input type="checkbox" name="remember_me"> Remember me.</label>
						</div>
					</div>
				</div>
				-->
				<div class="form-group">
					<div class="col-md-offset-3 col-md-8">
						Forgotten your <a href="recover.php?mode=username">Username</a> or <a href="recover.php?mode=password">Password</a>?
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-3 col-md-6">
						<button class="btn btn-md btn-success" href="#" style="width:100%;">Login</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php  include 'includes/overall_footer.php'; ?>
