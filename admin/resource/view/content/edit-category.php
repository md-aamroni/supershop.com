<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$eloquent = new Eloquent;


## ===*=== [U]PDATE CATEGORY DATA ===*=== ##
if(isset($_POST['try_update']))
{
	$tableName = $columnValue = $whereValue = null;
	$tableName = "categories";
	$columnValue["category_name"] = $_POST['category_name'];
	$columnValue["category_status"] = $_POST['category_status'];
	$whereValue["id"] = $_SESSION['SMC_edit_category_id'];
	
	$updatecategoryData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}
## ===*=== [U]PDATE CATEGORY DATA ===*=== ##


## ===*=== [F]ETCH CATEGORY DATA ===*=== ##
if( isset($_POST['try_edit']) )
{
	#== CREATE A SESSION BASED ON ID
	$_SESSION['SMC_edit_category_id'] = $_POST['category_id'];
	
	$tableName = $columnName = $whereValue = null;
	$columnName = "*";
	$tableName = "categories";
	$whereValue["id"] = $_SESSION['SMC_edit_category_id'];
	$getcategoryData = $eloquent->selectData($columnName, $tableName, @$whereValue);
}
else
{
	$tableName = $columnName = $whereValue = null;
	$columnName = "*";
	$tableName = "categories";
	$whereValue["id"] = $_SESSION['SMC_edit_category_id'];
	$getcategoryData = $eloquent->selectData($columnName, $tableName, @$whereValue);
}
## ===*=== [F]ETCH CATEGORY DATA ===*=== ##
?>

<!--=*= EDIT CATEGORY SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<ul class="breadcrumb panel">
				<li> <a href="dashboard.php"> <i class="fa fa-home"></i> Home </a> </li>
				<li> <a href="dashboard.php"> Dashboard </a> </li>
				<li class="active"> Edit Category </li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					EDIT CATEGORY
				</header>
				<div class="panel-body">
					
					<?php 
						#== UPDATE CONFIRMATION MESSAGE
						if(isset($_POST['try_update']))
						{
							if($updatecategoryData > 0)
							{
								echo '<div class="alert alert-success fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button> 
											THE CATEGORY DATA IS <strong> UPDATED SUCCESSFULLY </strong>
										</div>';
							}
							else
							{
								echo '<div class="alert alert-warning fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button> 
											SOMETHING WENT WRONG TO UPDATE DATA! <strong> PLEASE RECHECK </strong>
										</div>';
							}
						}
					?>
					
					<div class="form">
						<form class="cmxform form-horizontal" id="signupForm" method="post" action="">
							<div class="form-group ">
								<label for="CategoryName" class="control-label col-lg-2"> Category Name </label>
								<div class="col-lg-7">
									<input class=" form-control" name="category_name" type="text" value="<?php echo $getcategoryData[0]['category_name']?>" />
								</div>
							</div>
							<div class="form-group ">
								<label for="CategoryStatus" class="control-label col-lg-2"> Category Status </label>
								<div class="col-lg-7">
									<select class="form-control m-bot15" name="category_status">
										<option <?php if($getcategoryData[0]['category_status'] == "Active") echo "selected";?>>Active</option>
										<option <?php if($getcategoryData[0]['category_status'] == "Inactive") echo "selected";?>>Inactive</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button name="try_update" class="btn btn-primary" type="submit"> Update </button>
									<a href="list-category.php" class="btn btn-default" style="text-decoration: none;"> Category List </a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!--=*= EDIT CATEGORY SECTION END =*=-->		