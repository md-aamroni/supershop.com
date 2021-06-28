<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$eloquent = new Eloquent;


## ===*=== [I]NSERT CATEGORY DATA ===*=== ##
if( isset($_POST['create_category']) )
{
	if(!empty($_POST['category_name']) && !empty($_POST['category_status']))
	{
		$tableName = $columnValue = null;
		$tableName = "categories";
		$columnValue["category_name"] = $_POST['category_name'];
		$columnValue["category_status"] = $_POST['category_status'];
		$createCategory = $eloquent->insertData($tableName, $columnValue);
	}
}
## ===*=== [I]NSERT CATEGORY DATA ===*=== ##
?>

<!--=*= CREATE CATEGORY SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<ul class="breadcrumb panel">
				<li> <a href="dashboard.php"> <i class="fa fa-home"></i> Home </a> </li>
				<li> <a href="dashboard.php"> Dashboard </a> </li>
				<li class="active"> Create Category </li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					CREATE A NEW CATEGORY
				</header>
				<div class="panel-body">
					
					<?php 
						#== INSERT CONFIRMATION MESSAGE
						if(isset($_POST['create_category']))
						{
							if(@$createCategory > 0)
							{
								echo '<div class="alert alert-success fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											THE CATEGORY DATA IS <strong> INSERTED SUCCESSFULLY </strong>
										</div>';
							}
							else
							{
								echo '<div class="alert alert-warning fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button> 
											SOMETHING WENT WRONG TO INSERT DATA! <strong> PLEASE RECHECK </strong>
										</div>';
							}
						}
					?>
					
					<div class="form">
						<form class="cmxform form-horizontal" id="signupForm" method="post" action="">
							<div class="form-group ">
								<label for="CategoryName" class="control-label col-lg-2"> Category Name </label>
								<div class="col-lg-7">
									<input class=" form-control" name="category_name" type="text"/>
								</div>
							</div>
							<div class="form-group ">
								<label for="CategoryStatus" class="control-label col-lg-2"> Category Status </label>
								<div class="col-lg-7">
									<select class="form-control m-bot15" name="category_status">
										<option value="Active"> Active </option>
										<option value="Inactive"> Inactive </option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button name="create_category" class="btn btn-success" type="submit"> Save </button>
									<button class="btn btn-default" type="reset"> Reset </button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!--=*= CREATE CATEGORY SECTION END =*=-->