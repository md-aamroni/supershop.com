<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/AdminController.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$adminCtrl = new AdminController;
$eloquent = new Eloquent;


## ===*=== [I]NSERT ADMIN DATA ===*=== ##
if( isset($_POST['create_admin']) )
{	
	#== NEW IMAGE FILE NAME GENERATE
	$adminfileName = "ADMINIMAGE_" . date("YmdHis") . "_" . $_FILES['admin_image']['name'];
	
	#== IMAGE FILE VALIDATION
	if($control->checkImage(@$_FILES['admin_image']['type'], @$_FILES['admin_image']['size'], @$_FILES['admin_image']['error']) == 1)
	{
		$saveResult = $adminCtrl->createAdminData($_POST['admin_name'], $_POST['admin_email'], $adminfileName, sha1($_POST['admin_password']), $_POST['admin_type'], $_POST['admin_status']);
		
		if(@$saveResult > 0)
		{
			#== ADD IMAGE TO THE DIRECTORY
			move_uploaded_file($_FILES['admin_image']['tmp_name'], $GLOBALS['ADMINS_DIRECTORY'] . $adminfileName);
		}
	}
}
## ===*=== [I]NSERT ADMIN DATA ===*=== ##
?>

<!--=*= CREATE ADMIN SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<ul class="breadcrumb panel">
            <li> <a href="dashboard.php"> <i class="fa fa-home"></i> Home </a> </li>
            <li> <a href="dashboard.php"> Dashboard </a> </li>
				<li class="active"> Create Admin </li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					New Admin Registration Form
				</header>
				<div class="panel-body">
					
					<?php 
						#== INSERT CONFIRMATION MESSAGE
						if(isset($_POST['create_admin']))
						{	
							if(@$saveResult > 0)
							{
								echo '<div class="alert alert-success fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											THE ADMIN DATA IS <strong> INSERTED SUCCESSFULLY </strong>
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
						<form class="cmxform form-horizontal" method="post" action="" enctype="multipart/form-data">
							<div class="form-group ">
								<label for="AdminName" class="control-label col-lg-2"> Admin Name </label>
								<div class="col-lg-7">
									<input class=" form-control" name="admin_name" type="text" required />
								</div>
							</div>
							<div class="form-group ">
								<label for="AdminEmail" class="control-label col-lg-2"> Admin Email </label>
								<div class="col-lg-7">
									<input class="form-control "name="admin_email" type="email" autocomplete="none" required />
								</div>
							</div>
							<div class="form-group ">
								<label for="AdminPassword" class="control-label col-lg-2"> Admin Password </label>
								<div class="col-lg-7">
									<input class="form-control" name="admin_password" type="password" autocomplete="none" required />
								</div>
							</div>
							<div class="form-group ">
								<label for="AdminType" class="control-label col-lg-2"> Admin Type </label>
								<div class="col-lg-7">
									<select name="admin_type" class="form-control">
										<option value="">Select a Type</option>
										<option value="Root Admin"> Root Admin </option>
										<option value="Content Manager"> Content Manager </option>
										<option value="Sales Manager"> Sales Manager </option>
										<option value="Technical Operator"> Technical Operator </option>
									</select>
								</div>
							</div>							
							<div class="form-group ">
								<label for="AdminStatus" class="control-label col-lg-2"> Admin Status </label>
								<div class="col-lg-7">
									<select name="admin_status" class="form-control m-bot15">
										<option value="Active"> Active </option>
										<option value="Inactive"> Inactive </option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="AdminImage" class="control-label col-md-2"> Admin Image </label>
								<div class="controls col-lg-7">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<span class="btn btn-default btn-file">
											<input name="admin_image" type="file" class="default" onchange="readURL(this);" set-to="div1" required />
										</span>
										<span class="fileupload-preview" style="margin-left:5px;"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
									</div>
								</div>
							</div>
							<div class="form-group last">
								<label for="AdminImagePreview" class="control-label col-md-2"> Admin Image Preview </label>
								<div class="col-lg-7">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail" style="width: 156px; height: 156px;">
											<img src="http://www.placehold.it/156x156/EFEFEF/AAAAAA&amp;text=no+image" alt="" id="div1" style="width: 100%; height: 100%;"/>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button name="create_admin" class="btn btn-success" type="submit"> Save </button>
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
<!--=*= CREATE ADMIN SECTION START =*=-->		