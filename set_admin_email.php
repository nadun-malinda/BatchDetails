<?php
require 'core/init.php';  
protect_page();
if(is_set_admin_email() === false) {
	include 'includes/overall_head.php'; 

	if(isset($_POST['email']) === true) {
		$email = $_POST['email'];

		if(empty($email) === true) {
			$errors[] = "Email is required!";

		}else if(validate_email($email) === false) {
			$errors[] = "Email is not valid!";

		}else {
			if(set_admin_email($email)) {
				header("Location: home.php?message=admin_email_setted");
				exit();

			}else {
				$errors[] = "Something went wrong. Try again!";
			}

		}

	}

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
			<a href="#" class="list-group-item active">
				<span class="glyphicon glyphicon-flag"></span> About
			</a>
			<a href="help.php" class="list-group-item">
				<span class="glyphicon glyphicon-comment"></span> Help
			</a>
		</div>
	</div>
	<div class="col-md-6">
		<h1 class="page-header">Set Recovery Email</h1>
		<form action="" method="post" role="form" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-md-3" for="email">Your Email: </label>
				<div class="col-md-6">
					<input type="text" name="email" id="email" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-3 col-md-6">
					<input type="submit" class="btn btn-success btn-md" value="set this as my recover email">
				</div>
			</div>
		</form>
	</div>
	<?php include 'includes/overall_footer.php'; ?>

<?php
}else {
	header("Location: home.php");
}
?>