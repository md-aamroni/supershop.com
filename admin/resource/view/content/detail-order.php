<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$eloquent = new Eloquent;


## ===*=== [F]ETCH ORDERED ITEMS DATA ===*=== ##
if(isset($_REQUEST['id']))
{
	#== CREATE A SESSION BASED ON ID
	$_SESSION['SMCB_details_data'] = $_REQUEST['id'];
}

$columnName["1"] = "order_items.product_id ";
$columnName["2"] = "order_items.prod_quantity ";
$columnName["3"] = "products.product_name";
$columnName["4"] = "products.product_master_image";
$columnName["5"] = "products.product_price";
$tableName["MAIN"] = "order_items";
$joinType = "INNER";
$tableName["1"] = "products";
$onCondition["1"] = ["order_items.product_id", "products.id"];
$whereValue["order_items.order_id"] = @$_SESSION['SMCB_details_data'];
$orderdetailsResult = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue);
## ===*=== [F]ETCH ORDERED ITEMS DATA ===*=== ##
?>

<!--=*= DETAIL ORDER SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-sm-12">
			<ul class="breadcrumb panel">
				<li> <a href="dashboard.php"> <i class="fa fa-home"></i> Home </a> </li>
				<li> <a href="dashboard.php"> Dashboard </a> </li>
				<li class="active"> Order Details </li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					ORDER DETAILS
				</header>
				<div class="panel-body">
					<div class="adv-table">
						<table class="display table table-bordered table-striped" id="dynamic-table">
							<thead>
								<tr>
									<th style="width: 5%"> # </th>
									<th style="width: 10%"> Item ID </th>
									<th style="width: 40%"> Item Name </th>
									<th style="width: 10%"> Item Image </th>
									<th style="width: 10%"> Item Price </th>
									<th style="width: 10%"> Item Qty. </th>
									<th style="width: 15%"> Action </th>
								</tr>
							</thead>
							<tbody>
								
								<?php 
									#== DETAILS ORDER DATA TABLE
									$n = 1;
									foreach ($orderdetailsResult as $eachRow) 
									{
										echo '
										<tr class="gradeA">
											<td>'. $n .'</td>
											<td>'. $eachRow["product_id"] .'</td>
											<td>'. $eachRow["product_name"] .'</td>
											<td class="center">
												<a target="_blank" href="'. $GLOBALS['PRODUCT_DIRECTORY'] . $eachRow["product_master_image"] .'"> 
													<img src="'. $GLOBALS['PRODUCT_DIRECTORY'] . $eachRow["product_master_image"] .'" class="img-circle" style="border: 1px outset green; height: 48px; width: 45px;"/>
												</a>
											</td>
											<td>'. $eachRow["product_price"] .' &dollar;</td>
											<td>'. $eachRow["prod_quantity"] .'</td>
											<td class="center">
												<a href="?aid='. $eachRow["product_id"] .'" class="btn btn-danger btn-xs disabled" style="width: 76px;">
													<i class="fa fa-trash-o"></i> Delete
												</a>												
												<a href="list-order.php" class="btn btn-warning btn-xs" style="width: 76px;">
													<i class="fa fa-chevron-circle-left"></i> List Back
												</a>
											</td>
										</tr>
										';
										$n++;
									}
								?> 
								
							</tbody>        
							<tfoot>
								<tr>
									<th> # </th>
									<th> Item ID </th>
									<th> Item Name </th>
									<th> Item Image </th>
									<th> Item Price </th>
									<th> Item Qty. </th>
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
<!--=*= DETAIL ORDER SECTION END =*=-->						