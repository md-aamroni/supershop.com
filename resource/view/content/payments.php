<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/HomeController.php");
include("app/Http/Controllers/SSLCommerz.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$eloquent = new Eloquent;


## ===*=== [U]PDATE SHIPPING DETAILS DATA ===*=== ##
if(isset($_POST['update_shipping']))
{
	$tableName = $columnValue = $whereValue =  null;
	$tableName = "shippings";
	$columnValue["shipcstmr_name"] = $_POST['shipcstmr_name_upd'];
	$columnValue["shipcstmr_mobile"] = $_POST['shipadd_phn_upd'];
	$columnValue["shipcstmr_profession"] = $_POST['shipadd_prfsion_upd'];
	$columnValue["shipcstmr_streetadd"] = $_POST['shipcstmr_streetadd_upd'];
	$columnValue["shipcstmr_city"] = $_POST['shipcstmr_city_upd'];
	$columnValue["shipcstmr_zip"] = $_POST['shipadd_zopc_upd'];
	$columnValue["shipcstmr_country"] = $_POST['shipadd_cntry_upd'];
	$columnValue["updated_at"] = date("Y-m-d H:i:s");
	$whereValue["id"] = $_SESSION['SSC_last_shipadd_id'];
	$updateResult = $eloquent->updateData($tableName, $columnValue, @$whereValue);	
}
## ===*=== [U]PDATE SHIPPING DETAILS DATA ===*=== ##


## ===*=== [I]NSERT TO THE SHIPPING DATA ===*=== ##
if(isset($_POST['proceed_to_payment']))
{
	if(@$_SESSION['SSCF_login_id'] > 0)
	{
		$tableName = $columnValue = null;
		$tableName = "shippings";
		$columnValue["shipcstmr_name"] = $_POST['shipadd_fname'] . " " . $_POST['shipadd_lname'];
		$columnValue["customer_id"] = $_SESSION['SSCF_login_id'];
		$columnValue["order_id"] = $_SESSION['SSCF_orders_order_id'];
		$columnValue["shipcstmr_mobile"] = $_POST['shipadd_phn'];
		$columnValue["shipcstmr_profession"] = $_POST['shipadd_cmpny']; 
		$columnValue["shipcstmr_streetadd"] = $_POST['shipadd_stadd'];
		$columnValue["shipcstmr_city"] = $_POST['shipadd_cty'];
		$columnValue["shipcstmr_zip"] = $_POST['shipadd_zopc'];
		$columnValue["shipcstmr_country"] = $_POST['shipadd_cntry'];
		$columnValue["created_at"] = date("Y-m-d H:i:s");
		$shipaddResult = $eloquent->insertData($tableName, $columnValue);
		
		$_SESSION['SSC_last_shipadd_id'] = $shipaddResult['LAST_INSERT_ID'];
		$_SESSION['SSC_last_insert_id_no'] = $shipaddResult['NO_OF_ROW_INSERTED'];
	}
}
## ===*=== [I]NSERT TO THE SHIPPING DATA ===*=== ##


##===*=== #==================# GO FOR PAYMENT SECTION START #==================# ===*===##
if(isset($_POST['proceed_to_payment']) || isset($_POST['update_shipping']))
{
	#== GET ORDER DETAILS FROM DATABASE
	$columnName = $tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "orders";
	$whereValue['id'] = $_SESSION['SSCF_orders_order_id'];
	$orderDetailsToPay = $eloquent->selectData($columnName, $tableName, $whereValue);
	
	$_SESSION['SSCF_orders_grand_total'] = $orderDetailsToPay[0]['grand_total'];

	#== [I]NTEGRATE PAYMENT GATEWAY START
	if ($_SERVER['SERVER_NAME'] == "localhost") 
	{
		$server_name = 'http://localhost/www.supershop.com/';
	} 
	else 
	{
		$server_name = 'http://www.supershop.com/';
	}
	
	##=*= ALL CUSTOMER DATA THAT YOU REQUIRE TO SEND TO PAYMENT GATEWAY =*=##
	#== [P]AYMENT INFORMATION | REQUIRED
	$post_data = array();
	$post_data['total_amount'] = $orderDetailsToPay[0]['grand_total'];
	$post_data['currency'] = "BDT";
	$post_data['tran_id'] = $orderDetailsToPay[0]['id'];
	$post_data['success_url'] = $server_name . "status.php";	#== SUCCESS CONFIRMATION PAGE
	$post_data['fail_url'] = $server_name . "status.php";		#== FAILED CONFIRMATION PAGE
	$post_data['cancel_url'] = $server_name . "status.php";		#== CANCELLED CONFIRMATION PAGE
	
	#== [C]USTOMER INFORMATION | REQUIRED
	$post_data['cus_name'] = $_SESSION['SSCF_login_user_name'];
	$post_data['cus_email'] = $_SESSION['SSCF_login_user_email'];
	$post_data['cus_add1'] = $_SESSION['SSCF_login_user_address'];
	$post_data['cus_add2'] = "";
	$post_data['cus_city'] = "";
	$post_data['cus_state'] = "";
	$post_data['cus_postcode'] = "";
	$post_data['cus_country'] = "Bangladesh";
	$post_data['cus_phone'] = $_SESSION['SSCF_login_user_mobile'];
	$post_data['cus_fax'] = "";
	
	#== [S]HIPMENT INFORMATION | REQUIRED
	$post_data['ship_name'] = @$_SESSION['SSCF_ship_cstmr_name'];
	$post_data['ship_add1 '] = @$_SESSION['SSCF_ship_cstmr_addr'];
	$post_data['ship_add2'] = "";
	$post_data['ship_city'] = @$_SESSION['SSCF_ship_cstmr_city'];
	$post_data['ship_state'] = "";
	$post_data['ship_postcode'] = @$_SESSION['SSCF_ship_cstmr_zip'];
	$post_data['ship_country'] = @$_SESSION['SSCF_ship_cstmr_cntry'];
	
	#== [O]PTIONAL PARAMETERS | REQUIRED
	$post_data['value_a'] = "ref001";
	$post_data['value_b'] = "ref002";
	$post_data['value_c'] = "ref003";
	$post_data['value_d'] = "ref004";
	
	$_SESSION['payment_values'] = array();
	$_SESSION['payment_values']['tran_id'] = $post_data['tran_id'];
	$_SESSION['payment_values']['amount'] = $post_data['total_amount'];
	$_SESSION['payment_values']['currency'] = $post_data['currency'];
	#== [I]NTEGRATE PAYMENT GATEWAY END
}
##===*=== #==================# GO FOR PAYMENT SECTION END #==================# ===*===##


## ===*=== [F]ETCH SHIPPING DATA ===*=== ##
$tableName = $columnName = $whereValue =  null;
$columnName = "*";
$tableName = "shippings";
$whereValue["id"] = $_SESSION['SSC_last_shipadd_id'];
$shipcstmResult = $eloquent->selectData($columnName, $tableName, $whereValue);

#== CREATE SESSION ON SHIPPING DATA WHICH IS USED ON PAYMENT GATEWAY INTEGRATION
$_SESSION['SSCF_ship_cstmr_id'] = $shipcstmResult[0]['id'];
$_SESSION['SSCF_ship_cstmr_order_id'] = $shipcstmResult[0]['order_id'];
$_SESSION['SSCF_ship_cstmr_name'] = $shipcstmResult[0]['shipcstmr_name'];
$_SESSION['SSCF_ship_cstmr_addr'] = $shipcstmResult[0]['shipcstmr_streetadd'];
$_SESSION['SSCF_ship_cstmr_city'] = $shipcstmResult[0]['shipcstmr_city'];
$_SESSION['SSCF_ship_cstmr_zip'] = $shipcstmResult[0]['shipcstmr_zip'];
$_SESSION['SSCF_ship_cstmr_cntry'] = $shipcstmResult[0]['shipcstmr_country'];
## ===*=== [F]ETCH SHIPPING DATA ===*=== ##
?>

<!--=*= PAYMENT CONTENT START =*=-->
<main class="main">
	<nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Payment Integration</li>
			</ol>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="text-center">
					<ul class="checkout-progress-bar">
						<li><span>Orders & Shipping</span></li>	
						<li class="active"><span>Payment Integration</span></li>	
						<li><span>Review &amp; Status</span></li>
					</ul>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<div class="mb-4">
							<!-- CREATE A EMPTY SPACE BETWEEN CONTENT -->
						</div>
						
						<?php 
							#== PAYMENT GATEWAY DATA
							if(isset($_POST['proceed_to_payment']) || isset($_POST['update_shipping']))
							{
								$sslc = new SSLCommerz();
								#==INITIATE (TRANSACTION DATA, WHETHER REDIRECT OR DISPALY IN PAGE)
								$payment_options = $sslc->initiate($post_data, true);
								
								echo '<h3>Card Payment</h3>';
								echo '<table>';
									echo '<tr>';
										foreach ($payment_options['cards'] as $row) 
										{
											echo '<td style="width: 165px;">' . $row['name'] .'</td>';
										}
									echo '</tr>';
									echo '<tr>';
										foreach ($payment_options['cards'] as $row) 
										{
											echo '<td style="width: 165px;">' . $row['link'] .'</td>';
										}
										echo '</tr>';
								echo '</table>';
									
									echo "<hr>";
									
									echo '<h3>Mobile Wallet Payment</h3>';
									echo '<table>';
										echo '<tr>';
											foreach ($payment_options['mobile'] as $row) 
											{
												echo '<td style="width: 165px;">' . $row['name'] .'</td>';
											}
										echo '</tr>';
										echo '<tr>';
											foreach ($payment_options['mobile'] as $row) 
											{
												echo '<td style="width: 165px;">' . $row['link'] .'</td>';
											}
										echo '</tr>';
									echo '</table>';
								
								echo "<hr>";
								
								echo '<h3>Internet Banking Payment</h3>';
								echo '<table>';
									echo '<tr>';
										foreach ($payment_options['internet'] as $row) 
										{
											echo '<td style="width: 165px;">' . $row['name'] .'</td>';
										}
									echo '</tr>';
									echo '<tr>';
										foreach ($payment_options['internet'] as $row) 
										{
											echo '<td style="width: 165px;">' . $row['link'] .'</td>';
										}
									echo '</tr>';
								echo '</table>';
								
								echo "<hr>";
								
								echo '<h3>Other Payment Options</h3>';
								echo '<table>';
									echo '<tr>';
										foreach ($payment_options['others'] as $row) 
										{
											echo '<td style="width: 165px;">' . $row['name'] .'</td>';
										}
									echo '</tr>';
									echo '<tr>';
										foreach ($payment_options['others'] as $row) 
										{
											echo '<td style="width: 165px;">' . $row['link'] .'</td>';
										}
									echo '</tr>';
								echo '</table>';	
							}
						?>
						
					</div>
					<div class="col-lg-4">
						<div class="mb-4">
							<!-- CREATE A EMPTY SPACE BETWEEN CONTENT -->
						</div>
						<h3> Cash on Delivery </h3>
						<table class="table">
							<tr>
								<td>
									<form method="post" action="status.php">
										<div class="form-group-custom-control">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" name="payment_values" value="1" class="custom-control-input" id="address-save">
												<label class="custom-control-label" for="address-save">Cash On Delivery</label>
											</div>
											<button type="submit" name="cash_on_delivery" class="btn btn-block btn-sm btn-primary">Confirm Cash On Delivery</button>
										</div>
									</form>
								</td>
							</tr>
						</table>
						<article class="entry">
							<div class="entry-body">
								<div class="entry-date">
									<span class="day bg-light"> <?php echo date("d"); ?> </span>
									<span class="month bg-info"> <?php echo date("M"); ?> </span>
								</div>
								<h3 class="text-info">Suggestion for Payment</h3>
								<div class="entry-content">
									<p class="text-justify" style="font-size: 14px;">
										Euismod atras vulputate iltricies etri elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per 
										inceptos himenaeos. Nulla nunc dui, tristique in semper vel, congue sed ligula.
									</p>
								</div>
							</div>
						</article>
						<div>
							<h3>Shipping Address</h3>
							<div class="shipping-step-addresses">
								<div class="shipping-address-box active" style="width: 100%;">
									<ul class="text-justify" style="font-size: 14px;">
									
									<?php
										#== SHIPPING DETAILS
										echo'
										<li>'. @$shipcstmResult[0]['shipcstmr_name'] .'</li>
										<li>'. @$shipcstmResult[0]['shipcstmr_profession'] .'</li>
										<li>'. @$shipcstmResult[0]['shipcstmr_streetadd'] .'</li>
										<li>'. @$shipcstmResult[0]['shipcstmr_city']. " " .@$shipcstmResult[0]['shipcstmr_zip'] .'</li>
										<li>'. @$shipcstmResult[0]['shipcstmr_country'] .'</li>
										<li>'. @$shipcstmResult[0]['shipcstmr_mobile'] .'</li>
										<br/>
										<li>
											<button type="button" class="btn btn-sm float-right" style="color: #fff; background-color: #ff5501;" data-toggle="modal" data-target="#exampleModal">
												<i class="icon-pencil"></i> Edit 
											</button>
										</li>';
									?>
										
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="mb-8">
		<!-- CREATE A EMPTY SPACE BETWEEN CONTENT -->
	</div>
</main>
<!--=*= PAYMENT CONTENT START =*=-->

<!--=*= EDIT SHIPPING DETAILS MODAL START =*=-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-warning">
				<h2 class="modal-title text-light" id="exampleModalLabel">Edit Shipping Address</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form action="" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group required-field">
								<label for="">Full Name</label>
								<input type="text" name="shipcstmr_name_upd" class="form-control" name="" value="<?php echo @$shipcstmResult[0]['shipcstmr_name']; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-7">
									<div class="form-group required-field">
										<label>Street Address </label>
										<input type="text" name="shipcstmr_streetadd_upd" class="form-control" value="<?php echo @$shipcstmResult[0]['shipcstmr_streetadd']; ?>">
									</div>
								</div>
								<div class="col-sm-5">
									<div class="form-group required-field">
										<label>City </label>
										<input type="text" name="shipcstmr_city_upd" class="form-control" value="<?php echo @$shipcstmResult[0]['shipcstmr_city']; ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Profession <span class="text-warning">(optional)</span></label>
										<input type="text" name="shipadd_prfsion_upd" class="form-control" value="<?php echo @$shipcstmResult[0]['shipcstmr_profession']; ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="row">
								<div class="form-group required-field col-sm-4">
									<label>Phone Number </label>
									<input type="tel" name="shipadd_phn_upd" class="form-control" value="<?php echo @$shipcstmResult[0]['shipcstmr_mobile']; ?>">
								</div>
								<div class="form-group required-field col-sm-4">
									<label>Zip Code</label>
									<input type="text" name="shipadd_zopc_upd" class="form-control" value="<?php echo @$shipcstmResult[0]['shipcstmr_zip']; ?>" required>
								</div>
								<div class="form-group required-field col-sm-4">
									<label>Country</label>
									<input type="text" name="shipadd_cntry_upd" class="form-control" value="<?php echo @$shipcstmResult[0]['shipcstmr_country']; ?>">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Close</button>
					<button type="submit" name="update_shipping" class="btn btn-sm btn-info">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--=*= EDIT SHIPPING DETAILS MODAL END =*=-->