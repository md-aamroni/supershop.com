<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$eloquent = new Eloquent;


## ===*=== [D]ELETE INVOICE DATA  ===*=== ##
if(isset($_POST['invoice_delete']))
{
	$tableName = "invoices";
	$whereValue["id"] = $_POST['remove_inovice'];
	$deleteInovice = $eloquent->deleteData($tableName, $whereValue);
}
## ===*=== [D]ELETE INVOICE DATA  ===*=== ##


## ===*=== [F]ECTH INVOICE DATA  ===*=== ##
$columnName = $tableName = $joinType = $onCondition = null;
$columnName["1"] = "invoices.id";
$columnName["2"] = "invoices.invoice_id";
$columnName["3"] = "invoices.created_at";
$columnName["4"] = "customers.customer_name";
$columnName["5"] = "orders.payment_method";
$columnName["6"] = "orders.grand_total";
$tableName["MAIN"] = "invoices";
$joinType = "INNER";
$tableName["1"] = "orders";
$tableName["2"] = "customers";
$onCondition["1"] = ["invoices.order_id", "orders.id"];
$onCondition["2"] = ["invoices.customer_id", "customers.id"];
$invoiceData = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition);
## ===*=== [F]ECTH INVOICE DATA  ===*=== ##
?>

<!--=*= INVOICE LIST SECTION START =*=-->
<div class="wrapper">
	<div class="row">
		<div class="col-sm-12">
			<ul class="breadcrumb panel">
				<li> <a href="dashboard.php"> <i class="fa fa-home"></i> Home </a> </li>
				<li> <a href="dashboard.php"> Dashboard </a> </li>
				<li class="active"> Invoice </li>
			</ul>
			<section class="panel">
				<header class="panel-heading">
					ORDER DETAILS
				</header>
				<div class="panel-body">
					
					<?php
						#== DELETE CONFIRMATION MESSAGE
						if( isset($_POST['invoice_delete']) )
						{
							if($deleteInovice > 0)
							{
								echo '<div class="alert alert-success fade in">
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
											THE INVOICE DATA IS <strong> DELETED SUCCESSFULLY </strong>
										</div>';
							}
							else
							{
								echo '<div class="alert alert-warning fade in"> 
											<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button> 
											SOMETHING WENT WRONG TO CHANGE STATUS! <strong> PLEASE RECHECK </strong>
										</div>';
							}
						}
					?>
					
					<div class="adv-table">
						<table class="display table table-bordered table-striped" id="dynamic-table">
							<thead>
								<tr>
									<th style="width: 7%"> ID </th>
									<th style="width: 25%"> Invoice No </th>
									<th style="width: 15%"> Customer Name </th>
									<th style="width: 15%"> Payment Method </th>
									<th style="width: 10%"> Transaction </th>
									<th style="width: 13%"> Issued Date </th>
									<th style="width: 15%"> Action </th>
								</tr>
							</thead>
							<tbody>
								
							<?php 
								#== INVOICE DATA TABLE
								$n = 1;
								foreach ($invoiceData as $eachRow) 
								{
									echo '
										<tr class="gradeX">
											<td>'. $n .'</td>
											<td>'. $eachRow["invoice_id"] .'</td>
											<td>'. $eachRow["customer_name"] .'</td>
											<td>'. $eachRow["payment_method"] .'</td>
											<td>'. $GLOBALS['CURRENCY'] ." ". $eachRow["grand_total"] .'</td>
											<td>'. $eachRow["created_at"] .'</td>
											<td class="center">
												<div class="row">
													<form action="invoice.php" method="post" style="display: inline">
														<input type="hidden" name="invoice_id" value="'. $eachRow['id'] .'"/>
														<button name="invoice_details" class="btn btn-info btn-xs" style="width: 76px;" type="submit">
															<i class="fa fa-pencil-square"></i> View
														</button>
													</form>
													<form action="" method="post" style="display: inline">
														<input type="hidden" name="remove_inovice" value="'. $eachRow['id'] .'"/>
														<button name="invoice_delete" class="btn btn-danger btn-xs" style="width: 76px;" type="submit">
															<i class="fa fa-trash-o"></i> Delete
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
									<th> Invoice No </th>
									<th> Customer Name </th>
									<th> Payment Method </th>
									<th> Transaction </th>
									<th> Issued Date </th>
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
<!--=*= INVOICE LIST SECTION END =*=-->		