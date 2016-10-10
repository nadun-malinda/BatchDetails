<?php
require 'core/init.php';  
protect_page();
set_admin_email_redirect();
include 'includes/overall_head.php'; 
check_default_credentials();

$url = $_SERVER['REQUEST_URI'];
$basename = basename($url);
//$reg_number = ucfirst(substr($basename, 9, 6));
$reg_number = reg_number_from_url($url);

$result = view_details_from_regnumber($reg_number);
$name_with_initials = ucwords($result['name_with_initials']);
$full_name = ucwords($result['full_name']);
$sex = $result['sex'];
$batch_year = $result['batch_year'];
$tp_mobile = $result['tp_mobile'];
$tp_home = $result['tp_home'];
$address = ucwords($result['address']);
$district = ucwords($result['district']);
$email = $result['email'];

$message_in_url = substr($basename, 19);
$update_fail = "updatefail";
$edit_controller_url = "edit_controller.php?" . $reg_number;
$add_member_url = "add_member.php?$batch_year";
$batch_url = "batch.php?$batch_year";

$ampara = $anuradhapura = $badulla = $batticaloa = $colombo = $galle = $gampaha = $hambantota = $jaffna = $kalutara = $kandy = $kegalle = $kilinochchi = $kurunegala = $mannar = $matale = $matara = $monaragala = $mullaitivu = $nuwara_eliya = $polonnaruwa = $puttalam = $ratnapura = $trincomalee = $vavuniya = "";

$district = strtolower($district);
switch ($district) {
	case 'ampara':
		$ampara = "selected";
		break;
	
	case 'anuradhapura':
		$anuradhapura = "selected";
		break;

	case 'badulla':
		$badulla = "selected";
		break;

	case 'batticaloa':
		$batticaloa = "selected";
		break;

	case 'colombo':
		$colombo = "selected";
		break;

	case 'galle':
		$galle = "selected";
		break;

	case 'gampaha':
		$gampaha = "selected";
		break;

	case "hambantota":
		$hambantota = "selected";
		break;

	case 'jaffna':
		$jaffna = "selected";
		break;

	case 'kalutara':
		$kalutara = "selected";
		break;

	case 'kandy':
		$kandy = "selected";
		break;

	case 'kegalle':
		$kegalle = "selected";
		break;

	case 'kilinochchi':
		$kilinochchi = "selected";
		break;

	case 'kurunegala':
		$kurunegala = "selected";
		break;

	case 'mannar':
		$mannar = "selected";
		break;

	case 'matale':
		$matale = "selected";
		break;

	case 'matara':
		$matara = "selected";
		break;

	case 'monaragala':
		$monaragala = "selected";
		break;

	case 'mullaitivu':
		$mullaitivu = "selected";
		break;

	case 'nuwara eliya':
		$nuwara_eliya = "selected";
		break;

	case 'polonnaruwa':
		$polonnaruwa = "selected";
		break;

	case 'puttalam':
		$puttalam = "selected";
		break;

	case 'ratnapura':
		$ratnapura = "selected";
		break;

	case 'trincomalee':
		$trincomalee = "selected";
		break;

	case 'vavuniya':
		$vavuniya = "selected";
		break;

	default:
		$vavuniya = "selected";
		break;
}

?>
<div class="col-md-2">
	<?php
		if($message_in_url == $update_fail) {
			echo " <div class=\"alert alert-danger\"> ";
			echo "	<a href=\"#\" class=\"close\" data-dismiss=\"alert\" area-label=\"close\">&times;</a> ";
			echo "<strong>Update Fail! Try Again.</strong>";
			echo "</div>";
		}
	?>
	<div class="list-group">
		<a href="<?php echo $batch_url; ?>" class="list-group-item">
			<span class="glyphicon glyphicon-th"></span> All Details
		</a>
		<a href="<?php echo $add_member_url; ?>" class="list-group-item">
			<span class="glyphicon glyphicon-plus"></span> Add Member
		</a>
	</div>
</div>
<div class="col-md-10">
	<h1 class="page-header"><?php echo display_regnumber($reg_number); ?> Student - Edit</h1>

	<div>
		<form action="<?php echo $edit_controller_url; ?>" method="POST" role="form" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-md-3" for="reg_number">Registration Number :</label>
				<div class="col-md-3">
					<input class="form-control" type="text" name="reg_number" id="reg_number" value="<?php echo display_regnumber($reg_number); ?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="name_with_initials">Name With Initials :</label>
				<div class="col-md-6">
					<input type="text" name="name_with_initials" id="name_with_initials" class="form-control" value="<?php echo $name_with_initials; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="full_name">Full Name :</label>
				<div class="col-md-6">
					<input type="text" name="full_name" id="full_name" class="form-control" value="<?php echo $full_name; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="sex">Sex :</label>
				<div class="col-md-3">
					<select name="sex" class="form-control">
						<option value="female">Female</option>
						<option value="male" <?php male_or_female($sex); ?>>Male</option>
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
				<label class="control-label col-md-3" for="mobile_number">Mobile Number :</label>
				<div class="col-md-3">
					<input type="text" name="mobile_number" id="mobile_number" class="form-control" value="<?php echo $tp_mobile; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="home_number">Home Number :</label>
				<div class="col-md-3">
					<input type="text" name="home_number" id="home_number" class="form-control" value="<?php echo $tp_home; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="address">Address :</label>
				<div class="col-md-6">
					<input type="text" name="address" id="address" class="form-control" value="<?php echo $address; ?>">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="district">District :</label>
				<div class="col-md-3">
					<select name="district" class="form-control">
						<option value="ampara" <?php echo $ampara; ?>>Ampara</option>
						<option value="anuradhapura" <?php echo $anuradhapura; ?>>Anuradhapura</option>
						<option value="badulla" <?php echo $badulla; ?>>Badulla</option>
						<option value="batticaloa" <?php echo $batticaloa; ?>>Batticaloa</option>
						<option value="colombo" <?php echo $colombo; ?>>Colombo</option>
						<option value="galle" <?php echo $galle; ?>>Galle</option>
						<option value="gampaha" <?php echo $gampaha; ?>>Gampaha</option>
						<option value="hambantota" <?php echo $hambantota; ?>>Hambantota</option>
						<option value="jaffna" <?php echo $jaffna; ?>>Jaffna</option>
						<option value="kalutara" <?php echo $kalutara; ?>>Kalutara</option>
						<option value="kandy" <?php echo $kandy; ?>>Kandy</option>
						<option value="kegalle" <?php echo $kegalle; ?>>Kegalle</option>
						<option value="kilinochchi" <?php echo $kilinochchi; ?>>Kilinochchi</option>
						<option value="kurunegala" <?php echo $kurunegala; ?>>Kurunegala</option>
						<option value="mannar" <?php echo $mannar; ?>>Mannar</option>
						<option value="matale" <?php echo $matale; ?>>Matale </option>
						<option value="matara" <?php echo $matara; ?>>Matara</option>
						<option value="monaragala" <?php echo $monaragala; ?>>Monaragala</option>
						<option value="mullaitivu" <?php echo $mullaitivu; ?>>Mullaitivu</option>
						<option value="nuwara_eliya" <?php echo $nuwara_eliya; ?>>Nuwara Eliya</option>
						<option value="polonnaruwa" <?php echo $polonnaruwa; ?>>Polonnaruwa</option>
						<option value="puttalam" <?php echo $puttalam; ?>>Puttalam</option>
						<option value="ratnapura" <?php echo $ratnapura; ?>>Ratnapura</option>
						<option value="trincomalee" <?php echo $trincomalee; ?>>Trincomalee</option>
						<option value="vavuniya" <?php echo $vavuniya; ?>>Vavuniya</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3" for="email">Email :</label>
				<div class="col-md-6">
					<input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-3 col-md-3">
					<input type="submit" class="btn btn-md btn-success" href="#" style="width:100%;" value="Done">
				</div>
			</div>
		</form>
	</div>
</div>
<?php  include 'includes/overall_footer.php'; ?>
