<?php
require 'core/init.php';  
include 'includes/overall_head.php'; 
?>

<div class="container">
	<div class="panel panel-danger">
		<div class="panel-heading">
			<h3>Access Denied!</h3>
		</div>
		<div class="panel-body">
			<h4>You need to logged in to do this.</h4>
			<h4>Please login!</h4>
			<a href="index.php" class="btn btn-success btn-md">Login</a>
		</div>
	</div>
</div>

<?php  include 'includes/overall_footer.php'; ?>