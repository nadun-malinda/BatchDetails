<nav class="nav navbar-inverse">
	<div class="container">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="home.php">BatchDetails</a>
	</div>
	<div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav navbar-right">
			<?php
				if(logged_in() === true) {
					echo "<li class=\"";
						if(active_page() == 0) { 
							echo "active"; 
						} 
					echo "\"><a href=\"home.php\"><span class=\"glyphicon glyphicon-home\"></span> Home</a></li>";

					echo "<li class=\"";
						if(active_page() == 1) { 
							echo "active"; 
						} 
					echo "\"><a href=\"change_username.php\"><span class=\"glyphicon glyphicon-pencil\"></span> Change Username</a></li>";

					echo "<li class=\"";
						if(active_page() == 2) { 
							echo "active"; 
						} 
					echo "\"><a href=\"change_password.php\"><span class=\"glyphicon glyphicon-pencil\"></span> Change Password</a></li>";

					echo "<li class=\"";
						if(active_page() == 3) { 
							echo "active"; 
						} 
					echo "\"><a href=\"about.php\"><span class=\"glyphicon glyphicon-info-sign\"></span> About</a></li>";

					echo "<li class=\"";
						if(active_page() == 4) { 
							echo "active"; 
						} 
					echo "\"><a href=\"help.php\"><span class=\"glyphicon glyphicon-question-sign\"></span> Help</a></li>";

					echo "<li><a href=\"logout.php\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout</a></li>";

					/*
					echo "<li class=" . if(active_page() == 1) { echo "active" } . "><a href=\"change_username.php\"><span class=\"glyphicon glyphicon-pencil\"></span> Change Username</a></li>";
					echo "<li class=" . if(active_page() == 2) { echo "active" } . "><a href=\"change_password.php\"><span class=\"glyphicon glyphicon-pencil\"></span> Change Password</a></li>";
					echo "<li class=" . if(active_page() == 3) { echo "active" } . "><a href=\"logout.php\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout</a></li>";
					*/
				} 
			?>
		</ul>
	</div>
</nav>