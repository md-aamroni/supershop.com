<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;


## ===*=== [I]NSERT SLIDER DATA ===*=== ##
if( isset($_POST['create_slider']) )
{
	#== IMAGE FILE VALIDATION
	if( $control->checkImage(@$_FILES['slider_file']['type'], @$_FILES['slider_file']['size'], @$_FILES['slider_file']['error']) == 1)
	{
		#== NEW IMAGE FILE NAME GENERATE
		$filename = "SLIDER_" . date("YmdHis") . "_" . $_FILES['slider_file']['name'];
		
		$tableName = "slides";
		$columnValue["slider_title"] = $_POST['slider_title'];
		$columnValue["slider_file"] = $filename;
		$columnValue["slider_status"] = $_POST['slider_status'];
		$columnValue["slider_sequence"] = $_POST['slider_sequence'];
		$createSliderData = $eloquent->insertData($tableName, $columnValue);
		
		if($createSliderData > 0)
		{
			#== ADD IMAGE TO THE DIRECTORY
			move_uploaded_file($_FILES['slider_file']['tmp_name'], $GLOBALS['SLIDES_DIRECTORY'] . $filename);
		}
	}
}
## ===*=== [I]NSERT SLIDER DATA ===*=== ##
?>

<!--=*= CREATE SLIDER SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<ul class="breadcrumb panel">
				<li> <a href="dashboard.php"><i class="fa fa-home"></i> Home </a> </li>
				<li> <a href="dashboard.php"> Dashboard </a> </li>
				<li class="active"> Add Slider </li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					Add Slider Image
				</header>
				<div class="panel-body">
					
					<?php
						#== INSERT CONFIRMATION MESSAGE
						if( isset($_POST['create_slider']) )
						{
							if($createSliderData > 0)
							{
								echo '<div class="alert alert-success fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											THE SLIDER DATA IS <strong> INSERTED SUCCESSFULLY </strong>
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
					
					<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
						<div class="form-group">
							<label for="SliderTitle" class="col-lg-2 col-sm-2 control-label"> Slider Title </label>
							<div class="col-lg-7">
								<input name="slider_title" type="text" class="form-control" placeholder="Slider Title" required >
							</div>
						</div>
						<div class="form-group">
							<label for="SliderImage" class="control-label col-md-2 "> Slider Image </label>
							<div class="controls col-md-9">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<span class="btn btn-default btn-file">
										<input name="slider_file" type="file" class="default" onchange="readURL(this);" set-to="div3" required />
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
										<img src="http://www.placehold.it/400x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" id="div3" style="width: 100%; height: 100%;"/>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="SliderSequence" class="col-lg-2 col-sm-2 control-label"> Slider Sequence </label>
							<div class="col-lg-7">
								<input name="slider_sequence" type="number" class="form-control" placeholder="Slider Sequence" required>
							</div>
						</div>
						<div class="form-group ">
							<label for="SliderStatus" class="control-label col-lg-2"> Slider Status </label>
							<div class="col-lg-7">
								<select name="slider_status" class="form-control m-bot15" required>
									<option> Active </option>
									<option> Inactive </option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button name="create_slider" class="btn btn-success" type="submit"> Save </button>
								<button class="btn btn-default" type="reset"> Reset </button>
							</div>
						</form>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>
<!--=*= CREATE SLIDER SECTION START =*=-->							