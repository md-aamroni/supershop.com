<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;


## ===*=== [U]PDATE PAGES DATA ===*=== ##
if(isset($_POST['update_pages']))
{
	$tableName = $columnValue = $whereValue = null;
	$tableName = "pages";
	$columnValue["page_title"] = $_POST['pageTitle'];
	$columnValue["meta_keyword"] = $_POST['metaKeyword'];
	$columnValue["meta_description"] = $_POST['metaDescription'];
	$columnValue["page_status"] = $_POST['pageStatus'];
	$columnValue["updated_at"] = date('Y-m-d');
	$whereValue['id'] = $_SESSION['EDIT_PAGES_ID'];
	$updatePages = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}
## ===*=== [U]PDATE PAGES DATA ===*=== ##


## ===*=== [F]ETCH PAGES DATA ===*=== ##
if(isset($_POST['id']))
{
	$_SESSION['EDIT_PAGES_ID'] = $_POST['id'];
}
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "pages";
$whereValue['id'] = $_SESSION['EDIT_PAGES_ID'];
$getPagesData = $eloquent->selectData($columnName, $tableName, @$whereValue);
## ===*=== [F]ETCH PAGES DATA ===*=== ##
?>

<!--=*= CREATE PAGES SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<ul class="breadcrumb panel">
            <li> <a href="dashboard.php"> <i class="fa fa-home"></i> Home </a> </li>
            <li> <a href="dashboard.php"> Dashboard </a> </li>
				<li class="active"> SEO </li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					Search Engine Optimization Details
				</header>
				<div class="panel-body">
					
					<?php 
						#== UPDATE CONFIRMATION MESSAGE
						if(isset($_POST['update_pages']))
						{	
							if(@$updatePages > 0)
							{
								echo '<div class="alert alert-success fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											THE PAGES DATA IS <strong> UPDATED SUCCESSFULLY </strong>
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
						<form class="cmxform form-horizontal" method="post" action="" enctype="multipart/form-data">
							<div class="form-group ">
								<label for="AdminName" class="control-label col-lg-2"> Page Title </label>
								<div class="col-lg-7">
									<input class="form-control" name="pageTitle" type="text" value="<?php echo $getPagesData[0]['page_title']?>" required />
								</div>
							</div>
							<div class="form-group ">
								<label for="AdminEmail" class="control-label col-lg-2"> Meta Keyword </label>
								<div class="col-lg-7">
									<input class="form-control "name="metaKeyword" type="text" value="<?php echo $getPagesData[0]['meta_keyword']?>" autocomplete="none" required />
								</div>
							</div>
							<div class="form-group ">
								<label for="AdminPassword" class="control-label col-lg-2"> Meta Description </label>
								<div class="col-lg-7">
									<textarea class="form-control" name="metaDescription" type="text" autocomplete="none" required><?php echo $getPagesData[0]['meta_description']?></textarea>
								</div>
							</div>						
							<div class="form-group ">
								<label for="AdminStatus" class="control-label col-lg-2"> Page Status </label>
								<div class="col-lg-7">
									<select name="pageStatus" class="form-control m-bot15">
										<option <?php if($getPagesData[0]['page_status'] == 'Active') echo 'selected'; ?>> Active </option>
										<option <?php if($getPagesData[0]['page_status'] == 'Inactive') echo 'selected'; ?>> Inactive </option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button name="update_pages" class="btn btn-success" type="submit"> Update </button>
									<a href="pages-details.php" class="btn btn-default" style="text-decoration: none;"> Page Deatils </a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!--=*= CREATE PAGES SECTION END =*=-->		