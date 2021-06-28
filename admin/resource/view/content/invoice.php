<?php
	## ===*=== [C]ALLING CONTROLLER ===*=== ##
	include("app/Models/Eloquent.php");
	include("app/Http/Controllers/InvoiceValue.php");
	
	
	## ===*=== [O]BJECT DEFINED ===*=== ##
	$eloquent = new Eloquent;
	$getAmount = new InvoiceValue;
	
	
	## ===*=== [F]ECTH INVOICE DATA  ===*=== ##
	if(isset($_POST['invoice_details']))
	{
		#== CREATE A SESSION ON INVOICE ID
		$_SESSION['SSCB_invoice_details'] = $_POST['invoice_id'];
	   
		#== FETCH ALL DATA BASED ON JOIN QUERY
		$columnName = $tableName = $joinType = $onCondition = @$whereValue = null;
		$columnName["1"] = "invoices.invoice_id";
		$columnName["2"] = "invoices.created_at";
		$columnName["3"] = "customers.customer_name";
		$columnName["4"] = "customers.customer_email";
		$columnName["5"] = "customers.customer_mobile";
		$columnName["6"] = "customers.customer_address";
		$columnName["7"] = "shippings.shipcstmr_name";
		$columnName["8"] = "shippings.shipcstmr_mobile";
		$columnName["9"] = "shippings.shipcstmr_profession";
		$columnName["10"] = "shippings.shipcstmr_streetadd";
		$columnName["11"] = "shippings.shipcstmr_city";
		$columnName["12"] = "shippings.shipcstmr_zip";
		$columnName["13"] = "shippings.shipcstmr_country";
		$columnName["14"] = "orders.delivery_charge";
		$columnName["15"] = "orders.sub_total";
		$columnName["16"] = "orders.grand_total";
		$columnName["17"] = "orders.id";
		$columnName["18"] = "orders.tax";
		$columnName["19"] = "orders.discount_amount";
		$tableName["MAIN"] = "invoices";
		$joinType = "INNER";
		$tableName["1"] = "customers";
		$tableName["2"] = "shippings";
		$tableName["3"] = "orders";
		$onCondition["1"] = ["invoices.customer_id", "customers.id"];
		$onCondition["2"] = ["invoices.shipping_id", "shippings.id"];
		$onCondition["3"] = ["invoices.order_id", "orders.id"];
		$whereValue["invoices.id"] = $_SESSION['SSCB_invoice_details'];
		$invoiceDetails = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue);
		
		#== CREATE ANOTHER SESSION FOR PRODUCT DATA
		$_SESSION['SSCB_invoice_order_id'] = $invoiceDetails[0]['id'];
		
		$columnName = $tableName = $whereValue = $onCondition = null;
		$columnName["1"] = "products.product_name";
		$columnName["2"] = "products.product_summary";
		$columnName["3"] = "order_items.product_price";
		$columnName["4"] = "order_items.prod_quantity";
		$tableName["MAIN"] = "order_items";
		$joinType = "INNER";
		$tableName["1"] = "products";
		$onCondition["1"] = ["order_items.product_id", "products.id"];
		$whereValue["order_items.order_id"] = $_SESSION['SSCB_invoice_order_id'];
		$invoiceProductData = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue);
		
		#== CREATE ANOTHER SESSION FOR PRINT INOVICE
		$_SESSION['SSCB_INVOICE_DATA'] = $invoiceDetails;
		$_SESSION['SSCB_INVOICE_PRODUCT_DATA'] = $invoiceProductData;
	}
	## ===*=== [F]ECTH INVOICE DATA  ===*=== ##
?>

<!--=*= INVOICE SECTION START =*=-->
<div class="wrapper">		
	<div class="row">
		<div class="col-md-12">
			<section class="panel">
				<div class="container">		
					<div class="panel-body invoice">
						<div class="text-right" style="margin-bottom: 10px;">
							<form action="invoice-print.php" method="post">
								<a href="invoice-print.php" target="_blank" name="printData" class="btn btn-sm btn-primary" type="submit">&#128438; Print</a>
							</form>
						</div>
						<div class="invoice-header">
							<div class="invoice-title col-md-3 col-xs-2" style="margin-top: 0px;">
								<h1>invoice</h1>
								<img class="logo-print" src="./../public/assets/images/favicon/logoFrontEnd.png" alt="" style="width: 220px; height: 60px; margin-top: -65px; margin-bottom: -5px;">
							</div>
							<div class="invoice-info col-md-9 col-xs-10">
								<div style="margin-left: 300px;">
									<div class="col-md-6 col-sm-6">
										
										<?php 
											echo' <p> '. $invoiceDetails[0]['customer_name'] .'<br>'. $invoiceDetails[0]['customer_address'] .'</p>';
										?>
										
									</div>
									<div class="col-md-6 col-sm-6">
										
										<?php 
											echo '<p>Phone: '. $invoiceDetails[0]['customer_mobile'] .'<br> Email : '. $invoiceDetails[0]['customer_email'] .'</p>';
										?>
										
									</div>
								</div>
							</div>
						</div>
						
						<div class="row invoice-to">
							<div class="col-md-4 col-sm-4 pull-left">
								<h4>Invoice To:</h4>
								
								<?php
									echo '<h2>'. $invoiceDetails[0]['shipcstmr_name'] .'</h2>
											<p>Phone: +88 '. 
												$invoiceDetails[0]['shipcstmr_mobile'] .'<br>'. 
												$invoiceDetails[0]['shipcstmr_profession'] .'<br>'. 
												$invoiceDetails[0]['shipcstmr_streetadd'] .'<br>'. 
												$invoiceDetails[0]['shipcstmr_city'] . $invoiceDetails[0]['shipcstmr_zip'] .'<br>'. 
												$invoiceDetails[0]['shipcstmr_country'] .
											'</p>';
								?>
								
							</div>
							<div class="col-md-4 col-sm-5 pull-right">
								<div class="row">
									<div class="col-md-4 col-sm-5 inv-label" style="font-style: normal; font-size: 16px;"> Invoice # </div>
									<div class="col-md-8 col-sm-7"> <?= $invoiceDetails[0]['invoice_id'] ?></div>
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-5 inv-label" style="font-style: normal; font-size: 16px;"> Date # </div>
									<div class="col-md-8 col-sm-7"> <?= $invoiceDetails[0]['created_at'] ?> </div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-12 inv-label">
										<h3 style="font-style: normal; font-weight: bold;"> TOTAL AMOUNT </h3>
									</div>
									<div class="col-md-12">
										<h1 class="amnt-value"> <?= $GLOBALS['CURRENCY'] ." ". $invoiceDetails[0]['grand_total']; ?></h1>
									</div>
								</div>
							</div>
						</div>
						<table class="table table-invoice">
							<tr style="color: #73737b; font-weight: bold;">
								<td style="width: 5%"> # </td>
								<td style="width: 70%"> Item Description </td>
								<td style="width: 8%" class="text-center"> Unit Cost </td>
								<td style="width: 8%" class="text-center"> Quantity </td>
								<td style="width: 9%" class="text-center"> Total </td>
							</tr>
							<tbody>
								
								<?php
									#== PRODUCT DATA TABLE
									$n = 1;
									foreach($invoiceProductData AS $eachProduct)
									{
										$subTotal = $eachProduct['product_price'] * $eachProduct['prod_quantity'];
										echo '
										<tr>
											<td>'. $n .'</td>
											<td>
												<h4>'. $eachProduct['product_name'] .'</h4>
												<p>'. $eachProduct['product_summary'] .'</p>
											</td>
											<td class="text-center">'. $eachProduct['product_price'] .'</td>
											<td class="text-center">'. $eachProduct['prod_quantity'] .'</td>
											<td class="text-center">'. $subTotal .'</td>
										</tr>
										';
										$n++;
									}
								?>
								
							</tbody>
						</table>
						<div class="row">
							<div class="col-md-8 col-xs-7 payment-method">
								<h4> Payment Method </h4>
								<p> 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
								<p> 2. Pellentesque tincidunt pulvinar magna quis rhoncus. </p>
								<p> 3. Cras rhoncus risus vitae congue commodo. </p>
								<p style="margin-top: 24px; font-style: normal; font-size: 17px;" class="inv-label"> 
									<span style="color: orange; font-weight: bold;">IN AMOUNT: </span>
									<?php echo $getAmount->inAwords($invoiceDetails[0]['grand_total']) . ' TAKA ONLY'; ?>
								</p>
								<h5 class="inv-label" style="font-style: normal"> Thank you for your business </h5>
							</div>
							<div class="col-md-4 col-xs-5 invoice-block pull-right">
								<ul class="unstyled amounts">
									
									<?php
										#== TOTAL SUMMARY
										echo '
											<li> Sub - Total amount : 
												'. $GLOBALS['CURRENCY'] ." ". $invoiceDetails[0]['sub_total'] .'
											</li>
											<li> TAX (15%) :
												'. $GLOBALS['CURRENCY'] ." ". $invoiceDetails[0]['tax'] .' 
											</li>
											<li> Discount : 
												'. $GLOBALS['CURRENCY'] ." ". $invoiceDetails[0]['discount_amount'] .'
											</li>
											<li> Delivery Charge : 
												'. $GLOBALS['CURRENCY'] ." ". $invoiceDetails[0]['delivery_charge'] .' 
											</li>
											<li class="grand-total"> Grand Total : 
												'. $GLOBALS['CURRENCY'] ." ". $invoiceDetails[0]['grand_total'] .'
											</li>
											';
									?>
									
								</ul>
							</div>
						</div>
						<div class="text-center invoice-btn">
							<a href="invoice-list.php" class="btn btn-primary"> Back to List </a>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<!--=*= INVOICE SECTION START =*=-->