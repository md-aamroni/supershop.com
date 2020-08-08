<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;


## ===*=== [F]ETCH CATEGORY DATA ===*=== ##
$columnName = $tableName  = null;
$columnName = "*";
$tableName = "categories";
$categoryList = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH CATEGORY DATA ===*=== ##


## ===*=== [I]NSERT PRODUCT DATA ===*=== ##
if(isset($_POST['create_product']))
{
	#== NEW IMAGE FILE NAME GENERATE
	$filemasname = "PRODUCT_" . date("YmdHis") . "_" . $_FILES['product_master_image']['name'];
	$fileaddonename = "PRODUCTONE_" . date("YmdHis") . "_" . $_FILES['product_master_image']['name'];
	$fileaddtwoname = "PRODUCTTWO_" . date("YmdHis") . "_" . $_FILES['product_master_image']['name'];
	$fileaddthreename = "PRODUCTTHREE_" . date("YmdHis") . "_" . $_FILES['product_master_image']['name'];
	
	#== IMAGE FILE VALIDATION
	$prodmstrResult = $control->checkImage($_FILES['product_master_image']['type'], $_FILES['product_master_image']['size'], $_FILES['product_master_image']['error']);
	$prodaddoneResult = $control->checkImage($_FILES['products_image_one']['type'], $_FILES['products_image_one']['size'], $_FILES['products_image_one']['error']);
	$prodaddtwoResult = $control->checkImage($_FILES['products_image_two']['type'], $_FILES['products_image_two']['size'], $_FILES['products_image_two']['error']);
	$prodaddthreeResult = $control->checkImage($_FILES['products_image_three']['type'], $_FILES['products_image_three']['size'], $_FILES['products_image_three']['error']);
	
	// && $prodaddoneResult == 1 && $prodaddtwoResult == 1 && $prodaddthreeResult == 1
	
	if($prodmstrResult == 1)
	{
		$tableName = $columnValue = null;
		$tableName = "products";
		$columnValue["category_id"] = $_POST['category_id'];
		$columnValue["subcategory_id"] = $_POST['subcategory_id'];
		$columnValue["product_name"] = $_POST['product_name'];
		$columnValue["product_summary"] = $_POST['product_summary'];
		$columnValue["product_details"] = $_POST['product_details'];
		$columnValue["product_quantity"] = $_POST['product_quantity'];
		$columnValue["product_price"] = $_POST['product_price'];
		$columnValue["product_status"] = $_POST['product_status'];
		$columnValue["product_featured"] = $_POST['product_featured'];
		$columnValue["product_master_image"] = $filemasname;
		$columnValue["products_image_one"] = $fileaddonename;
		$columnValue["products_image_two"] = $fileaddtwoname;
		$columnValue["products_image_three"] = $fileaddthreename;
		$columnValue["product_tags"] = $_POST['product_tag'];
		$columnValue["created_at"] = date("Y-m-d H:i:s");
		$createProduct = $eloquent->insertData($tableName, $columnValue);
		
		if($createProduct > 0)
		{
			#== ADD IMAGE TO THE DIRECTORY
			move_uploaded_file($_FILES['product_master_image']['tmp_name'], $GLOBALS['PRODUCT_DIRECTORY'] . $filemasname);
			move_uploaded_file($_FILES['products_image_one']['tmp_name'], $GLOBALS['PRODUCTADD_DIRECTORY'] . $fileaddonename);
			move_uploaded_file($_FILES['products_image_two']['tmp_name'], $GLOBALS['PRODUCTADD_DIRECTORY'] . $fileaddtwoname);
			move_uploaded_file($_FILES['products_image_three']['tmp_name'], $GLOBALS['PRODUCTADD_DIRECTORY'] . $fileaddthreename);
		}
	}
}
## ===*=== [I]NSERT PRODUCT DATA ===*=== ##
?>

<!--=*= CREATE PRODUCT SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">Create Product</li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					CREATE PRODUCTS
				</header>
				<div class="panel-body">
					
					<?php 
						#== INSERT CONFIRMATION MESSAGE
						if(isset($_POST['create_product'])) 
						{
							if(@$createProduct > 0)
							{
								echo '<div class="alert alert-success fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											THE PRODUCT DATA IS <strong> INSERTED SUCCESSFULLY </strong>
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
					
					<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2">Category</label>
							<div class="col-lg-7">
								
								<select name="category_id" id="category_id" class="form-control" required>
									<option value="">Select a Category</option> 
									
									<?php
										#== CATEGORY LIST DATA
										foreach($categoryList AS $eachRow)
										{
											echo '<option value="'. $eachRow['id'] .'">'. $eachRow['category_name'] .'</option>';
										}
									?>
									
								</select>
							</div>
						</div>
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2"> Subcategory </label>
							<div class="col-lg-7">
								<select name="subcategory_id" id="subcategory_id" class="form-control" required>
									<option value="">Select a Subcategory</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="ProductName" class="col-lg-2 col-sm-2 control-label"> Product Name </label>
							<div class="col-lg-7">
								<input type="text" name="product_name" class="form-control" id="product_name" required>
							</div>
						</div>								
						<div class="form-group">
							<label for="ProductSummary" class="col-lg-2 col-sm-2 control-label"> Product Summary </label>
							<div class="col-lg-10">
								<div class="form-group">
									<div class="col-md-10">
										<textarea name="product_summary" class="form-control" id="summerOne" rows="9" required></textarea>
									</div>
								</div>
							</div>
						</div>								
						<div class="form-group">
							<label for="ProductDetails" class="col-lg-2 col-sm-2 control-label"> Product Details </label>
							<div class="col-lg-10">
								<div class="form-group">
									<div class="col-md-10">
										<textarea name="product_details" class="form-control" id="summerTwo" rows="9" required></textarea>
									</div>
								</div>
							</div>
						</div>								
						<div class="form-group">
							<label for="ProductQuantity" class="col-lg-2 col-sm-2 control-label">Product Quantity</label>
							<div class="col-lg-7">
								<input type="number" name="product_quantity" class="form-control" id="product_quantity" required>
							</div>
						</div>								
						<div class="form-group">
							<label for="ProductPrice" class="col-lg-2 col-sm-2 control-label"> Product Price </label>
							<div class="col-lg-7">
								<input type="number" step="any" name="product_price" class="form-control" id="product_price" required>
							</div>
						</div>
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2"> Product Status </label>
							<div class="col-lg-7">
								<select name="product_status" class="form-control" required>
									<option>Out of Stock</option>
									<option>In Stock</option>
								</select>
							</div>
						</div>						
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2"> Product Feature </label>
							<div class="col-lg-7">
								<select name="product_featured" class="form-control" required>
									<option>NO</option>
									<option>YES</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 "> Product Master Image </label>
							<div class="controls col-md-9">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<span class="btn btn-default btn-file">
										<input type="file" name="product_master_image" class="default" onchange="readURL(this);" set-to="div7" required />
									</span>
									<span class="fileupload-preview" style="margin-left:5px;"></span>
									<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2"> Product Master Preview </label>
							<div class="col-md-9">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail" style="width: 160px; height: 160px;">
										<img style="height: 100%; width: 100%;" src="http://www.placehold.it/200x160/EFEFEF/AAAAAA&amp;text=no+image" alt="" id="div7"/>
									</div>
								</div>
							</div>
						</div>
						
						<!--=*= PRODUCT ADDITIONAL IMAGE =*=-->
						<div class="d-flex d-inline">
							<div class="form-group">
								<label class="control-label col-md-2 "> Product Additional Image </label>
								<div class="controls col-md-3">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<span class="btn btn-default btn-file">
											<input type="file" name="products_image_one" class="default" onchange="readURL(this);" set-to="div8"/>
										</span>
										<span class="fileupload-preview" style="margin-left:5px;"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
									</div>
								</div>
								<div class="controls col-md-3">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<span class="btn btn-default btn-file">
											<input type="file" name="products_image_two" class="default" onchange="readURL(this);" set-to="div9"/>
										</span>
										<span class="fileupload-preview" style="margin-left:5px;"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
									</div>
								</div>
								<div class="controls col-md-3">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<span class="btn btn-default btn-file">
											<input type="file" name="products_image_three" class="default" onchange="readURL(this);" set-to="div10"/>
										</span>
										<span class="fileupload-preview" style="margin-left:5px;"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2"> Product Additional Preview </label>
								<div class="col-md-3">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail" style="width: 160px; height: 160px;">
											<img style="height: 100%; width: 100%;" src="http://www.placehold.it/200x160/EFEFEF/AAAAAA&amp;text=no+image" alt="" id="div8"/>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail" style="width: 160px; height: 160px;">
											<img style="height: 100%; width: 100%;" src="http://www.placehold.it/200x160/EFEFEF/AAAAAA&amp;text=no+image" alt="" id="div9"/>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail" style="width: 160px; height: 160px;">
											<img style="height: 100%; width: 100%;" src="http://www.placehold.it/200x160/EFEFEF/AAAAAA&amp;text=no+image" alt="" id="div10"/>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--=*= PRODUCT ADDITIONAL IMAGE =*=-->
						
						<div class="form-group">
							<label for="ProductName" class="col-lg-2 col-sm-2 control-label"> Product Tags </label>
							<div class="col-md-7">
								<input type="tags" name="product_tag" id="tag-input1" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-5">
								<button name="create_product" class="btn btn-success" type="submit"> Save </button>
								<button class="btn btn-default" type="reset"> Reset </button>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>
</div>
<!--=*= CREATE PRODUCT SECTION END =*=-->


<!--=*= TAGS INPUT START =*=-->
<script type="text/javascript">
	var tagInput = new TagsInput({
		selector: 'tag-input1'
	});
</script>
<!--=*= TAGS INPUT END =*=-->


<!--=*= AJAX CODE TO LOAD SUBCATEGORY AGAINST CATEGORY =*=-->
<script type="text/javascript">
	$(document).ready(function(){
		$("#category_id").change(function() {
			var cat_id = $(this).val();
			
			if(cat_id != "")
			{
				$.ajax({
					url:"ajax.php",
					data:{
						ajax_create_product: "YES",
						category_id:cat_id
					},
					type:'POST',
					success:function(response) 
					{
						var resp = $.trim(response);
						$("#subcategory_id").html(resp);
						
						if(resp == "")
						$("#subcategory_id").html("<option value=''> No Subcategory Found </option>");
					}
				});
			}
			else 
			{
				$("#subcategory_id").html("<option value=''> Select a Subcategory </option>");
			}
		});
	});
</script>	
<!--=*= AJAX CODE TO LOAD SUBCATEGORY AGAINST CATEGORY =*=-->