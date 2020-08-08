<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/HomeController.php");
include("app/Http/Controllers/SSLCommerz.php");
include("app/Http/Controllers/InvoiceValue.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$sslc = new SSLCommerz();
$eloquent = new Eloquent;
$getAmount = new InvoiceValue;


################### PAYMENT VERIFICATION ###################
#== CREATE SESSION AGAINST NEW VARIBALES
$tran_id = $_SESSION['payment_values']['tran_id'];						
$amount = $_SESSION['payment_values']['amount'];
$currency = $_SESSION['payment_values']['currency'];
$fetch_data = $_POST;
$validation = $sslc->orderValidate($tran_id, $amount, $currency, $fetch_data);
$_SESSION['SSCF_transaction_id'] = @$fetch_data['bank_tran_id'];
################### PAYMENT VERIFICATION ###################


## ===*=== [I]NSERT DATA TO INVOICE TABLE FOR SSL-COMMERZ ===*=== ##
if($validation > 0)
{
	#== INSERT INVOICE TABLE DATA
	$tableName = $columnValue = null;
	$tableName = "invoices";
	$columnValue["invoice_id"] = @$fetch_data['val_id'];
	$columnValue["customer_id"] = @$_SESSION['SSCF_login_id'];
	$columnValue["shipping_id"] = @$_SESSION['SSCF_ship_cstmr_id'];
	$columnValue["order_id"] = @$fetch_data['tran_id'];
	$columnValue["transaction_amount"] = @$fetch_data['amount'];
	$columnValue["created_at"] = date("Y-m-d H:i:s");
	$invoicePG = $eloquent->insertData($tableName, $columnValue);
	
	if($invoicePG['LAST_INSERT_ID'] > 0)
	{
		#== FETCH INOVICE DATA FOR SSLCOMERZ INVOICE ID
		$columnName = $tableName = $whereValue =  null;
		$columnName = "*";
		$tableName = "invoices";
		$whereValue['id'] = $invoicePG['LAST_INSERT_ID'];
		$invoiceresultPG = $eloquent->selectData($columnName, $tableName, $whereValue);
		
		#== UPDATE ORDERS DATA
		$tableName = $columnValue = $whereValue =  null;
		$tableName = "orders";
		$columnValue["payment_method"] = "SSL COMMERZ";
		$columnValue["transaction_id"] = $fetch_data['bank_tran_id'];
		$columnValue["transaction_status"] = "Paid";
		$whereValue["id"] = $_SESSION['SSCF_orders_order_id'];
		$ordersUpdate = $eloquent->updateData($tableName, $columnValue, @$whereValue);
	}
}
## ===*=== [I]NSERT DATA TO INVOICE TABLE FOR SSL-COMMERZ ===*=== ##


## ===*=== [I]NSERT DATA TO INVOICE TABLE FOR CASH ON DELIVERY ===*=== ##
if(isset($_POST['cash_on_delivery']))
{
	if($_POST['payment_values'] = 1)
	{
		#== INSERT INVOICE TABLE DATA
		$tableName = $columnValue = null;
		$tableName = "invoices";
		$columnValue["invoice_id"] = 'COD#' . rand(10000, 99999);
		$columnValue["customer_id"] = @$_SESSION['SSCF_login_id'];
		$columnValue["shipping_id"] = @$_SESSION['SSCF_ship_cstmr_id'];
		$columnValue["order_id"] = @$_SESSION['SSCF_orders_order_id'];
		$columnValue["transaction_amount"] = $_SESSION['SSCF_orders_grand_total'];
		$columnValue["created_at"] = date("Y-m-d H:i:s");
		$invoiceCOD = $eloquent->insertData($tableName, $columnValue);
		
		if($invoiceCOD['LAST_INSERT_ID'] > 0)
		{
			#== FETCH INOVICE DATA FOR CASH ON DELIVERY INVOICE ID
			$columnName = $tableName = $whereValue =  null;
			$columnName = "*";
			$tableName = "invoices";
			$whereValue['id'] = $invoiceCOD['LAST_INSERT_ID'];
			$invoiceresultCOD = $eloquent->selectData($columnName, $tableName, $whereValue);
			
			#== UPDATE ORDERS DATA
			$tableName = $columnValue = $whereValue =  null;
			$tableName = "orders";
			$columnValue["payment_method"] = "Cash On Delivery";
			$columnValue["transaction_id"] = 'COD#' . @$_SESSION['SSCF_login_id'];
			$columnValue["transaction_status"] = "Unpaid";
			$whereValue["id"] = $_SESSION['SSCF_orders_order_id'];
			$ordersUpdate = $eloquent->updateData($tableName, $columnValue, @$whereValue);
		}
	}
}
## ===*=== [I]NSERT DATA TO INVOICE TABLE FOR CASH ON DELIVERY ===*=== ##


## ===*=== [F]ETCH INVOICE TABLE DATA BY JOIN QUERY ===*=== ##
$columnName = $tableName = $joinType = $onCondition = $whereValue = null;
$columnName["1"] = "orders.transaction_id";
$columnName["2"] = "orders.transaction_status";
$columnName["3"] = "orders.sub_total";
$columnName["4"] = "orders.tax";
$columnName["5"] = "orders.discount_amount";
$columnName["6"] = "orders.grand_total";
$columnName["7"] = "products.product_name";
$columnName["8"] = "products.product_summary";
$columnName["9"] = "products.product_price";
$columnName["10"] = "order_items.prod_quantity";
$tableName["MAIN"] = "order_items";
$joinType = "INNER";
$tableName["1"] = "orders";
$tableName["2"] = "products";
$onCondition["1"] = ["order_items.order_id ", "orders.id"];
$onCondition["2"] = ["order_items.product_id", "products.id"];
$whereValue["order_items.order_id"] = $_SESSION['LAST_ORDER_ID'];
$getdetailsResult = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue);
## ===*=== [F]ETCH INVOICE TABLE DATA BY JOIN QUERY ===*=== ##


## ===*=== [F]ETCH SHIPPINGS DATA FOR INVOICE DETAILS ===*=== ##
$tableName = $whereValue= null;
$columnName = "*";
$tableName = "shippings";
$whereValue['id'] = $_SESSION['SSCF_ship_cstmr_id'];
$shippingDetails = $eloquent->selectData($columnName, $tableName, $whereValue);
## ===*=== [F]ETCH SHIPPINGS DATA FOR INVOICE DETAILS ===*=== ##


## ===*=== [F]ETCH CUSTOMER DATA WHO IS CONFIRMED PRODUCT'S ORDER ===*=== ##
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "customers";
$whereValue["id"] = $_SESSION['SSCF_login_id'];
$customerResult = $eloquent->selectData($columnName, $tableName, $whereValue);
## ===*=== [F]ETCH CUSTOMER DATA WHO IS CONFIRMED PRODUCT'S ORDER ===*=== ##


## ===*=== [F]ETCH SHIPPINGS DATA FOR INVOICE DETAILS ===*=== ##
$tableName = $whereValue= null;
$columnName = "*";
$tableName = "invoices";
$whereValue['customer_id'] = $_SESSION['SSCF_login_id'];
$invoiceDetails = $eloquent->selectData($columnName, $tableName, $whereValue);
## ===*=== [F]ETCH SHIPPINGS DATA FOR INVOICE DETAILS ===*=== ##
?>

<?php 
	if($validation == true)	
	{ 
	?>
	
	<!--=*= INVOICE TABLE FOR SSLCOMERZ =*=-->
	<main class="main">
		<nav aria-label="breadcrumb" class="breadcrumb-nav mb-2 printClose">
			<div class="container">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Invoice</li>
				</ol>
			</div>
		</nav>
		<div class="container">
			<div class="text-center printClose">
				<ul class="checkout-progress-bar">
					<li><span>Orders & Shipping</span></li>	
					<li><span>Payment Integration</span></li>	
					<li class="active"><span>Review &amp; Status</span></li>
				</ul>
			</div>
			<div class="text-right">
				<button type="submit" onclick="print_current_page()" target="_blank" class="btn btn-sm btn-outline-warning printClose">&#128438; Print</button>
			</div>
			<br/>
			<div class="row">
				<div class="col-md-12">
					<div class="invoice-header">
						<div class="row">
							<div class="col-md-3 col-xs-2">
								<div class="invoice-title">
									<h1>invoice</h1>
									<img class="logo-print" src="public/assets/images/favicon/logoFrontEnd.png" alt="" style="width: 220px; height: 60px;">
								</div>
							</div>
							<div class="invoice-info  col-md-9 col-xs-10">
								<div style="padding-left: 340px;">
									<div class="row">
										<div class="col-md-6 col-sm-6 text-left">
											
											<?php 
												echo' <p> '. $customerResult[0]['customer_name'] .'<br>'. $customerResult[0]['customer_address'] .'</p>';
											?>
											
										</div>
										<div class="col-md-6 col-sm-6 text-left">
											
											<?php 
												echo '<p>Phone: '. $customerResult[0]['customer_mobile'] .'<br> Email : '. $customerResult[0]['customer_email'] .'</p>';
											?>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row invoice-to">
						<div class="col-md-9 col-sm-4 pull-left">
							<h4>Invoice To:</h4>
							
							<?php
								echo '<h2>'. @$shippingDetails[0]['shipcstmr_name'] .'</h2>
								<p>'. @$shippingDetails[0]['shipcstmr_profession'] .'<br>'.'+88' .
										@$shippingDetails[0]['shipcstmr_mobile'] .'<br>'.
										@$shippingDetails[0]['shipcstmr_streetadd'] .'<br>'.
										@$shippingDetails[0]['shipcstmr_city'] . "-" . @$shippingDetails[0]['shipcstmr_zip'] .'<br>'.
										@$shippingDetails[0]['shipcstmr_country'] .'<br>
								</p>';
							?>
							
						</div>
						<div class="col-md-3 col-sm-5 pull-right">
							<div class="row">
								<div class="col-md-4 col-sm-5 inv-label">Invoice #</div>
								<div class="col-md-8 col-sm-7"><?= $invoiceresultPG[0]['invoice_id'];;?></div>
							</div>
							<div class="row">
								<div class="col-md-4 col-sm-5 inv-label">Date #</div>
								<div class="col-md-8 col-sm-7"><?= date("M-d-Y H:i:s A");?></div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12 inv-label">
									<h3 class="inv-label">TOTAL PAID</h3>
									<h2 style="font-size: 40px; font-weight: bold">
										<?= $GLOBALS['CURRENCY'] . " " . @$getdetailsResult[0]['grand_total']; ?>
									</h2>
								</div>
							</div>
						</div>
					</div>
					<table class="table table-invoice" >
						<thead>
							<tr>
								<th>#</th>
								<th>Item Description</th>
								<th class="text-center">Unit Cost</th>
								<th class="text-center">Quantity</th>
								<th class="text-center">Total</th>
							</tr>
						</thead>
						<tbody>
							
							<?php
								$n = 1;
								foreach($getdetailsResult AS $eachData)
								{
									echo'
									<tr>
										<td>'. $n .'</td>
										<td>
											<div style="font-weight: bold;">'. $eachData['product_name'] .'</div>
											<div style="margin-bottom: -10px;">'. $eachData['product_summary'] .'</div>
										</td>
										<td class="text-center">'. $eachData['product_price'] .'</td>
										<td class="text-center">'. $eachData['prod_quantity'] .'</td>
										<td class="text-center">'. $eachData['prod_quantity'] * $eachData['product_price'] .'</td>
									</tr>';
									$n++;
								}
							?>
							
						</tbody>
					</table>
					<div class="row">
						<div class="col-md-8 col-xs-7 payment-method">
							<h4>Payment Method</h4>
							<p>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
							<p>2. Pellentesque tincidunt pulvinar magna quis rhoncus.</p>
							<p>3. Cras rhoncus risus vitae congue commodo.</p>
							<p style="font-style: normal; font-size: 17px;" class="inv-label mt-1 mb-2"> 
								<span style="color: orange; font-weight: bold;">IN AMOUNT: </span>
								<?php echo $getAmount->inAwords($getdetailsResult[0]['grand_total']) . ' TAKA ONLY'; ?>
							</p>
							<h3 class="inv-label itatic">Thank you for your business</h3>
						</div>
						<div class="col-md-4 col-xs-5 invoice-block pull-right">
							<ul class="unstyled amounts">
								<li>Sub-Total amount :
									<?= $GLOBALS['CURRENCY'] . " " . $getdetailsResult[0]['sub_total']; ?>
								</li>
								<li>Discount :
									<?= $GLOBALS['CURRENCY'] . " " . $getdetailsResult[0]['discount_amount']; ?>
								</li>
								<li>TAX 
									<?= $GLOBALS['CURRENCY'] . " " . $getdetailsResult[0]['tax']; ?>
								</li>
								<li class="grand-total">Grand Total : 
									<?= $GLOBALS['CURRENCY'] . " " . $getdetailsResult[0]['grand_total']; ?>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="checkout-steps-action">
						<a href="index.php" class="btn btn-outline-success float-right printClose">Done</a>
					</div>
				</div>
			</div>
		</div>
		<div class="mb-6">
			<!-- CREATE A EMPTY SPACE BETWEEN CONTENT -->
		</div>
	</main>	
	<!--=*= INVOICE TABLE FOR SSLCOMERZ =*=-->
	
	<?php 
	} 
	else if(isset($_POST['cash_on_delivery']))
	{
		if($_POST['payment_values'] = 1)
		{
		?>
		
		<!--=*= INVOICE TABLE FOR CASH ON DELIVERY =*=-->
		<main class="main">
			<nav aria-label="breadcrumb" class="breadcrumb-nav mb-2 printClose">
				<div class="container">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Invoice</li>
					</ol>
				</div>
			</nav>
			<div class="container">
				<div class="text-center printClose">
				<ul class="checkout-progress-bar">
					<li><span>Orders & Shipping</span></li>	
					<li><span>Payment Integration</span></li>	
					<li class="active"><span>Review &amp; Status</span></li>
				</ul>
				</div>
				<div class="text-right">
					<button type="submit" onclick="print_current_page()" target="_blank" class="btn btn-sm btn-outline-warning printClose">&#128438; Print</button>
				</div>
				<br/>
				<div class="row">
					<div class="col-md-12">
						<div class="invoice-header">
							<div class="row">
								<div class="col-md-3 col-xs-2">
									<div class="invoice-title">
										<h1>invoice</h1>
										<img class="logo-print" src="public/assets/images/favicon/logoFrontEnd.png" alt="" style="width: 220px; height: 60px;">
									</div>
								</div>
								<div class="invoice-info  col-md-9 col-xs-10">
									<div style="padding-left: 340px;">
										<div class="row">
											<div class="col-md-6 col-sm-6 text-left">
												<?php 
													echo' <p> '. $customerResult[0]['customer_name'] .'<br>'. $customerResult[0]['customer_address'] .'</p>';
												?>
											</div>
											<div class="col-md-6 col-sm-6 text-left">
												<?php 
													echo '<p>Phone: '. $customerResult[0]['customer_mobile'] .'<br> Email : '. $customerResult[0]['customer_email'] .'</p>';
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row invoice-to">
							<div class="col-md-9 col-sm-4 pull-left">
								<h4>Invoice To:</h4>
								
								<?php
									echo '<h2>'. @$shippingDetails[0]['shipcstmr_name'] .'</h2>
									<p>'. @$shippingDetails[0]['shipcstmr_profession'] .'<br>'.'+88' .
											@$shippingDetails[0]['shipcstmr_mobile'] .'<br>'.
											@$shippingDetails[0]['shipcstmr_streetadd'] .'<br>'.
											@$shippingDetails[0]['shipcstmr_city'] . "-" . @$shippingDetails[0]['shipcstmr_zip'] .'<br>'.
											@$shippingDetails[0]['shipcstmr_country'] .'<br>
									</p>';
								?>
								
							</div>
							<div class="col-md-3 col-sm-5 pull-right">
								<div class="row">
									<div class="col-md-4 col-sm-5 inv-label">Invoice #</div>
									<div class="col-md-8 col-sm-7"><?= $invoiceresultCOD[0]['invoice_id'];?></div>
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-5 inv-label">Date #</div>
									<div class="col-md-8 col-sm-7"><?= date("M-d-Y H:i:s A");?></div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-12 inv-label">
										<h3 class="inv-label">TOTAL DUE</h3>
										<h2 style="font-size: 40px; font-weight: bold">
											<?= $GLOBALS['CURRENCY'] . " " . @$getdetailsResult[0]['grand_total']; ?>
										</h2>
									</div>
								</div>
							</div>
						</div>
						<table class="table table-invoice" >
							<thead>
								<tr>
									<th>#</th>
									<th>Item Description</th>
									<th class="text-center">Unit Cost</th>
									<th class="text-center">Quantity</th>
									<th class="text-center">Total</th>
								</tr>
							</thead>
							<tbody>
								
								<?php
									$n = 1;
									foreach($getdetailsResult AS $eachData)
									{
										echo'
										<tr>
											<td>'. $n .'</td>
											<td>
												<div style="font-weight: bold;">'. $eachData['product_name'] .'</div>
												<div style="margin-bottom: -10px;">'. $eachData['product_summary'] .'</div>
											</td>
											<td class="text-center">'. $eachData['product_price'] .'</td>
											<td class="text-center">'. $eachData['prod_quantity'] .'</td>
											<td class="text-center">'. $eachData['prod_quantity'] * $eachData['product_price'] .'</td>
										</tr>';
										$n++;
									}
								?>
								
							</tbody>
						</table>
						<div class="row">
							<div class="col-md-8 col-xs-7 payment-method">
								<h4>Payment Method</h4>
								<p>1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
								<p>2. Pellentesque tincidunt pulvinar magna quis rhoncus.</p>
								<p>3. Cras rhoncus risus vitae congue commodo.</p>
								<p style="font-style: normal; font-size: 17px;" class="inv-label mt-1 mb-2"> 
									<span style="color: orange; font-weight: bold;">IN AMOUNT: </span>
									<?php echo $getAmount->inAwords($getdetailsResult[0]['grand_total']) . ' TAKA ONLY'; ?>
								</p>
								<h3 class="inv-label itatic">Thank you for your business</h3>
							</div>
							<div class="col-md-4 col-xs-5 invoice-block pull-right">
								<ul class="unstyled amounts">
									<li>Sub - Total amount : <?= $GLOBALS['CURRENCY'] . " " . $getdetailsResult[0]['sub_total'] ;?></li>
									<?php 
										#== IF CUSTOMER GET DISCOUNT
										if(@$getdetailsResult[0]['discount_amount'] > 0)
										{
											echo '<li>Discount : ' . $GLOBALS['CURRENCY'] . " " . $getdetailsResult[0]['discount_amount'] . '</li>';				
										}
									?>
									<li>Discount :
										<?= $GLOBALS['CURRENCY'] . " " . $getdetailsResult[0]['discount_amount']; ?>
									</li>
									<li>TAX 
										<?php echo '(' . $GLOBALS['TAX'] . '%) :' . " " . $GLOBALS['CURRENCY'] . " " . $getdetailsResult[0]['tax']; ?>
									</li>
									<li class="grand-total">Grand Total : 
										<?php echo $GLOBALS['CURRENCY'] . " " . $getdetailsResult[0]['grand_total']; ?>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="checkout-steps-action">
							<a href="index.php" class="btn btn-outline-success float-right printClose">Done</a>
						</div>
					</div>
				</div>
			</div>
			<div class="mb-6">
				<!-- CREATE A EMPTY SPACE BETWEEN CONTENT -->
			</div>
		</main>
		<!--=*= INVOICE TABLE FOR CASH ON DELIVERY =*=-->
		
		<?php
		}
	} 
	else 
	{
	?>
	
	<!--=*= 404 SECTION START =*=-->
	<main class="main">
		<nav aria-label="breadcrumb" class="breadcrumb-nav">
			<div class="container">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">404 error</li>
				</ol>
			</div>
		</nav>	
		<div class="container">
			<div class="text-center">
				<div class="http-error-main">
					<h2 class="text-warning" style="font-size: 140px;">404!</h2>
					<p style="font-size: 18px;">We\'re sorry, but the page you were looking for doesn\'t exist.</p>
					<div class="mb-8">
						<!-- used to create space between footer and main content -->
					</div>
					<a href="index.php" class="btn btn-outline-info">Back to Home</a>
				</div>
			</div>
		</div>
		<div class="mb-5">
			<!-- CREATE A EMPTY SPACE BETWEEN CONTENT -->
		</div>
	</main>
	<!--=*= 404 SECTION START =*=-->
	
	<?php
	}
?>


<!--=*= SCRIPT TO PRINT DOCUMENT START =*=-->
<script type="text/javascript">
function print_current_page(){
	window.print();
}
</script>

<style>
@media print {
	#header, #footer, .printClose {display: none;}
}
</style>
<!--=*= SCRIPT TO PRINT DOCUMENT END =*=-->