<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;


## ===*=== [U]PDATE SLIDER DATA===*=== ##
if(isset($_POST['try_update']))
{
	if(empty($_FILES['slider_file']['name']))
	{
		# IF UPADATE WIHTOUT SLIDER IMAGE
		$tableName = $columnValue = $whereValue = null;
		$tableName = "slides";
		$columnValue["slider_title"] = $_POST['slider_title'];
		$columnValue["slider_status"] = $_POST['slider_status'];
		$whereValue["slider_sequence"] = $_POST['slider_sequence'];
		$columnValue["slider_sequence"] = $_POST['slider_sequence'];
		$whereValue["id"] = $_SESSION['SMC_edit_slider_id'];
		$updatesliderData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
	}
	else
	{
		# IF UPDATE WITH SLIDER IMAGE 
		if( $control->checkImage(@$_FILES['slider_file']['type'], @$_FILES['slider_file']['size'], @$_FILES['slider_file']['error']) == 1)
		{
			$filename = "SLIDER_" . date("YmdHis") . "_" . $_FILES['slider_file']['name'];
			
			$tableName = $columnValue = $whereValue = null;
			$tableName = "slides";
			$columnValue["slider_title"] = $_POST['slider_title'];
			$columnValue["slider_file"] = $filename;
			$columnValue["slider_status"] = $_POST['slider_status'];
			$whereValue["slider_sequence"] = $_POST['slider_sequence'];
			$columnValue["slider_sequence"] = $_POST['slider_sequence'];
			$whereValue["id"] = $_SESSION['SMC_edit_slider_id'];
			$updatesliderData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
			
			if($updatesliderData > 0)
			{
				move_uploaded_file($_FILES['slider_file']['tmp_name'], $GLOBALS['SLIDES_DIRECTORY'] . $filename);
				unlink($_SESSION['SMC_edit_slider_slider_file_old']);
			}
		}
	}
}
## ===*=== [U]PDATE SLIDER DATA===*=== ##


## ===*=== [F]ETCH SLIDER DATA===*=== ##
if( isset($_POST['try_edit']) )
{
	#== CREATE A SESSION BASED ON ID
	$_SESSION['SMC_edit_slider_id'] = $_POST['id'];
	
	$tableName = $columnName = $whereValue = null;
	$columnName = "*";
	$tableName = "slides";
	$whereValue["id"] = $_SESSION['SMC_edit_slider_id'];
	$queryResult = $eloquent->selectData($columnName, $tableName, @$whereValue);
}
else
{
	$tableName = $columnName = $whereValue = null;
	$columnName = "*";
	$tableName = "slides";
	$whereValue["id"] = $_SESSION['SMC_edit_slider_id'];
	$queryResult = $eloquent->selectData($columnName, $tableName, @$whereValue);
}

#== CREATE A SESSION FOR EXISTING SLIDER IMAGE
$_SESSION['SMC_edit_slider_slider_file_old'] = $GLOBALS['SLIDES_DIRECTORY'] . $queryResult[0]['slider_file']; 
## ===*=== [F]ETCH SLIDER DATA===*=== ##
?>

<!--=*= EDIT SLIDER SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<ul class="breadcrumb panel">
				<li> <a href="dashboard.php"> <i class="fa fa-home"></i> Home</a> </li>
				<li> <a href="dashboard.php">Dashboard </a> </li>
				<li class="active"> Edit Slider </li>
			</ul>
			<section class="panel"> 
				<header class="panel-heading">
					Edit Slider Registration Form
				</header>
				<div class="panel-body">
					
					<?php 
						#== UPDATE CONFIRMATION MESSAGE
						if(isset($_POST['try_update']))
						{
							if($queryResult > 0)
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
											SOMETHING WENT WRONG TO UPDATE DATA! <strong> PLEASE RECHECK </strong>
										</div>';
							}
						}
					?>
					
					<div class="form">
						<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label for="SliderTitle" class="col-lg-2 col-sm-2 control-label"> Slider Title </label>
								<div class="col-lg-7">
									<input name="slider_title" value="<?= $queryResult[0]['slider_title'] ?>" type="text" class="form-control" required >
								</div>
							</div>
							<div class="form-group">
								<label for="SliderImage" class="control-label col-md-2 "> Slider Image </label>
								<div class="controls col-md-9">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<span class="btn btn-default btn-file">
											<input name="slider_file" type="file" class="default" onchange="readURL(this);" set-to="div4" value="<?php echo $queryResult[0]['slider_file']; ?>"/>
										</span>
										<span class="fileupload-preview" style="margin-left:5px;"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
									</div>
								</div>
							</div>
							<div class="form-group last">
								<label for="SliderPreview" class="control-label col-md-2"> Slider Preview </label>
								<div class="col-md-9">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail" style="width: 400px; height: 200px;">
											<img style="height: 100%; width: 100%;" src="<?= $GLOBALS['SLIDES_DIRECTORY'] . $queryResult[0]['slider_file'] ?>" alt="" id="div4" />
										</div>
									</div>
									<br/>
								</div>
							</div>
							<div class="form-group">
								<label for="SliderSequence" class="col-lg-2 col-sm-2 control-label">Slider Sequence</label>
								<div class="col-lg-7">
									<input name="slider_sequence" value="<?= $queryResult[0]['slider_sequence'] ?>" type="number" class="form-control">
								</div>
							</div>
							<div class="form-group ">
								<label for="SliderStatus" class="control-label col-lg-2"> Slider Status </label>
								<div class="col-lg-7">
									<select class="form-control m-bot15" name="slider_status">
										<option <?php if($queryResult[0]['slider_status'] == "Active") echo "selected"; ?>> Active </option>
										<option <?php if($queryResult[0]['slider_status'] == "Inactive") echo "selected"; ?>> Inactive </option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button name="try_update" class="btn btn-primary" type="submit"> Update </button>
									<a href="list-slider.php" class="btn btn-default" style="text-decoration: none;"> Slider List </a>
								</div>
							</div>
						</form>	
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!--=*= EDIT SLIDER SECTION END =*=-->														