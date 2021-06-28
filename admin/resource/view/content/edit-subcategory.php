<?php	
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;


## ===*=== [U]PDATE SUBCATEGORY DATA ===*=== ##
if(isset($_POST['try_update']))
{
	#== CREATE A SESSION BASED ON ID
	$_SESSION['SMC_edit_subcategory_id'] = $_POST['id'];
	
	if(empty($_FILES['subcategory_banner']['name']))
	{
		#== IF UPADATE WIHTOUT SLIDER IMAGE
		$tableName = $columnValue = $whereValue = null;
		$tableName = "subcategories";
		$columnValue["subcategory_name"] = $_POST['subcategory_name'];
		$columnValue["category_id"] = $_POST['category_id'];
		$columnValue["subcategory_status"] = $_POST['subcategory_status'];
		$whereValue["id"] = $_SESSION['SMC_edit_subcategory_id'];
		
		$updatesubcategoryData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
	} 
	else 
	{
		#== IF UPDATE WITH SLIDER IMAGE 
		if( $control->checkImage(@$_FILES['subcategory_banner']['type'], @$_FILES['subcategory_banner']['size'], @$_FILES['subcategory_banner']['error']) == 1)
		{
			#== NEW IMAGE FILE NAME GENERATE
			$filename = "SUBCATBANNER__" . date("YmdHis") . "_" . $_FILES['subcategory_banner']['name'];
			
			$tableName = $columnValue = $whereValue = null;
			$tableName = "subcategories";
			$columnValue["subcategory_name"] = $_POST['subcategory_name'];
			$columnValue["category_id"] = $_POST['category_id'];
			$columnValue["subcategory_status"] = $_POST['subcategory_status'];
			$columnValue["subcategory_banner"] = $filename;
			$whereValue["id"] = $_SESSION['SMC_edit_subcategory_id'];
			$updatesubcategoryData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
			
			if($updatesubcategoryData > 0)
			{
				#== ADD IMAGE TO THE DIRECTORY
				move_uploaded_file($_FILES['subcategory_banner']['tmp_name'], $GLOBALS['BANNER_DIRECTORY'] . $filename);
				
				#== REMOVE IMAGE FROM THE DIRECTORY
				unlink($_SESSION['SMC_edit_subcategory_banner_file_old']);
			}
		}
	}		
}
## ===*=== [U]PDATE SUBCATEGORY DATA ===*=== ##


## ===*=== WHEN USER IS COMING FROM "SUBCATEGORY LIST" PAGE WITH AN "ID" HOLD THAT ID IN A SESSION VARIABLE ===*=== ##
if(isset($_POST['edit_subcategory_id']))
{
	$_SESSION['SMC_edit_subcategory_id'] = $_POST['edit_subcategory_id'];
}


## ===*=== [G]ET EXISTING SUBCATEGORY DATA ===*=== ##
$tableName = $columnName = $joinType = $onCondition = $whereValue = null;
$columnName["1"] = "subcategories.subcategory_name";
$columnName["2"] = "subcategories.subcategory_status";
$columnName["3"] = "subcategories.subcategory_banner";
$columnName["4"] = "subcategories.category_id";
$columnName["5"] = "subcategories.id";
$tableName["MAIN"] = "subcategories";
$joinType = "INNER";
$tableName["1"] = "categories";
$onCondition["1"] = ["subcategories.category_id", "categories.id"];
$whereValue["subcategories.id"] = $_SESSION['SMC_edit_subcategory_id'];
$getsubcategoryData = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue);

#== CREATE A SESSION FOR EXISTING SUBCATEGORY BANNER IMAGE
$_SESSION['SMC_edit_subcategory_banner_file_old'] = $GLOBALS['BANNER_DIRECTORY'] . $getsubcategoryData[0]['subcategory_banner']; 
## ===*=== [G]ET EXISTING SUBCATEGORY DATA ===*=== ##


## ===*=== [L]OAD CATEGORY DATA===*=== ##
$tableName = $columnName = null;
$columnName = "*";
$tableName = "categories";
$categoryList = $eloquent->selectData($columnName, $tableName);
## ===*=== [L]OAD CATEGORY DATA===*=== ##
?>

<!--=*= EDIT SUBCATEGORY SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<ul class="breadcrumb panel">
				<li> <a href="dashboard.php"> <i class="fa fa-home"></i> Home </a> </li>
				<li> <a href="dashboard.php"> Dashboard </a> </li>
				<li class="active"> Edit Sub Category </li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					EDIT SUB CATEGORY
				</header>
				<div class="panel-body">
					
					<?php 
						#== UPDATE CONFIRMATION MESSAGE
						if (isset($_POST['try_update'])) 
						{
							if (@$updatesubcategoryData > 0)
							{
								echo '<div class="alert alert-success fade in">
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											THE SUBCATEGORY DATA IS <strong> UPDATED SUCCESSFULLY </strong>
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
						<form class="form-horizontal" id="subCategory" method="post" action="" enctype="multipart/form-data">
							<div class="form-group ">
								<label for="SubCategoryName" class="control-label col-lg-2"> Sub Category Name </label>
								<div class="col-lg-7">
									<input class=" form-control" id="subcategory_name" name="subcategory_name" type="text" value="<?php echo $getsubcategoryData[0]['subcategory_name'];?>"/>
								</div>
							</div>
							<div class="form-group ">
								<label for="MainCategoryName" class="control-label col-lg-2"> Main Category Name </label>
								<div class="col-lg-7">
									<select name="category_id" id="category_id" class="form-control">
										<option> Select a Category </option>
										
										<?php
											#== CATEGORY DATA
											foreach($categoryList as $eachRow)
											{
												echo '<option value="'. $eachRow['id'] .'"'; 
												if($eachRow['id'] == $getsubcategoryData[0]['category_id'])		
												{
													echo 'selected';
												}
												echo ' >'. $eachRow['category_name'] .'</option>' ;
											}
										?>
										
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="SubCatBanner" class="control-label col-md-2 "> Sub Category Banner </label>
								<div class="controls col-md-9">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<span class="btn btn-default btn-file">
											<input name="subcategory_banner" type="file" class="default" onchange="readURL(this);" set-to="div6" value="<?= $getsubcategoryData[0]['subcategory_banner'] ?>"/>
										</span>
										<span class="fileupload-preview" style="margin-left:5px;"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
									</div>
								</div>
							</div>
							<div class="form-group last">
								<label for="BannerPreview" class="control-label col-md-2"> Sub Category Preview </label>
								<div class="col-md-9">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail" style="width: 400px; height: 200px;">
											<img src="<?= $GLOBALS['BANNER_DIRECTORY'] . $getsubcategoryData[0]['subcategory_banner'] ?>" alt="" id="div6" style="width: 100%; height: 100%;"/>
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-group ">
								<label for="status" class="control-label col-lg-2">Sub Category Status</label>
								<div class="col-lg-7">
									<select name="subcategory_status" class="form-control">
										<option <?php if($getsubcategoryData[0]['subcategory_status'] == "Active") echo "selected";?>> Active </option>
										<option <?php if($getsubcategoryData[0]['subcategory_status'] == "Inactive") echo "selected";?>> Inactive </option>
									</select>
								</div>
							</div>
							<input type="hidden" name="id" value="<?php echo $getsubcategoryData[0]['id']; ?>" >
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button name="try_update" class="btn btn-primary" type="submit"> Update </button>
									<a href="list-subcategory.php" class="btn btn-default" style="text-decoration: none;"> SubCategory List </a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!--=*= EDIT SUBCATEGORY SECTION END =*=-->																										