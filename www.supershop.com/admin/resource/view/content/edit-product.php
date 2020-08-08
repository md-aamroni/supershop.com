<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$eloquent = new Eloquent;
$control = new Controller;


## ===*=== [U]PDATE PRODUCT DATA ===*=== ##
if(isset($_POST['update_data']))
{
	#== IF UPDATE DATA WITHOUT IMAGES
	if(	
	empty($_FILES['product_master_image']['name']) &&
	empty($_FILES['products_image_one']['name']) &&
	empty($_FILES['products_image_two']['name']) &&
	empty($_FILES['products_image_three']['name'])
	)
	{
		$tableName = $columnValue = $whereValue = null;
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
		$columnValue["product_tags"] = $_POST['product_tag'];
		$whereValue["id"] = $_SESSION['SMC_product_product_id'];
		$updateproductData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
	}
	#== IF UPDATE DATA WITH IMAGES
	else
	{
		#== NEW IMAGE FILE NAME GENERATE
		$filemasname = "PRODUCT_" . date("YmdHis") . "_" . $_FILES['product_master_image']['name'];
		$fileaddonename = "PRODUCTONE_" . date("YmdHis") . "_" . $_FILES['product_master_image']['name'];
		$fileaddtwoname = "PRODUCTTWO_" . date("YmdHis") . "_" . $_FILES['product_master_image']['name'];
		$fileaddthreename = "PRODUCTTHREE_" . date("YmdHis") . "_" . $_FILES['product_master_image']['name'];
		
		#== IMAGE FILES VALIDATION
		$prodmstrResult = $control->checkImage($_FILES['product_master_image']['type'], $_FILES['product_master_image']['size'], $_FILES['product_master_image']['error']);
		$prodaddoneResult = $control->checkImage($_FILES['products_image_one']['type'], $_FILES['products_image_one']['size'], $_FILES['products_image_one']['error']);
		$prodaddtwoResult = $control->checkImage($_FILES['products_image_two']['type'], $_FILES['products_image_two']['size'], $_FILES['products_image_two']['error']);
		$prodaddthreeResult = $control->checkImage($_FILES['products_image_three']['type'], $_FILES['products_image_three']['size'], $_FILES['products_image_three']['error']);
		
		if($prodmstrResult == 1 && $prodaddoneResult == 1 && $prodaddtwoResult == 1 && $prodaddthreeResult == 1)
		{
			$tableName = $columnValue = $whereValue = null;
			$tableName = "products";
			$columnValue["category_id"] = $_POST['category_id'];
			$columnValue["subcategory_id"] = $_POST['subcategory_id'];
			$columnValue["product_name"] = $_POST['product_name'];
			$columnValue["product_summary"] = $_POST['product_summary'];
			$columnValue["product_details"] = $_POST['product_details'];
			$columnValue["product_master_image"] = $filemasname;
			$columnValue["products_image_one"] = $fileaddonename;
			$columnValue["products_image_two"] = $fileaddtwoname;
			$columnValue["products_image_three"] = $fileaddthreename;
			$columnValue["product_quantity"] = $_POST['product_quantity'];
			$columnValue["product_price"] = $_POST['product_price'];
			$columnValue["product_status"] = $_POST['product_status'];
			$columnValue["product_featured"] = $_POST['product_featured'];
			$columnValue["product_tags"] = $_POST['product_tag'];
			$whereValue["id"] = $_SESSION['SMC_product_product_id'];
			$updateproductData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
			
			if($updateproductData > 0)
			{
				#== ADD IMAGES TO THE DIRECTORY
				move_uploaded_file($_FILES['product_master_image']['tmp_name'], $GLOBALS['PRODUCT_DIRECTORY'] . $filemasname);
				move_uploaded_file($_FILES['products_image_one']['tmp_name'], $GLOBALS['PRODUCTADD_DIRECTORY'] . $fileaddonename);
				move_uploaded_file($_FILES['products_image_two']['tmp_name'], $GLOBALS['PRODUCTADD_DIRECTORY'] . $fileaddtwoname);
				move_uploaded_file($_FILES['products_image_three']['tmp_name'], $GLOBALS['PRODUCTADD_DIRECTORY'] . $fileaddthreename);
				
				#== REMOVE IMAGES FROM THE DIRECTORY
				unlink($_SESSION['SMC_edit_data_image_mas_file_old']);
				unlink($_SESSION['SMC_edit_data_image_one_file_old']);
				unlink($_SESSION['SMC_edit_data_image_two_file_old']);
				unlink($_SESSION['SMC_edit_data_image_three_file_old']);
			}
		}
	}
}
## ===*=== [U]PDATE PRODUCT DATA ===*=== ##


## ===*=== GET PRODUCT ID FROM THE "EDIT" BUTTON OF PRODUCT LIST PAGE ===*=== ##
if(isset($_POST['edit_data']))
{
	# HOLD PRODUCT ID IN A SESSION
	$_SESSION['SMC_product_product_id'] = $_POST['id'];
}
## ===*=== GET PRODUCT ID FROM THE "EDIT" BUTTON OF PRODUCT LIST PAGE ===*=== ##


## ===*=== [F]ETCH EXISTING PRODUCT DATA  ===*=== ##
$tableName = $columnName = $whereValue = $joinType = $onCondition = null;
$columnName["1"] = "products.product_name";
$columnName["2"] = "products.product_master_image";
$columnName["3"] = "products.products_image_one";
$columnName["4"] = "products.products_image_two";
$columnName["5"] = "products.products_image_three";
$columnName["6"] = "products.product_quantity";
$columnName["7"] = "products.product_price";
$columnName["8"] = "products.product_status";
$columnName["9"] = "products.product_details";
$columnName["10"] = "products.product_summary";
$columnName["11"] = "products.product_tags";
$columnName["12"] = "products.category_id";
$columnName["13"] = "products.subcategory_id";
$columnName["14"] = "categories.id";
$columnName["15"] = "categories.category_name";
$columnName["16"] = "subcategories.id";
$columnName["17"] = "subcategories.subcategory_name";
$columnName["18"] = "products.product_featured";
$tableName["MAIN"] = "products";
$joinType = "INNER";
$tableName["1"] = "categories";
$tableName["2"] = "subcategories";
$onCondition["1"] = ["products.category_id", "categories.id"];
$onCondition["2"] = ["products.subcategory_id", "subcategories.id"];
$whereValue['products.id'] = $_SESSION['SMC_product_product_id'];
$getproductData = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue, @$formatBy, @$paginate);

#== STORING OLD PRODUCT IMAGE DATA IN A SESSION VARIABLE
$_SESSION['SMC_edit_data_image_mas_file_old'] = $GLOBALS['PRODUCT_DIRECTORY'] . $getproductData[0]['product_master_image'];
$_SESSION['SMC_edit_data_image_one_file_old'] = $GLOBALS['PRODUCTADD_DIRECTORY'] . $getproductData[0]['products_image_one'];
$_SESSION['SMC_edit_data_image_two_file_old'] = $GLOBALS['PRODUCTADD_DIRECTORY'] . $getproductData[0]['products_image_two'];
$_SESSION['SMC_edit_data_image_three_file_old'] = $GLOBALS['PRODUCTADD_DIRECTORY'] . $getproductData[0]['products_image_three'];
## ===*=== [F]ETCH EXISTING PRODUCT DATA  ===*=== ##


## ===*=== [F]ETCH CATEGORY DATA  ===*=== ##
$columnName = "*";
$tableName = "categories";
$categoryList = $eloquent->selectData($columnName, $tableName);
## ===*=== [F]ETCH CATEGORY DATA  ===*=== ##
?>

<!--=*= EDIT PRODUCT SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12">
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li class="active">Edit Product</li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					EDIT PRODUCTS
				</header>
				<div class="panel-body">
					
					<?php 
						# UPDATE MESSAGE
						if (isset($_POST['update_data'])) 
						{
							if (@$updateproductData > 0)
							{
									echo '<div class="alert alert-success fade in">
												<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
												THE PRODUCT DATA IS <strong> UPDATED SUCCESSFULLY </strong>
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
					
					<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
						
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2">Category</label>
							<div class="col-lg-7">
								<select name="category_id" id="category_id" class="form-control">
									<option value="">Select a Category</option>
									
									<?php 
										# CATEGORY LIST
										foreach($categoryList AS $eachRow)
										{
											echo '<option value="'.$eachRow['id'].'" ';
											
											if($eachRow['id'] == $getproductData[0]['category_id'])
											echo 'selected';
											
											echo ' >'.$eachRow['category_name'].'</option>';
										}
									?>
									
								</select>
							</div>
						</div>
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2">Subcategory</label>
							<div class="col-lg-7">
								<select id="subcategory_id" name="subcategory_id" class="form-control">
									<option> Select A Subcategory </option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="ProductName" class="col-lg-2 col-sm-2 control-label">Product Name</label>
							<div class="col-lg-7">
								<input type="text" name="product_name" class="form-control" value="<?php echo $getproductData[0]['product_name']?>">
							</div>
						</div>	
						<div class="form-group">
							<label for="ProductSummary" class="col-lg-2 col-sm-2 control-label">Product Summary</label>
							<div class="col-lg-8">
								<textarea name="product_summary" id="summerOne" >
									<?php echo $getproductData[0]['product_summary']?>
								</textarea>
							</div>
						</div>	
						<div class="form-group">
							<label for="ProductDetails" class="col-lg-2 col-sm-2 control-label">Product Details</label>
							<div class="col-lg-8">
								<textarea name="product_details" id="summerTwo">
									<?php echo $getproductData[0]['product_details']?>
								</textarea>
							</div>
						</div>	
						<div class="form-group">
							<label for="ProductQuantity" class="col-lg-2 col-sm-2 control-label">Product Quantity</label>
							<div class="col-lg-7">
								<input type="number" name="product_quantity" class="form-control" value="<?php echo $getproductData[0]['product_quantity']?>">
							</div>
						</div>								
						<div class="form-group">
							<label for="ProductPrice" class="col-lg-2 col-sm-2 control-label">Product Price</label>
							<div class="col-lg-7">
								<input type="number" step="any" name="product_price" class="form-control" value="<?php echo $getproductData[0]['product_price']?>">
							</div>
						</div>
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2">Product Status</label>
							<div class="col-lg-7">
								<select name="product_status" class="form-control">
									<option <?php if($getproductData[0]['product_status'] == "Out of Stock") echo "selected";?>>Out of Stock</option>
									<option <?php if($getproductData[0]['product_status'] == "In Stock") echo "selected";?>>In Stock</option>
								</select>
							</div>
						</div>
						<div class="form-group ">
							<label for="ProductStatus" class="control-label col-lg-2">Product Feature</label>
							<div class="col-lg-7">
								<select name="product_featured" class="form-control" required>
									<option <?php if($getproductData[0]['product_featured'] == "NO") echo "selected";?>>NO</option>
									<option <?php if($getproductData[0]['product_featured'] == "YES") echo "selected";?>>YES</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2 ">Product Master Image</label>
							<div class="controls col-md-9">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<span class="btn btn-default btn-file">
										<input type="file" name="product_master_image" class="default" onchange="readURL(this);" set-to="div1" />
									</span>
									<span class="fileupload-preview" style="margin-left:5px;"></span>
									<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-2">Product Master Preview</label>
							<div class="col-md-9">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail" style="width: 160px; height: 160px;">
										<img style="height: 100%; width: 100%;" src="<?php echo $GLOBALS['PRODUCT_DIRECTORY'] . $getproductData[0]['product_master_image'] ;?>" alt="" id="div1"/>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex d-inline">	<!-- product additional images start -->
							<div class="form-group">
								<label class="control-label col-md-2 ">Product Additional Image</label>
								<div class="controls col-md-3">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<span class="btn btn-default btn-file">
											<input type="file" name="products_image_one" class="default" onchange="readURL(this);" set-to="div2" />
										</span>
										<span class="fileupload-preview" style="margin-left:5px;"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
									</div>
								</div>
								<div class="controls col-md-3">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<span class="btn btn-default btn-file">
											<input type="file" name="products_image_two" class="default" onchange="readURL(this);" set-to="div3" />
										</span>
										<span class="fileupload-preview" style="margin-left:5px;"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
									</div>
								</div>
								<div class="controls col-md-3">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<span class="btn btn-default btn-file">
											<input type="file" name="products_image_three" class="default" onchange="readURL(this);" set-to="div4" />
										</span>
										<span class="fileupload-preview" style="margin-left:5px;"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2">Product Additional Preview</label>
								<div class="col-md-3">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail" style="width: 160px; height: 160px;">
											<img style="height: 100%; width: 100%;" src="<?php echo $GLOBALS['PRODUCTADD_DIRECTORY'] . $getproductData[0]['products_image_one'] ;?>" alt="" id="div2"/>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail" style="width: 160px; height: 160px;">
											<img style="height: 100%; width: 100%;" src="<?php echo $GLOBALS['PRODUCTADD_DIRECTORY'] . $getproductData[0]['products_image_two'] ;?>" alt="" id="div3"/>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail" style="width: 160px; height: 160px;">
											<img style="height: 100%; width: 100%;" src="<?php echo $GLOBALS['PRODUCTADD_DIRECTORY'] . $getproductData[0]['products_image_three'] ;?>" alt="" id="div4"/>
										</div>
									</div>
								</div>
							</div>
						</div>		<!-- product additional images end -->
						<div class="form-group">
							<label for="ProductName" class="col-lg-2 col-sm-2 control-label">Product Tags</label>
							<div class="col-md-7">
								<input type="tags" name="product_tag" id="tag-input1" value="<?php echo $getproductData[0]['product_tags'];?>">
							</div>
						</div>
						<input type="hidden" name="product_id" value="<?php echo $getproductData[0]['id']?>"/>
						<div class="form-group">
							<div class="col-lg-offset-2 col-lg-10">
								<button name="update_data" class="btn btn-primary" type="submit">Update</button>
								<a href="list-product.php" class="btn btn-default" style="text-decoration: none;">Product List</a>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>
</div>
<!--=*= EDIT PRODUCT SECTION END =*=-->


<!--=*= TAGS INPUT START =*=-->
<script type="text/javascript">
	var tagInput = new TagsInput({
		selector: 'tag-input1'
	});
</script>
<!--=*= TAGS INPUT END =*=-->


<!--=*= AJAX CODE TO LOAD SUBCATEGORY AGAINST CATEGORY =*=-->
<script type="text/javascript">
	$(document).ready(function() {
		
		/* ## WHEN EDITED ## */
		var cat_id = <?php echo $getproductData[0]['category_id']; ?>;
		
		if (cat_id != "") {
			$.ajax({
				url: "ajax.php",
				data: {
					ajax_edit_product: "YES",
					category_id: cat_id,
					subcategory_id: <?php echo $getproductData[0]['subcategory_id']; ?>
				},
				type: 'POST',
				success: function(response) {
					var resp = $.trim(response);
					$("#subcategory_id").html(resp);
					
					if (resp == "")
					$("#subcategory_id").html("<option value=''> No Subcategory Found </option>");
				}
			});
		} 
		else 
		{
			$("#subcategory_id").html("<option value=''> Select a Subcategory </option>");
		}
		
		//== WHEN NEWLY ADDED
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
						$("#subcategory_id").html("<option value=''>No Subcategory Found</option>");
					}
				});
			}
			else 
			{
				$("#subcategory_id").html("<option value=''>Select a Subcategory</option>");
			}
		});		
	});
</script>			
<!--=*= AJAX CODE TO LOAD SUBCATEGORY AGAINST CATEGORY =*=-->