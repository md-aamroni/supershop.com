<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;


## ===*=== [F]ETCH CATEGORY DATA ===*=== ##
$tableName = $columnName = null;
$columnName = "*";
$tableName = "categories";
$categoryList = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH CATEGORY DATA ===*=== ##


## ===*=== [I]NSERT SUBCATEGORY DATA ===*=== ##
if (isset($_POST['create_subcategory'])) 
{
	#== IMAGE FILE VALIDATION
	if( $control->checkImage(@$_FILES['subcategory_banner']['type'], @$_FILES['subcategory_banner']['size'], @$_FILES['subcategory_banner']['error']) == 1)
	{
		#== NEW IMAGE FILE NAME GENERATE
		$filename = "SUBCATBANNER_" . date("YmdHis") . "_" . $_FILES['subcategory_banner']['name'];
		
		$tableName = $columnValue = null;
		$tableName = "subcategories";
		$columnValue["subcategory_name"] = $_POST['subcategory_name'];
		$columnValue["category_id"] = $_POST['category_id'];
		$columnValue["subcategory_status"] = $_POST['subcategory_status'];
		$columnValue["subcategory_banner"] = $filename;
		$columnValue["created_at"] = date("Y-m-d H:i:s");
		$createSubcategory = $eloquent->insertData($tableName, $columnValue);
		
		if($createSubcategory > 0)
		{
			#== ADD IMAGE TO THE DIRECTORY
			move_uploaded_file($_FILES['subcategory_banner']['tmp_name'], $GLOBALS['BANNER_DIRECTORY'] . $filename);
		}
	}
}
## ===*=== [I]NSERT SUBCATEGORY DATA ===*=== ##
?>

<!--=*= CREATE SUBCATEGORY SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<ul class="breadcrumb panel">
				<li> <a href="dashboard.php"><i class="fa fa-home"></i> Home </a> </li>
				<li> <a href="dashboard.php"> Dashboard </a> </li>
				<li class="active"> Create Sub Category </li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					CREATE A NEW SUB CATEGORY
				</header>
				<div class="panel-body">
					
					<?php 
						#== INSERT CONFIRMATION MESSAGE
						if (isset($_POST['create_subcategory'])) 
						{
							if (@$createSubcategory > 0)
							{
								echo '<div class="alert alert-success fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											THE SUBCATEGORY DATA IS <strong> INSERTED SUCCESSFULLY </strong>
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
						<form class="form-horizontal" id="subCategory" method="post" action="" enctype="multipart/form-data">
							<div class="form-group ">
								<label for="SubCategoryName" class="control-label col-lg-2">Sub Category Name</label>
								<div class="col-lg-7">
									<input class="form-control" id="subcategory_name" name="subcategory_name" type="text" />
								</div>
							</div>
							<div class="form-group ">
								<label for="CategoryName" class="control-label col-lg-2">Main Category Name</label>
								<div class="col-lg-7">
									<select name="category_id" id="category_id" class="form-control">
										<option>Select a Category</option>
										
										<?php
											#== CATEGORY DATA
											foreach($categoryList as $eachRow)
											{
												echo '<option value="'. $eachRow['id'] .'">'. $eachRow['category_name'] .'</option>' ;
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
											<input name="subcategory_banner" type="file" class="default" onchange="readURL(this);" set-to="div5" required />
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
											<img src="http://www.placehold.it/400x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" id="div5" style="width: 100%; height: 100%;"/>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group ">
								<label for="SubCategoryStatus" class="control-label col-lg-2"> Sub-Category Status </label>
								<div class="col-lg-7">
									<select name="subcategory_status" class="form-control m-bot15">
										<option> Active </option>
										<option> Inactive </option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button name="create_subcategory" class="btn btn-success" type="submit"> Save </button>
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
<!--=*= CREATE SUBCATEGORY SECTION START =*=-->		