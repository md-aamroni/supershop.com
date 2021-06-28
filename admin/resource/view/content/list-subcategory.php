<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$eloquent = new Eloquent;


## ===*=== [D]ELETE SUBCATEGORY DATA ===*=== ##
if(isset($_REQUEST['did']))
{
	#== GET EXISTING SUBCATEGORY DATA
	$tableName = $columnName = $whereValue = null;
	$columnName = "*";
	$tableName = "subcategories";
	$whereValue["id"] = $_REQUEST['did'];
	$getsubcategoryData = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	#== DELETE SUBCATEGORY DATA
	$tableName = $whereValue = null;
	$tableName = "subcategories";
	$whereValue["id"] = $_REQUEST['did'];
	$deletesubcategoryData = $eloquent->getsubcategoryData($tableName, $whereValue);
}
## ===*=== [D]ELETE SUBCATEGORY DATA ===*=== ##


## ===*=== [C]HANGE SUBCATEGORY STATUS ===*=== ##
if(isset($_POST['change_status']))
{
	$tableName = $columnValue = $whereValue = null;
	$tableName = "subcategories";
	$whereValue["id"] = $_POST['subcat_status_id'];
	
	if($_POST['current_status']  == "Active")
	{
		$columnValue["subcategory_status"] = "Inactive";
	}		
	else if($_POST['current_status']  == "Inactive")
	{
		$columnValue["subcategory_status"] = "Active";
	}
	
	$changesubcategoryStatus = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}
## ===*=== [C]HANGE SUBCATEGORY STATUS ===*=== ##


## ===*=== [F]ETCH SUBCATEGORY STATUS ===*=== ##
$tableName = $columnName = $onCondition = $joinType = null;
$columnName["1"] = "subcategories.id";
$columnName["2"] = "subcategories.subcategory_name";
$columnName["3"] = "subcategories.subcategory_status";
$columnName["4"] = "subcategories.subcategory_banner";
$columnName["5"] = "categories.category_name";
$tableName["MAIN"] = "subcategories";
$joinType = "INNER";
$tableName["1"] = "categories";
$onCondition["1"] = ["subcategories.category_id", "categories.id"];
$subcategoryList = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition);
## ===*=== [F]ETCH SUBCATEGORY STATUS ===*=== ##
?>

<!--=*= SUBCATEGORY LIST SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-sm-12">
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">Sub Category List</li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					SUBCATEGORY LIST
				</header>
				<div class="panel-body">
					
					<?php
						#== DELETE CONFIRMATION MESSAGE
						if(isset($_REQUEST['did']))
						{
							if($deletesubcategoryData > 0)
							{
								echo '<div class="alert alert-success fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											THE SUBCATEGORY DATA IS <strong> DELETED SUCCESSFULLY </strong>
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
						if( isset($_POST['change_status']) )
						{
							if($changesubcategoryStatus > 0)
							{
								echo '<div class="alert alert-success fade in"> <button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button> SubCategory status is changed successfully. </div>';
							}
							else
							{
								echo '<div class="alert alert-warning fade in"> <button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button> Something went wrong to change this status! Please recheck. </div>';
							}
						}
					?>
					
					<div class="adv-table">
						<table class="display table table-bordered table-striped" id="dynamic-table">
							<thead>
								<tr>
									<th style="width:2%"> ID </th>
									<th style="width:20%"> Category Name </th>
									<th style="width:30%"> SubCategory Name </th>
									<th style="width:12%"> Status </th>
									<th style="width:20%"> SubCategory Banner </th>
									<th style="width:16%"> Action </th>
								</tr>
							</thead>
							<tbody>
								
							<?php
								#== SUBCATEGORY DATA TABLE
								$n = 1;
								foreach ($subcategoryList as $eachRow) 
								{
									echo '
									<tr class="gradeA">
										<td>'. $n .'</td>
										<td>'. $eachRow["category_name"] .'</td>
										<td>'. $eachRow["subcategory_name"] .'</td>
										<td class="center">
											<form method="post" action="">
												<input type="hidden" name="subcat_status_id" value="'. $eachRow["id"] .'"/>
												<input type="hidden" name="current_status" value="'. $eachRow["subcategory_status"] .'"/>
												<button name="change_status" class="btn btn-info btn-xs" style="width: 76px;" type="submit">'. $eachRow["subcategory_status"] .'</button>
											</form>
										</td>
										<td class="text-center">
											<a target="_blank" href="'. $GLOBALS['BANNER_DIRECTORY'] . $eachRow['subcategory_banner'] .'"> 
												<img src="'. $GLOBALS['BANNER_DIRECTORY'] . $eachRow['subcategory_banner'] .'" class="img-rounded" height="40px" width="180px" />
											</a>
										</td>
										<td class="center">
											<div class="row">
												<a data-id="'. $eachRow["id"] .'" href="#deleteModal" class="btn btn-danger btn-xs float-right deleteButton" style="width: 76px;" data-toggle="modal">
													<i class="fa fa-trash-o"></i> Delete
												</a>
												<form method="post" action="edit-subcategory.php" style="display: inline">
													<input type="hidden" name="edit_subcategory_id" value="'. $eachRow["id"] .'"/>
													<button name="edit_subcategory" class="btn btn-warning btn-xs" style="width: 76px;" type="submit">
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
									<tr>
										<th> ID </th>
										<th> Category Name </th>
										<th> SubCategory Name </th>
										<th> Status </th>
										<th> SubCategory Banner </th>
										<th> Action </th>
									</tr>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!--=*= SUBCATEGORY LIST SECTION END =*=-->


<!--=*= DELETE MODAL =*=-->
<div class="modal small fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"> Delete Sub Category? </h4>
			</div>
			<div class="modal-body">
				<h5> Are you sure you want to delete this SubCategory? </h5>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal" aria-hidden="true"> Cancel </button>
				<a href="list-category.php" class="btn btn-danger" id="modalDelete"> Delete </a>
			</div>
		</div>
	</div>
</div>
<!--=*= DELETE MODAL =*=-->


<!--=*= SCRIPT TO DELETE DATA =*=-->
<script type="text/javascript">
	$('.deleteButton').click(function() {
		var id = $(this).data('id');
		
		$('#modalDelete').attr('href', 'list-subcategory.php?did=' + id);
	})
</script>
<!--=*= SCRIPT TO DELETE DATA =*=-->