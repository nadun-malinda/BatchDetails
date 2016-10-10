<?php
require 'core/init.php'; 
protect_page(); 
set_admin_email_redirect();
include 'includes/overall_head.php'; 
check_default_credentials();

//$url = $_SERVER['REQUEST_URI'];

function find_error($value) {
	if($value == 0) {
		echo "Your input must be an integer (Ex:- 2012)";

	}
	if($value == 1) {
		echo "Batch year must contain exactly 4 numbers (Ex:- 2012)";

	}
	if($value == 2) {
		echo "You must enter a batch for add a new batch!";

	}
}

?>
<div class="col-md-2">

	<?php
	/* delete entries */
	if(isset($_POST['batch_year'])) {
		$batch_years = $_POST['batch_year'];

		echo "<div class=\"alert alert-danger\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" area-label=\"close\">&times;</a>";
		foreach ($batch_years as $batch_year) {
			delete_batch($batch_year);
			echo "<strong>$batch_year</strong> <br>";
		}
		echo "<strong>batch is deleted.</strong></div>";
	}


	/* errors */
	if(isset($_GET['message']) && !empty($_GET['message'])) {
		if($_GET['message'] == "admin_email_setted") {
			echo " <div class=\"alert alert-success\"> ";
			echo "	<a href=\"#\" class=\"close\" data-dismiss=\"alert\" area-label=\"close\">&times;</a> ";
			echo "<strong>Admin recovery email successfully setted!!</strong>";
			echo "</div>";

		}else if($_GET['message'] == "success_username_changed") {
			echo " <div class=\"alert alert-success\"> ";
			echo "	<a href=\"#\" class=\"close\" data-dismiss=\"alert\" area-label=\"close\">&times;</a> ";
			echo "<strong>Username successfully updated!</strong>";
			echo "</div>";

		}else if($_GET['message'] == "success_password_changed") {
			echo " <div class=\"alert alert-success\"> ";
			echo "	<a href=\"#\" class=\"close\" data-dismiss=\"alert\" area-label=\"close\">&times;</a> ";
			echo "<strong>Password successfully updated!</strong>";
			echo "</div>";

		}else if($_GET['message'] == "not_integer") {
			echo " <div class=\"alert alert-danger\"> ";
			echo "	<a href=\"#\" class=\"close\" data-dismiss=\"alert\" area-label=\"close\">&times;</a> ";
			echo "<strong>Your input must be an integer (Ex:- 2012)</strong>";
			echo "</div>";

		}else if($_GET['message'] == "exactly_four_digits") {
			echo " <div class=\"alert alert-danger\"> ";
			echo "	<a href=\"#\" class=\"close\" data-dismiss=\"alert\" area-label=\"close\">&times;</a> ";
			echo "<strong>Batch year must contain exactly 4 numbers (Ex:- 2012)</strong>";
			echo "</div>";

		}else if($_GET['message'] == "no_inputs") {
			echo " <div class=\"alert alert-danger\"> ";
			echo "	<a href=\"#\" class=\"close\" data-dismiss=\"alert\" area-label=\"close\">&times;</a> ";
			echo "<strong>You must enter a batch for add a new batch!</strong>";
			echo "</div>";

		}

	}
	
	?>

	<div class="list-group">
		<a href="#" class="list-group-item active">
			<span class="glyphicon glyphicon-th"></span> All Details
		</a>
		<a href="#" class="list-group-item" data-toggle="modal" data-target="#myModal">
			<span class="glyphicon glyphicon-plus"></span> Add a Batch
		</a>
		<a href="#" class="list-group-item" data-toggle="modal" data-target="#deleteBatch">
			<span class="glyphicon glyphicon-trash"></span> Delete a Batch
		</a>
	</div>
</div>
<div class="col-md-10">


<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header add-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Add a Batch.</h3>
				<h4>You can add batch from here.</h4>
			</div>
			<form action="add_batch_controller.php" method="POST" class="form-horizontal" role="form">
				<div class="modal-body">
					
						<div class="form-group">
							<label class="control-label col-md-3" for="batch_year">Batch :</label>
							<div class="col-md-4">
								<input type="text" name="batch_year" id="batch_year" class="form-control" placeholder="Enter a New Batch" autofocus maxlength="4">
							</div>
						</div>

						<strong>Important!</strong><br>
						<p>
							Inputs must have exactly 4 digits. (Eg:- 2014) <br>
							Inputs must be an integer.
						</p>
					
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
					<input type="submit" name="" class="btn btn-success btn-md" value="Add New Batch">
				</div>
			</form>
		</div>
	</div>
</div>


<div id="deleteBatch" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header del-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Delete a Batch.</h3>
				<h4>Be Carefull ! There is no backsteps!</h4>
			</div>
			<form action="" method="POST" class="form-horizontal" role="form">
				<div class="modal-body">
						<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover table-condensed">
							<thead>
								<tr>
									<th>No.</th>
									<th>Batch</th>
									<th>No. of Members</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$count = 1;
									$batch = view_batch();
									while($row = mysqli_fetch_assoc($batch)) {
										echo "<tr>";
										echo "<td>" .$count . "</td>";
										echo "<td>" . $row['batch_year'] . "</td>";
										echo "<td>" . member_count($row['batch_year']) . "</td>";
										$batch_year = $row['batch_year'];

										echo "<td> <div class=\"checkbox\"><label><input type=\"checkbox\" name=\"batch_year[]\" value=\"$batch_year\"></label></div> </td>";
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
					<input type="submit" name="" class="btn btn-danger btn-md" value="Delete Batch">
				</div>
			</form>
		</div>
	</div>
</div>

	<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover table-condensed">
		<thead>
			<tr>
				<th>No.</th>
				<th>Batch</th>
				<th>No. of Members</th>
				<th>Other</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$count = 1;
				$batch_year = view_batch();
				while($row = mysqli_fetch_assoc($batch_year)) {
					echo "<tr>";
					echo "<td>" .$count . "</td>";
					echo "<td>" . $row['batch_year'] . "</td>";
					echo "<td>" . member_count($row['batch_year']) . "</td>";
					$url = "batch.php?" . $row['batch_year'];
					echo "<td> <a class=\"btn btn-success\" href=\"$url\">View</a> </td>";
					echo "</tr>";

					$count ++;
				}
			?>
		</tbody>
	</table>
	</div>
</div>
<?php  include 'includes/overall_footer.php'; ?>
