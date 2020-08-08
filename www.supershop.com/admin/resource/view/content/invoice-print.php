<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="public/css/style.css" rel="stylesheet">
		<link href="public/css/custom.css" rel="stylesheet">
	</head>
	<body>
		
		<?php
			## ===*=== [C]ALLING CONTROLLER ===*=== ##
			include("app/Models/Eloquent.php");
			include("app/Http/Controllers/InvoiceValue.php");
			
			
			## ===*=== [O]BJECT DEFINED ===*=== ##
			$eloquent = new Eloquent;
			$getAmount = new InvoiceValue;
			
			
			## ===*=== [F]ECTH INVOICE DATA  ===*=== ##
			if(isset($_POST['printData']))
			{
				$_SESSION['SSCB_INVOICE_DATA'];
				$_SESSION['SSCB_INVOICE_PRODUCT_DATA'];
			}
			## ===*=== [F]ECTH INVOICE DATA  ===*=== ##
		?>

		<section class="panel">
			<div class="container">		
				<div class="panel-body invoice">
					<div class="invoice-header">
						<div class="invoice-title col-md-3 col-xs-2" style="margin-top: 0px;">
							<h1>invoice</h1>
							<img class="logo-print" src="../public/assets/images/logo(1).png" alt="" style="width: 220px; height: 60px; margin-top: -65px; margin-bottom: -5px;">
						</div>
						<div class="invoice-info col-md-9 col-xs-10">
							<div style="margin-left: 300px;">
								<div class="col-md-6 col-sm-6">
									
									<?php 
										echo' <p> '. $_SESSION['SSCB_INVOICE_DATA'][0]['customer_name'] .'<br>'. $_SESSION['SSCB_INVOICE_DATA'][0]['customer_address'] .'</p>';
									?>
									
								</div>
								<div class="col-md-6 col-sm-6">
									
									<?php 
										echo '<p>Phone: '. $_SESSION['SSCB_INVOICE_DATA'][0]['customer_mobile'] .'<br> Email : '. $_SESSION['SSCB_INVOICE_DATA'][0]['customer_email'] .'</p>';
									?>
									
								</div>
							</div>
						</div>
					</div>
					
					<div class="row invoice-to">
						<div class="col-md-4 col-sm-4 pull-left">
							<h4>Invoice To:</h4>
							
							<?php
								echo '<h2>'. $_SESSION['SSCB_INVOICE_DATA'][0]['shipcstmr_name'] .'</h2>
										<p>Phone: +88 '. 
											$_SESSION['SSCB_INVOICE_DATA'][0]['shipcstmr_mobile'] .'<br>'. 
											$_SESSION['SSCB_INVOICE_DATA'][0]['shipcstmr_profession'] .'<br>'. 
											$_SESSION['SSCB_INVOICE_DATA'][0]['shipcstmr_streetadd'] .'<br>'. 
											$_SESSION['SSCB_INVOICE_DATA'][0]['shipcstmr_city'] . $_SESSION['SSCB_INVOICE_DATA'][0]['shipcstmr_zip'] .'<br>'. 
											$_SESSION['SSCB_INVOICE_DATA'][0]['shipcstmr_country'] .
										'</p>';
							?>
							
						</div>
						<div class="col-md-4 col-sm-5 pull-right">
							<div class="row">
								<div class="col-md-4 col-sm-5 inv-label" style="font-style: normal; font-size: 16px;"> Invoice # </div>
								<div class="col-md-8 col-sm-7"> <?= $_SESSION['SSCB_INVOICE_DATA'][0]['invoice_id'] ?></div>
							</div>
							<div class="row">
								<div class="col-md-4 col-sm-5 inv-label" style="font-style: normal; font-size: 16px;"> Date # </div>
								<div class="col-md-8 col-sm-7"> <?= $_SESSION['SSCB_INVOICE_DATA'][0]['created_at'] ?> </div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12 inv-label">
									<h3 style="font-style: normal; font-weight: bold;"> TOTAL AMOUNT </h3>
								</div>
								<div class="col-md-12">
									<h1 class="amnt-value"> <?= $GLOBALS['CURRENCY'] ." ". $_SESSION['SSCB_INVOICE_DATA'][0]['grand_total']; ?> </h1>
								</div>
							</div>
						</div>
					</div>
					<table class="table table-invoice">
						<tr style="color: #73737b; font-weight: bold;">
							<td> # </td>
							<td> Item Description </td>
							<td class="text-center"> Unit Cost </td>
							<td class="text-center"> Quantity </td>
							<td class="text-center"> Total </td>
						</tr>
						<tbody>
							
							<?php
								#== PRODUCT DATA TABLE
								$n = 1;
								foreach($_SESSION['SSCB_INVOICE_PRODUCT_DATA'] AS $eachProduct)
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
								<?php echo $getAmount->inAwords($_SESSION['SSCB_INVOICE_DATA'][0]['grand_total']) . ' TAKA ONLY'; ?>
							</p>
							<h5 class="inv-label" style="font-style: normal"> Thank you for your business </h5>
						</div>
						<div class="col-md-4 col-xs-5 invoice-block pull-right">
							<ul class="unstyled amounts">
								
								<?php
									#== TOTAL SUMMARY
									echo '
										<li> Sub - Total amount : 
											'. $GLOBALS['CURRENCY'] ." ". $_SESSION['SSCB_INVOICE_DATA'][0]['sub_total'] .'
										</li>
										<li> TAX (15%) :
											'. $GLOBALS['CURRENCY'] ." ". $_SESSION['SSCB_INVOICE_DATA'][0]['tax'] .' 
										</li>
										<li> Discount : 
											'. $GLOBALS['CURRENCY'] ." ". $_SESSION['SSCB_INVOICE_DATA'][0]['discount_amount'] .'
										</li>
										<li> Delivery Charge : 
											'. $GLOBALS['CURRENCY'] ." ". $_SESSION['SSCB_INVOICE_DATA'][0]['delivery_charge'] .' 
										</li>
										<li class="grand-total"> Grand Total : 
											'. $GLOBALS['CURRENCY'] ." ". $_SESSION['SSCB_INVOICE_DATA'][0]['grand_total'] .'
										</li>
									';
								?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--=*= INVOICE PRINT SECTION END =*=-->
	</body>
</html>		

<!--=*= JS PRINT SCRIPT =*=-->
<script type="text/javascript">
	window.print();
</script>
<!--=*= JS PRINT SCRIPT =*=-->