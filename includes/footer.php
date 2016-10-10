<div class="container-fluid footer">
	<div class="container-fluid footer-head">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<p>BatchDetails System</p>
					<p class="ft-heading">-This is completely free product and not for sale.</p>
				</div>
				<div class="col-md-4">
					
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid footer-body">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="ft-heading">
						Shortcuts
					</div>
					<?php
						if(logged_in() === true) {
							include 'includes/logged_in_shortcuts.php';
						}
					?>
				</div>
				<div class="col-md-3">
					<div class="ft-heading">
						Others
					</div>
					<div class="ft-item">
						<a href="about.php">About</a>
						<a href="help.php">Help</a>

					</div>
				</div>
				<div class="col-md-3">
					<div class="ft-heading">
						Powered By
					</div>
					<div class="ft-item">
						<a href="http://getbootstrap.com/">Bootstrap</a>
						<a href="http://glyphicons.com/">Glyphicons</a>
					</div>
				</div>
				<div class="col-md-3">
					<div class="ft-heading">
						Follow
					</div>
					<ul class="ft-ul">
						<li>
							<a href="https://twitter.com/Nandun_Malinda"><img src="images/social_media/twitter.png"></a>
						</li>
					</ul>
					<div class="ft-heading">
						Or send me an email
					</div>
					<p style="color:#fff;">  
						bknandun@gmail.com	<br>
						bknandun@outlook.com
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid footer-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<p class="ft-heading">&copy; 2016 - Nandun Malinda. All Rights Reserved.</p>
				</div>
				<div class="col-md-4">
					
				</div>
			</div>
		</div>
	</div>
</div>