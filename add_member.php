<?php
require 'core/init.php';
protect_page();  
set_admin_email_redirect();
include 'includes/overall_head.php'; 
check_default_credentials();

$url = $_SERVER['REQUEST_URI'];
$basename = basename($url);
$batch_year = ucfirst(substr($basename, 15, 4));
$batch_url = "batch.php?$batch_year";
$add_member_controller_url = "add_member_controller.php?$batch_year";

$reg_number_prefix = "FS / $batch_year /";

?>
<div class="col-md-2">

	<div class="list-group">
		<a href="<?php echo $batch_url; ?>" class="list-group-item">
			<span class="glyphicon glyphicon-th-large"></span> <?php echo $batch_year; ?> Batch
		</a>
		<a href="#" class="list-group-item active">
			<span class="glyphicon glyphicon-plus"></span> Add Member
		</a>
	</div>
</div>
<div class="col-md-10">
	<h1 class="page-header">Add a Member for <?php echo $batch_year; ?> Batch.</h1>
	<div>
		<form action="<?php echo $add_member_controller_url; ?>" method="POST" role="form" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-md-3" for="reg_number">* Registration Number :</label>
				<div class="col-md-3">
					<span class="reg-number-input"><?php echo "<strong>$reg_number_prefix</strong>"; ?></span>
					<input class="form-control" type="text" name="reg_number" id="reg_number" placeholder="Ex:- 001" style="padding-left:86px;" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="name_with_initials">* Name With Initials :</label>
				<div class="col-md-6">
					<input type="text" name="name_with_initials" id="name_with_initials" class="form-control" placeholder="Ex:- B.K.N.M.Bandara" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="full_name">* Full Name :</label>
				<div class="col-md-6">
					<input type="text" name="full_name" id="full_name" class="form-control" placeholder="Name in long form" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="sex">Sex :</label>
				<div class="col-md-3">
					<select name="sex" class="form-control">
						<option value="female">Female</option>
						<option value="male">Male</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="batch">Batch :</label>
				<div class="col-md-3">
					<input type="text" name="batch" id="batch" class="form-control" value="<?php echo $batch_year; ?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="mobile_number">* Mobile Number :</label>
				<div class="col-md-3">
					<input type="text" name="mobile_number" id="mobile_number" class="form-control" placeholder="Ex:- 0712345678" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="home_number">Home Number :</label>
				<div class="col-md-3">
					<input type="text" name="home_number" id="home_number" class="form-control" placeholder="Ex:- 0712345678">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="address">* Address :</label>
				<div class="col-md-6">
					<input type="text" name="address" id="address" class="form-control" placeholder="Ex:- No3/2, Galaha Road, Peradeniya" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="district">District :</label>
				<div class="col-md-3">
					<select name="district" class="form-control">
						<option value="ampara">Ampara</option>
						<option value="anuradhapura">Anuradhapura</option>
						<option value="badulla">Badulla</option>
						<option value="batticaloa">Batticaloa</option>
						<option value="colombo">Colombo</option>
						<option value="galle">Galle</option>
						<option value="gampaha">Gampaha</option>
						<option value="hambantota">Hambantota</option>
						<option value="jaffna">Jaffna</option>
						<option value="kalutara">Kalutara</option>
						<option value="kandy">Kandy</option>
						<option value="kegalle">Kegalle</option>
						<option value="kilinochchi">Kilinochchi</option>
						<option value="kurunegala">Kurunegala</option>
						<option value="mannar">Mannar</option>
						<option value="matale">Matale </option>
						<option value="matara">Matara</option>
						<option value="monaragala">Monaragala</option>
						<option value="mullaitivu">Mullaitivu</option>
						<option value="nuwara_eliya">Nuwara Eliya</option>
						<option value="polonnaruwa">Polonnaruwa</option>
						<option value="puttalam">Puttalam</option>
						<option value="ratnapura">Ratnapura</option>
						<option value="trincomalee">Trincomalee</option>
						<option value="vavuniya">Vavuniya</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="email">* Email :</label>
				<div class="col-md-6">
					<input type="email" name="email" id="email" class="form-control" placeholder="Ex:- youremail@example.com" required>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-3 col-md-3">
					<button class="btn btn-md btn-success" href="#" style="width:100%;">Done</button>
				</div>
			</div>
		</form>
	</div>
</div>
<?php  include 'includes/overall_footer.php'; ?>
