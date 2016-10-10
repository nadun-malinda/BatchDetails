<?php
require 'core/init.php';
include 'includes/overall_head.php'; 

?>
<div class="col-md-2">
	<div class="list-group">
		<a href="login.php" class="list-group-item">
			<span class="glyphicon glyphicon-log-in"></span> Login
		</a>
		<a href="about.php" class="list-group-item active">
			<span class="glyphicon glyphicon-info-sign"></span> About
		</a>
		<a href="help.php" class="list-group-item">
			<span class="glyphicon glyphicon-question-sign"></span> Help
		</a>
	</div>
</div>
<div class="col-md-10">

	<h1 class="page-header">About</h1>

	<div class="row">
		<div class="col-md-4">
			<h3>Designer</h3>
			<div class="panel panel-default about-panel">
				<div class="panel-heading">
					<img src="images/author/nandun.jpg" style="width:100%;">
				</div>
				<div class="panel-body">
					<h4><a href="https://twitter.com/Nandun_Malinda">Nandun Malinda</a></h4>
					<p>
						This system is designed by <a href="https://twitter.com/Nandun_Malinda">Nandun Malinda</a>. He is a undergraduate student at Faculty of Science, University of Peradeniya, Srilanka.
					</p>
					<p>
						Also, he is a Blogger, PHP Programmer and Full Stack Web Developer.
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<h3>Intention</h3>
			<div class="panel panel-default about-panel">
				<div class="panel-heading">
					<img src="images/author/intention.jpg">
				</div>
				<div class="panel-body">
					<p>
						This system is designed for with intention to collect, store and modify contact information about batch mates in order to facilitate well structered database.
					</p>
					<p>
						BatchDetails system is completely free product and it is not designed for sale!<br>
						However, we're thankful for using our system!
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<h3>What It Can Do?</h3>
			<div class="panel panel-default about-panel">
				<div class="panel-heading">
					<img src="images/author/what_can_do.jpg">
				</div>
				<div class="panel-body">
					<p>
						Basically, BatchDetails system can do lot of things!
					</p>
					<p>
						It can do add batches, batch mates details for the system, edit, delete batch mates for you. Importing information through google forms are also possible.
					</p>
				</div>
			</div>
		</div>
	</div>

</div>
<?php  include 'includes/overall_footer.php'; ?>
