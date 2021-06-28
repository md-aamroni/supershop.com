<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$eloquent = new Eloquent;


## ===*=== [D]ELETE SLIDER DATA ===*=== ##
if(isset($_REQUEST['did']))
{
	#== GET FILE INFORMATION THAT YOU ARE GOING TO DELETE
	$tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "slides";
	$whereValue["id"] = $_REQUEST['did'];
	$getsliderData = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	#== DELETE THE FILE
	$tableName = "slides";
	$whereValue["id"] = $_REQUEST['did'];
	$deletesliderData = $eloquent->deleteData($tableName, $whereValue);
	
	if($deletesliderData > 0)
	{
		#== ALSO DELETED FROM DIRECTORY
		unlink($GLOBALS['SLIDES_DIRECTORY'] . $getsliderData[0]['slider_file']);
	}
}
## ===*=== [D]ELETE SLIDER DATA ===*=== ##



## ===*=== [C]HANGE SLIDER STATUS ===*=== ##
if(isset($_POST['change_status']))
{
	$tableName = $columnValue = $whereValue = null;
	$tableName = "slides";
	$whereValue["id"] = $_POST['slider_status_id'];
	
	if($_POST['current_status'] == "Active")
	{
		$columnValue["slider_status"] = "Inactive";
	}
	else if($_POST['current_status'] == "Inactive")
	{
		$columnValue["slider_status"] = "Active";
	}
	
	$updatesliderStatus = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}
## ===*=== [C]HANGE SLIDER STATUS ===*=== ##



## ===*=== [L]IST OF SLIDER DATA ===*=== ##
$tableName = $columnName = null;
$columnName = "*";
$tableName = "slides";
$sliderList = $eloquent->selectData($columnName, $tableName);
## ===*=== [L]IST OF SLIDER DATA ===*=== ##
?>

<!--=*= SLIDER LIST SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-sm-12">
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home </a></li>
				<li><a href="dashboard.php"> Dashboard </a></li>
				<li class="active"> List Sliders </li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					SLIDER LIST
				</header>
				<div class="panel-body">
					
					<?php 
						#== DELETE CONFIRMATION MESSAGE
						if(isset($_REQUEST['did']))
						{
							if($deletesliderData > 0)
							{
								echo '<div class="alert alert-success fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											THE SLIDER DATA IS <strong> DELETED SUCCESSFULLY </strong>
										</div>';
							}
							else
							{
								echo '<div class="alert alert-warning fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											SOMETHING WENT WRONG TO DELETE DATA! <strong> PLEASE RECHECK </strong>
										</div>';
							}
						}		
						
						#== STATUS CHANGE CONFIRMATION MESSAGE
						if(isset($_POST['change_status']))
						{
							if($updatesliderStatus > 0)
							{
								echo '<div class="alert alert-success fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											THE SLIDER DATA IS <strong> UPDATED SUCCESSFULLY </strong>
										</div>';
							}
							else
							{
								echo '<div class="alert alert-warning fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button> 
											SOMETHING WENT WRONG TO CHANGE STATUS! <strong> PLEASE RECHECK </strong>
										</div>';
							}
						}
					?>
					
					<div class="adv-table">
						<table class="display table table-bordered table-striped" id="dynamic-table">
							<thead>
								<tr>
									<th style="width:5%;"> ID </th>
									<th style="width:40%;"> Title </th>
									<th style="width:12%;"> Status </th>
									<th style="width:20%;"> Image </th>
									<th style="width:5%;"> Sequence </th>
									<th style="width:18%;"> Action </th>
								</tr>
							</thead>
							<tbody>
								
							<?php 
								#== SLIDER DATA TABLE
								$n=1;
								foreach($sliderList AS $eachRow)
								{
									echo '
									<tr>
										<td>'. $n .'</td>
										<td>'. $eachRow['slider_title'] .'</td>
										<td class="center">
											<form method="post" action="">
												<input type="hidden" name="slider_status_id" value="'. $eachRow['id'] .'" />
												<input type="hidden" name="current_status" value="'. $eachRow['slider_status'] .'" />
												<button name="change_status" class="btn btn-info btn-xs" style="width: 76px;" type="submit">'. $eachRow['slider_status'] .'</button>
											</form>
										</td>
										<td class="center">
											<a target="_blank" href="'. $GLOBALS['SLIDES_DIRECTORY'] . $eachRow['slider_file'] .'"> 
												<img src="'. $GLOBALS['SLIDES_DIRECTORY'] . $eachRow['slider_file'] .'" class="img-rounded" height="50px" width="160px" />
											</a>
										</td>
										<td>'. $eachRow['slider_sequence'] .'</td>
										<td class="center">
											<div class="row">
											<a data-id="'. $eachRow['id'] .'" class="btn btn-danger btn-xs deleteButton" href="#deleteModal" style="width: 76px;" data-toggle="modal">
												<i class="fa fa-trash-o"></i> Delete
											</a>
												<form method="post" action="edit-slider.php" style="display: inline;">
													<input type="hidden" name="id" value="'. $eachRow['id'] .'"/>
													<button name="try_edit" class="btn btn-warning btn-xs" style="width: 76px;" type="submit">
														<i class="fa fa-pencil-square"></i> Edit
													</button>
												</form>
											</div>
										</td>
									</tr>
									';
									$n++;
								}
							?>
								
							</tbody>
							<tfoot>
								<tr>
									<th> ID </th>
									<th> Title </th>
									<th> Status </th>
									<th> Image </th>
									<th> Sequence </th>
									<th> Action </th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!--=*= SLIDER LIST SECTION START =*=-->

<!--=*= DELETE MODAL =*=-->
<div class="modal small fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"> Delete Slider? </h4>
			</div>
			<div class="modal-body">
				<h5> Are you sure you want to delete this Slider? </h5>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default"data-dismiss="modal" aria-hidden="true"> Cancel </button> 
				<a href="#" class="btn btn-danger" id="modalDelete" > Delete </a>
			</div>
		</div>
	</div>
</div>
<!--=*= DELETE MODAL =*=-->


<!--=*= SCRIPT TO DELETE DATA =*=-->
<script>
	$('.deleteButton').click(function(){
		var id = $(this).data('id');
		
		$('#modalDelete').attr('href','list-slider.php?did='+id);
	})
</script>
<!--=*= SCRIPT TO DELETE DATA =*=-->