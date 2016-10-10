<div class="ft-item">
	<a href="index.php">Home</a>
	<a href="change_username.php">Change Username</a>
	<a href="change_password.php">Change Password</a>
	<?php
		if(is_set_admin_email()) {
			echo "<span>Set Recovery Email</span>";
		}else {
			echo "<a href=\"set_admin_email.php\">Set Recovery Email</a>";
		}
	?>
	<a href="logout.php">Logout</a>
</div>