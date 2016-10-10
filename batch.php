<?php
require 'core/init.php';  
protect_page();
set_admin_email_redirect();
include 'includes/overall_head.php'; 
check_default_credentials();

$url = $_SERVER['REQUEST_URI'];
$batch_year = batch_year_from_url($url);
$add_member_url = "add_member.php?$batch_year";

$message_in_url = substr(basename($url), 15);
$success = "success";
$update_success = "updatesuccess";

?>
<div class="col-md-2">

		<?php
			if($message_in_url == $success) {
				echo " <div class=\"alert alert-success\"> ";
				echo "	<a href=\"#\" class=\"close\" data-dismiss=\"alert\" area-label=\"close\">&times;</a> ";
				echo "<strong>Successfully Added a Member!</strong>";
				echo "</div>";
			}else if($message_in_url == $update_success) {
				echo " <div class=\"alert alert-success\"> ";
				echo "	<a href=\"#\" class=\"close\" data-dismiss=\"alert\" area-label=\"close\">&times;</a> ";
				echo "<strong>Successfully Updated!</strong>";
				echo "</div>";
			}

			/* delete entries */
			if(isset($_POST['reg_number'])) {
				$reg_numbers = $_POST['reg_number'];

				echo "<div class=\"alert alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" area-label=\"close\">&times;</a>";
				foreach ($reg_numbers as $reg_number) {
					delete_member($reg_number);
					echo "<strong>$reg_number</strong> <br>";
				}
				echo "is deleted.</div>";
			}
		?>
	<div class="list-group">
		<a href="#" class="list-group-item active">
			<span class="glyphicon glyphicon-th-large"></span> All Details
		</a>
		<a href="<?php echo $add_member_url; ?>" class="list-group-item">
			<span class="glyphicon glyphicon-plus"></span> Add Member
		</a>
		<a href="#" class="list-group-item" data-toggle="modal" data-target="#myModal">
			<span class="glyphicon glyphicon-trash"></span> Delete Entry
		</a>
	</div>
</div>
<div class="col-md-10">

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header del-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Select Entries You Want To Delete. </h3>
				<h4>Be Carefull ! There is no backsteps!</h4>
			</div>
			<form action="#" method="POST">
			<div class="modal-body">
				<div class="table-responsive">
				<table class="table table-striped table-bordered ">
					<thead>
						<tr>
							<th>No.</th>
							<th>Reg. No.</th>
							<th>Full Name</th>
							<th>Sex</th>
							<th>Mobile Number</th>
							<th>Email</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						
						<?php

							$result = view_details($batch_year);
							$count = 1;
							while($row = mysqli_fetch_assoc($result)) {
								echo "<tr>";
								echo "<td>" . $count . "</td>";
								$modified_reg_number = display_regnumber($row['reg_number']);
								echo "<td>" . ucfirst($modified_reg_number) . "</td>";
								echo "<td>" . ucwords($row['full_name']) . "</td>";
								echo "<td>" . $row['sex'] . "</td>";
								echo "<td>" . $row['tp_mobile'] . "</td>";
								echo "<td>" . $row['email'] . "</td>";
								$reg_number = $row['reg_number'];

								echo "<td> <div class=\"checkbox\"><label><input type=\"checkbox\" name=\"reg_number[]\" value=\"$reg_number\"></label></div> </td>";
								echo "</tr>";

								$count ++;
							}
						?>
						
					</tbody>
				</table>
				</div>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
				<input type="submit" name="" class="btn btn-danger btn-md" value="Delete">
			</div>
			</form>
		</div>
	</div>
</div>

	<h1 class="page-header"><?php echo $batch_year ?> Batch</h1>
	<div class="table-responsive">
	<table class="table table-striped table-bordered ">
		<thead>
			<tr>
				<th>No.</th>
				<th>Reg. No.</th>
				<th>Name with initials</th>
				<th>Full Name</th>
				<th>Sex</th>
				<!-- <th>Batch</th> -->
				<th>Mobile Number</th>
				<th>Home Number</th>
				<th>Address</th>
				<th>District</th>
				<th>Email</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php

				$result = view_details($batch_year);
				$count = 1;
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $count . "</td>";
					$modified_reg_number = display_regnumber($row['reg_number']);
					echo "<td>" . ucfirst($modified_reg_number) . "</td>";
					echo "<td>" . ucwords($row['name_with_initials']) . "</td>";
					echo "<td>" . ucwords($row['full_name']) . "</td>";
					echo "<td>" . $row['sex'] . "</td>";
					echo "<td>" . $row['tp_mobile'] . "</td>";
					echo "<td>" . $row['tp_home'] . "</td>";
					echo "<td>" . ucwords($row['address']) . "</td>";
					echo "<td>" . ucwords($row['district']) . "</td>";
					echo "<td>" . $row['email'] . "</td>";
					$edit_url = "edit.php?" . $row['reg_number'];
					echo "<td> <a class=\"btn btn-success btn-sm\" href=\"$edit_url\">Edit</a>";
					echo "</tr>";

					$count ++;
				}
			?>
		</tbody>
	</table>
	</div>
</div>
<?php  include 'includes/overall_footer.php'; ?>
