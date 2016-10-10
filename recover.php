<?php
require 'core/init.php';  
logged_in_redirect();

$mode_allowed = array('username', 'password');

if(isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true) {
	if(isset($_POST['email']) === true && empty($_POST['email']) === false) {
		if(admin_email_exists($_POST['email']) === true) {
			recover($_GET['mode'], $_POST['email']);
			header("Location: login.php?message=email_send");

		}else {
			//echo "We couldn't find that email address!";
			$errors[] = "We couldn't find that email address!";

		}

	}


}else {
	header("Location: index.php");
	exit();
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
	?>
	<div class="list-group">
		<a href="about.php" class="list-group-item">
			<span class="glyphicon glyphicon-info-sign"></span> About
		</a>
		<a href="help.php" class="list-group-item">
			<span class="glyphicon glyphicon-question-sign"></span> Help
		</a>
	</div>
</div>
<div class="col-md-6">
	<h1 class="page-header">Recover Your <?php echo ucfirst($_GET['mode']); ?></h1>
	<form action="" method="post" role="form" class="form-horizontal">
		<div class="form-group">
			<label class="control-label col-md-3" for="email">Your Email: </label>
			<div class="col-md-6">
				<input type="text" name="email" id="email" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-offset-3 col-md-6">
				<input type="submit" class="btn btn-success btn-md" value="Send me my <?php echo $_GET['mode']; ?>">
			</div>
		</div>
	</form>
</div>

<?php  include 'includes/overall_footer.php'; ?>