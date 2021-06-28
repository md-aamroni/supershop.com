<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/AdminController.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$adminCtrl = new AdminController;
$eloquent = new Eloquent;


## ===*=== [U]PDATE ADMIN DATA ===*=== ##
if(isset($_POST['try_update']))
{
	#== IF UPDATE DATA WITHOUT IMAGE
	if(empty($_FILES['admin_image']['name']))
	{
		$adminUpdate = $adminCtrl->updateAdminData($_POST['admin_id'], $_POST['admin_name'], $_POST['admin_email'], $_POST['admin_type'], $_POST['admin_status']);
	}
	
	#== IF UPDATA DATA WITH IMAGE
	else
	{
		$adminfileName = "ADMINIMAGE_" . date("YmdHis") . "_" . $_FILES['admin_image']['name'];
		
		if($control->checkImage(@$_FILES['admin_image']['type'], @$_FILES['admin_image']['size'], @$_FILES['admin_image']['error']) == 1)
		{
			$adminUpdate = $adminCtrl->editAdminData($_POST['admin_id'], $_POST['admin_name'], $_POST['admin_email'], $adminfileName, $_POST['admin_type'], $_POST['admin_status']);		
			
			if($adminUpdate > 0)
			{
				#== ADD IMAGE TO THE DIRECTORY
				move_uploaded_file($_FILES['admin_image']['tmp_name'], $GLOBALS['ADMINS_DIRECTORY'] . $adminfileName);
				
				#== REMOVE IMAGE FROM THE DIRECTORY
				unlink($_SESSION['SMC_old_admin_image_file']);
			}
		}
	}
}
## ===*=== [U]PDATE ADMIN DATA ===*=== ##


## ===*=== [F]ETCH ADMIN DATA ===*=== ##
if( isset($_POST['try_edit']) )
{
	#== CREATE A SESSION BASED ON ID
	$_SESSION['SMC_edit_admin_id'] = $_POST['id'];
	
	$adminData = $adminCtrl->getAdminData($_SESSION['SMC_edit_admin_id']);
}
else
{
	$adminData = $adminCtrl->getAdminData($_SESSION['SMC_edit_admin_id']);
}

#== CREATE AN SESSION FOR IMAGE
$_SESSION['SMC_old_admin_image_file'] = $GLOBALS['ADMINS_DIRECTORY'] . $adminData[0]['admin_image'];
## ===*=== [F]ETCH ADMIN DATA ===*=== ##
?>

<!--=*= EDIT ADMIN SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<ul class="breadcrumb panel">
				<li> <a href="dashboard.php"> <i class="fa fa-home"></i> Home </a> </li>
				<li> <a href="dashboard.php"> Dashboard </a> </li>
				<li class="active"> Edit Admin </li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					Edit Admin Registration Form
				</header>
				<div class="panel-body">
					
					<?php 
						#== UPDATE CONFIRMATION MESSAGE
						if(isset($_POST['try_update']))
						{
							if(@$adminUpdate > 0)
							{
								echo '<div class="alert alert-success fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											THE ADMIN DATA IS <strong> UPDATED SUCCESSFULLY </strong>
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
								<label for="AdminName" class="control-label col-lg-2"> Admin Name </label>
								<div class="col-lg-7">
									<input class=" form-control" name="admin_name" type="text" value="<?php echo $adminData[0]['admin_name']; ?>" />
								</div>
							</div>
							<div class="form-group ">
								<label for="email" class="control-label col-lg-2"> Admin Email </label>
								<div class="col-lg-7">
									<input class="form-control " name="admin_email" type="email" value="<?php echo $adminData[0]['admin_email']; ?>" />
								</div>
							</div>
							<div class="form-group ">
								<label for="AdminType" class="control-label col-lg-2"> Admin Status </label>
								<div class="col-lg-7">
									<select class="form-control" name="admin_type">
										<option <?php if($adminData[0]['admin_type'] == "Root Admin") echo "selected"; ?>> Root Admin </option>
										<option <?php if($adminData[0]['admin_type'] == "Content Manager") echo "selected"; ?>> Content Manager </option>
										<option <?php if($adminData[0]['admin_type'] == "Sales Manager") echo "selected"; ?>> Sales Manager </option>
										<option <?php if($adminData[0]['admin_type'] == "Technical Operator") echo "selected"; ?>> Technical Operator </option>
									</select>
								</div>
							</div>							
							<div class="form-group ">
								<label for="AdminStatus" class="control-label col-lg-2"> Admin Status </label>
								<div class="col-lg-7">
									<select class="form-control m-bot15" name="admin_status">
										<option <?php if($adminData[0]['admin_status'] == "Active") echo "selected"; ?>> Active </option>
										<option <?php if($adminData[0]['admin_status'] == "Inactive") echo "selected"; ?>> Inactive </option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="AdminImage" class="control-label col-md-2 "> Admin Image </label>
								<div class="controls col-lg-7">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<span class="btn btn-default btn-file">
											<input name="admin_image" type="file" class="default" onchange="readURL(this);" set-to="div2" />
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
											<img src="<?php echo $GLOBALS['ADMINS_DIRECTORY'] . $adminData[0]['admin_image']; ?>" alt="" id="div2" style="width: 100%; height: 100%;"/>
										</div>
									</div>
								</div>
							</div>
							<input type="hidden" name="admin_id" value="<?php echo $adminData[0]['id']; ?>"/>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button name="try_update" class="btn btn-primary" type="submit"> Update </button>
									<a href="list-admin.php" class="btn btn-default" style="text-decoration: none;"> Admin List </a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!--=*= EDIT ADMIN SECTION END =*=-->								