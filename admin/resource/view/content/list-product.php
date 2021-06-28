<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$eloquent = new Eloquent;


## ===*=== [D]ELETE PRODUCT DATA ===*=== ##
if(isset($_REQUEST['did']))
{
	#== GET EXISTING PRODUCT INFORMATION
	$columnName = $tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "products";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteproductData = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	#== DELETE PRODUCT DATA
	$tableName = "products";
	$whereValue["id"] = $_REQUEST['did'];
	$deleteProduct = $eloquent->deleteData($tableName, $whereValue);
	
	if($deleteProduct > 0)
	{
		#== ALSO DELETED FROM DIRECTORY
		unlink($GLOBALS['PRODUCT_DIRECTORY'].$deleteproductData[0]['product_master_image']);
		unlink($GLOBALS['PRODUCTADD_DIRECTORY'].$deleteproductData[0]['products_image_one']);
		unlink($GLOBALS['PRODUCTADD_DIRECTORY'].$deleteproductData[0]['products_image_two']);
		unlink($GLOBALS['PRODUCTADD_DIRECTORY'].$deleteproductData[0]['products_image_three']);
	}
}
## ===*=== [D]ELETE PRODUCT DATA ===*=== ##


## ===*=== [C]HANGE PRODUCT STATUS ===*=== ##
if(isset($_POST['change_status']))
{
	$tableName= $columnValue= $whereValue= null;
	$tableName = "products";
	$whereValue["id"] = $_POST['change_status_id'];
	
	if($_POST['current_status'] == "In Stock")
	{
		$columnValue["product_status"] = "Out of Stock";
	}
	else if($_POST['current_status'] == "Out of Stock")
	{
		$columnValue["product_status"] = "In Stock";
	}
	$updateStatus = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}
## ===*=== [C]HANGE PRODUCT STATUS ===*=== ##


## ===*=== [C]HANGE FEATURE PRODUCT STATUS ===*=== ##
if(isset($_POST['change_feature']))
{
	$tableName= $columnValue= $whereValue= null;
	$tableName = "products";
	$whereValue["id"] = $_POST['change_feature_id'];
	
	if($_POST['current_feature'] == "NO")
	{
		$columnValue["product_featured"] = "YES";
	}
	else if($_POST['current_feature'] == "YES")
	{
		$columnValue["product_featured"] = "NO";
	}
	$featureStatus = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}
## ===*=== [C]HANGE FEATURE PRODUCT STATUS ===*=== ##


## ===*=== [F]ETCH PRODUCT DATA ===*=== ##
$columnName= $tableName = $joinType = $onCondition = null;
$columnName["1"] = "products.id";
$columnName["2"] = "products.product_name";
$columnName["3"] = "products.product_master_image";
$columnName["4"] = "products.product_quantity";
$columnName["5"] = "products.product_price";
$columnName["6"] = "products.product_status";
$columnName["7"] = "products.product_featured";
$columnName["8"] = "categories.category_name";
$columnName["9"] = "subcategories.subcategory_name";
$tableName["MAIN"] = "products";
$joinType = "INNER";
$tableName["1"] = "categories";
$tableName["2"] = "subcategories";
$onCondition["1"] = ["products.category_id", "categories.id"];
$onCondition["2"] = ["products.subcategory_id", "subcategories.id"];
$productList = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition);
## ===*=== [F]ETCH PRODUCT DATA ===*=== ##
?>

<!--=*= PRODUCT LIST SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-sm-12">
			<ul class="breadcrumb panel">
				<li><a href="dashboard.php"><i class="fa fa-home"></i> Home </a></li>
				<li><a href="dashboard.php"> Dashboard </a></li>
				<li class="active"> Product List </li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					PRODUCT LIST
				</header>
				<div class="panel-body">
					
					<?php 
						#== DELETE CONFIRMATION MESSAGE
						if (isset($_REQUEST['did'])) 
						{
							if ($deleteProduct > 0)
							{
								echo '<div class="alert alert-success fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											THE PRODUCT DATA IS <strong> DELETED SUCCESSFULLY </strong>
										</div>';
							}
							else
							{
								echo '<div class="alert alert-warning fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											SOMETHING WENT WRONG TO DELETE DATA! <strong> PLEASE RECHECK </strong>
										</div>';
							}
						}
						
						#== STATUS CHANGE CONFIRMATION MESSAGE
						if (isset($_POST['change_status'])) 
						{
							if ($updateStatus > 0)
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
											SOMETHING WENT WRONG TO UPDATE STATUS! <strong> PLEASE RECHECK </strong>
										</div>';
							}
						}
					?>
					
					<div class="adv-table">
						<table class="display table table-bordered" id="dynamic-table">
							<thead>
								<tr>
									<th style="width:6%"> ID </th>
									<th style="width:15%"> Category </th>
									<th style="width:15%"> SubCategory </th>
									<th style="width:15%"> Product Name </th>
									<th style="width:8%"> Image </th>
									<th style="width:6%"> Qty. </th>
									<th style="width:8%"> Price </th>
									<th style="width:8%"> Status </th>
									<th style="width:8%"> Featured </th>
									<th style="width:12%"> Action </th>
								</tr>
							</thead>
							<tbody>
								
								<?php 
									#== PRODUCT DATA TABLE
									$n = 1;
									foreach ($productList as $eachRow) 
									{
										#== IF PRODUCT IS NOT AVAILABLE OR SOMEHOW MISSING
										if(empty($eachRow['product_master_image']))
										{
											$productImage = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";
										}
										else
										{
											$productImage = $GLOBALS['PRODUCT_DIRECTORY'].$eachRow['product_master_image'];
										}
										
										echo '
										<tr class="gradeA">
											<td>'. $n .'</td>
											<td style="width: 80px;">'. $eachRow['category_name'] .'</td>
											<td style="width: 120px;">'. $eachRow['subcategory_name'] .'</td>
											<td>'. $eachRow["product_name"] .'</td>
											<td class="center">
												<a target="_blank" href="'. $productImage .'">
													<img src="'. $productImage .'" class="img-circle" height="48px" width="48px" style="border: 1px outset green;">
												</a>
											</td>
											<td>'. $eachRow["product_quantity"] .'</td>
											<td>'. $eachRow["product_price"] .' <span>&dollar;</span></td>
											<td class="center" style="width:50px;">
												<form method="post" action="">
													<input type="hidden" name="change_status_id" value="'. $eachRow["id"] .'"/>
													<input type="hidden" name="current_status" value="'. $eachRow["product_status"] .'"/>
													<button name="change_status" class="btn btn-info btn-xs" style="width: 80px;" type="submit">'. $eachRow["product_status"] .'</button>
												</form>
											</td>										
											<td class="center" style="width: 40px;">
												<form method="post" action="">
													<input type="hidden" name="change_feature_id" value="'. $eachRow["id"] .'"/>
													<input type="hidden" name="current_feature" value="'. $eachRow["product_featured"] .'"/>
													<button name="change_feature" class="btn btn-primary btn-xs" style="width: 60px;" type="submit">'. $eachRow["product_featured"] .'</button>
												</form>
											</td>
											<td class="center">
												<div class="row">
													<a data-id="'. $eachRow['id'] .'" href="#deleteModal" class="btn btn-danger btn-xs float-right deleteButton" style="width: 60px;" data-toggle="modal">
														<i class="fa fa-trash-o"></i> Delete
													</a>
													<form method="post" action="edit-product.php" style="display:inline;">
														<input type="hidden" name="id" value="'. $eachRow["id"] .'"/>
														<button name="edit_data" class="btn btn-warning btn-xs" style="width: 60px;" type="submit">
															<i class="fa fa-pencil-square"></i> Edit
														</button>
													</form>
												</div>
											</td>
										</tr> 
										';
										$n++;
									}
								?>
								
							</tbody>    
							<tfoot>
								<tr>
									<th> ID </th>
									<th> Category </th>
									<th> SubCategory </th>
									<th> Product Name </th>
									<th> Image </th>
									<th> Qty. </th>
									<th> Price </th>
									<th> Status </th>
									<th> Featured </th>
									<th> Action </th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!--=*= PRODUCT LIST SECTION START =*=-->


<!--=*= DELETE MODAL =*=-->
<div class="modal small fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"> Delete Product? </h4>
			</div>
			<div class="modal-body">
				<h5> Are you sure you want to delete this Product? </h5>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default"data-dismiss="modal" aria-hidden="true"> Cancel </button> 
				<a href="list-customer.php" class="btn btn-danger" id="modalDelete" >Delete </a>
			</div>
		</div>
	</div>
</div>
<!--=*= DELETE MODAL =*=-->


<!--=*= SCRIPT TO DELETE DATA =*=-->
<script>
	$('.deleteButton').click(function(){
		var id = $(this).data('id');
		
		$('#modalDelete').attr('href','list-product.php?did='+id);
	})
</script>
<!--=*= SCRIPT TO DELETE DATA =*=-->