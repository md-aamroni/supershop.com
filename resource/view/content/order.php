<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;


## ===*=== [I]NSERT ORDER TABLE'S DATA FROM SHOPCART PAGE ===*=== ##
if(isset($_POST['submit_order']))
{
	#== CREATE ORDERS DATA WHEN SUBMIT PLACED TO ORDER
	$tableName = "orders";
	$columnValue["order_date"] = date("Y-m-d H:i:s");
	$columnValue["sub_total"] = $_POST['cartsub_total'];
	$columnValue["tax"] = $_POST['tax_total'];
	$columnValue["delivery_charge"] = $_POST['delivery_charge'];
	$columnValue["discount_amount"] = $_POST['discount_amount'];
	$columnValue["grand_total"] = $_POST['grand_total'];
	$columnValue["customer_id"] = @$_SESSION['SSCF_login_id'];
	$columnValue["created_at"] = date("Y-m-d H:i:s");
	$saveorderDetails = $eloquent->insertData($tableName, $columnValue);
	
	$_SESSION['LAST_ORDER_ID'] = $saveorderDetails['LAST_INSERT_ID'];
	
	if($saveorderDetails['NO_OF_ROW_INSERTED'] > 0)
	{
		$_SESSION['SSCF_orders_order_id'] = $saveorderDetails['LAST_INSERT_ID'];
		
		#== GET ALL DATA FROM SHOPCART PAGE FOR LOGGED IN USER OR CUSTOMER
		$columnName = $tableName = $joinType = $onCondition = $whereValue = $formatBy = $paginate = null;
		$columnName["1"] = "products.id";
		$columnName["2"] = "products.product_price";
		$columnName["3"] = "shopcarts.quantity";
		$tableName["MAIN"] = "shopcarts";
		$joinType = "INNER";
		$tableName["1"] = "products";
		$onCondition["1"] = ["shopcarts.product_id", "products.id"];
		$whereValue["shopcarts.customer_id"] = @$_SESSION['SSCF_login_id'];
		$formatBy["DESC"] = "shopcarts.id";
		$shopCartItems = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue, @$formatBy, @$paginate);
		
		foreach($shopCartItems AS $eachOrderItems)
		{
			#== INSERT DATA TO THE ORDER ITEMS TABLE
			$columnValue = $tableName = null;
			$tableName = "order_items";
			$columnValue["customer_id"] = $_SESSION['SSCF_login_id'];
			$columnValue["order_id"] = $_SESSION['SSCF_orders_order_id'];
			$columnValue["product_id"] = $eachOrderItems['id'];
			$columnValue["product_price"] = $eachOrderItems['product_price'];
			$columnValue["prod_quantity"] = $eachOrderItems['quantity'];
			$columnValue["created_at"] = date("Y-m-d H:i:s");
			$saveorderItems = $eloquent->insertData($tableName, $columnValue);
		}
		
		#== NOW DELETE ALL THE SHOPCART ITEMS DATA AS THEY ARE STORED IN ORDER ITEMS TABLE
		if(@$saveorderItems['NO_OF_ROW_INSERTED'] > 0)
		{
			$tableName = $whereValue = null;
			$tableName = "shopcarts";
			$whereValue["customer_id"] = $_SESSION['SSCF_login_id'];
			$deleteshopcartData = $eloquent->deleteData($tableName, $whereValue);			
			
			$tableName = $whereValue = null;
			$tableName = "deliveries";
			$whereValue["customer_id"] = $_SESSION['SSCF_login_id'];
			$deleteshopcartData = $eloquent->deleteData($tableName, $whereValue);
		}
	}
}
## ===*=== [I]NSERT ORDER TABLE'S DATA FROM SHOPCART PAGE ===*=== ##


## ===*=== [W]HEN USER TRY TO LOG IN ===*=== ##
if( isset($_POST['user_login']) )
{
	$columnName = "*";
	$tableName = "customers";
	$whereValue["customer_email"] = $_POST['user_email'];
	$whereValue["customer_password"] = sha1($_POST['user_pass']);
	$userLogin = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	if($userLogin > 0)
	{
		#== CREATE A SESSION FOR USER ENTIRE FRONT END APPLICATION
		if(!empty($userLogin))
		{
			$_SESSION['SSCF_login_time'] = date("Y-m-d H:i:s");
			$_SESSION['SSCF_login_id'] = $userLogin[0]['id'];
			$_SESSION['SSCF_login_user_name'] = $userLogin[0]['customer_name'];
			$_SESSION['SSCF_login_user_email'] = $userLogin[0]['customer_email'];
			$_SESSION['SSCF_login_user_mobile'] = $userLogin[0]['customer_mobile'];
			$_SESSION['SSCF_login_user_address'] = $userLogin[0]['customer_address'];
		}
	}
}
## ===*=== [W]HEN USER TRY TO LOG IN ===*=== ##


## ===*=== [I]NSERT DATA FOR NEW USER ===*=== ##
if(isset($_POST['customerRegistration']))
{
	if(!empty($_POST['acc_Firstname']) && !empty($_POST['acc_Lastname']) && !empty($_POST['acc_Emailadd']) && !empty($_POST['acc_Setpass']) && !empty($_POST['acc_Setmobile']) &&
	!empty($_POST['acc_Setaddress']))
	{
		$tableName = $columnValue = null;
		$tableName = "customers";
		$columnValue["customer_name"] = $_POST['acc_Firstname'] . " " . $_POST['acc_Lastname'];
		$columnValue["customer_email"] = $_POST['acc_Emailadd'];
		$columnValue["customer_password"] = sha1($_POST['acc_Setpass']);
		$columnValue["customer_mobile"] = $_POST['acc_Setmobile'];
		$columnValue["customer_address"] = $_POST['acc_Setaddress'];
		$columnValue["created_at"] = date("Y-m-d H:i:s");
		
		$registerCustomer = $eloquent->insertData($tableName, $columnValue);
	}
}
## ===*=== [I]NSERT DATA FOR NEW USER ===*=== ##
?>

<!--=*= ORDER SUBMISSION SECTION START =*=-->
<main class="main">
	<nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Orders & Shipping</li>
			</ol>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="text-center">
					<ul class="checkout-progress-bar">
						<li class="active"><span>Orders & Shipping</span></li>	
						<li><span>Payment Integration</span></li>	
						<li><span>Review &amp; Status</span></li>
					</ul>
				</div>
				
				<?php
					#== SUBMISSION CONFIRMATION IMAGE WHEN ORDER PLACED IS SUCCESFULLY DONE
					if(isset($_POST['submit_order']))
					{
						if(@$saveorderDetails > 0)
						echo '
						<div class="d-flex justify-content-center">
							<img src="public/assets/images/success.png" alt="" class="img-fluid">
						</div>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Dear Mr. <strong> ' . $_SESSION['SSCF_login_user_name'] . ' </strong>, 
							thanks for your order submission. Please fill up the below <b> Shipping Details </b>, so that we delivered your product at your destination.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
					}
					
					#== LOGGED IN CONFIRMATION MESSAGE
					else if( isset($_POST['user_login']) )
					{
						if(@$_SESSION['SSCF_login_id'] > 0)
						echo '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Dear Mr. <strong> ' . $_SESSION['SSCF_login_user_name'] . ' </strong>, 
							thanks for your order submission. Please fill up the below <b> Shipping Details </b>, so that we delivered your product at your destination.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
					}
					
					#== REGISTRATION CONFIRMATION MESSAGE
					else if(isset($_POST['customerRegistration']))
					{
						if($registerCustomer['LAST_INSERT_ID'] > 0)
						echo '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Dear Customer you have succesfully <b> Registered</b>.
							Please <b> Login </b> and submit your shipping address details.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
					}
				?>

			</div>
		</div>
		<div class="mb-6">
			<!-- CREATE A EMPTY SPACE BETWEEN CONTENT -->
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-5">
						<ul class="checkout-steps">
							<h2 class="step-title">Log In</h2>
							<li>
								<form action="" method="post">
									<div class="form-group required-field">
										<div class="form-control-tooltip">
											<input type="email" name="user_email" class="form-control" placeholder="type your email address" required>
											<span class="input-tooltip" data-toggle="tooltip" title="We'll send your order confirmation here." data-placement="right">
												<i class="icon-question-circle"></i>
											</span>
										</div>
									</div>
									<div class="form-group required-field">
										<input type="password" name="user_pass" class="form-control" placeholder="type your password" required>
									</div>
									<p>You already have an account with us. Sign in or continue..</p>
									<div class="form-footer">
										<button type="submit" name="user_login" class="btn btn-primary">LOGIN</button>
										<a href="forgot-password.php" class="forget-pass"> Forgot your password?</a>
									</div>
								</form>
							</li>
							<div class="checkout-discount">
								<h2 class="step-title">
									<a data-toggle="collapse" href="#checkout-discount-section" class="collapsed" role="button" aria-expanded="false" aria-controls="checkout-discount-section">
										Create a New Account
									</a>
								</h2>
								<li>
									<div class="collapse" id="checkout-discount-section">
										<form action="" method="post">
											<div class="row">
												<div class="col-sm-12">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group required-field">
																<label for="acc-name">First Name</label>
																<input type="text" class="form-control" name="acc_Firstname" placeholder="type your first name" required>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group required-field">
																<label for="acc-mname">Last Name</label>
																<input type="text" class="form-control"  name="acc_Lastname" placeholder="type your last name" required>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group required-field">
												<label for="acc-email">Email</label>
												<input type="email" class="form-control"  name="acc_Emailadd" placeholder="type your mail address e.g. someone@gmail.com" required>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<div class="row">
														<div class="col-md-7">
															<div class="form-group required-field">
																<label for="acc-password">Password</label>
																<input type="password" class="form-control" name="acc_Setpass" placeholder="e.g. some@one#$num%" required>
															</div>					
														</div>									
														<div class="col-md-5">
															<div class="form-group required-field">
																<label for="acc-password">Mobile No</label>
																<input type="text" class="form-control" name="acc_Setmobile" placeholder="01*********" required>
															</div>					
														</div>					
													</div>					
												</div>					
											</div>	
											<div class="form-group required-field">
												<label for="acc-email">Your Address</label>
												<input type="text" class="form-control" name="acc_Setaddress" placeholder="type your address please..." required>
											</div>
											<div class="required text-left">* Required Field</div>
											<div class="form-footer">
												<div class="form-footer-left">
													<button type="submit" name="customerRegistration" class="btn btn-primary">Register</button>
												</div>
											</div>
										</form>
									</div>
								</li>
							</div>
						</ul>
					</div>
					<div class="col-lg-5 offset-lg-2">
						<ul class="checkout-steps">
							<li>
								<h2 class="step-title mb-2">Shipping Address</h2>
								<form action="payments.php" method="post">
									<div class="form-group required-field">
										<label>First Name </label>
										<input type="text" id="f1" name="shipadd_fname" class="form-control">
									</div>
									<div class="form-group required-field">
										<label>Last Name </label>
										<input type="text" id="f2" name="shipadd_lname" class="form-control">
									</div>
									<div class="form-group">
										<label>Profession <span class="text-warning">(optional)</span></label>
										<input type="text" name="shipadd_cmpny" class="form-control">
									</div>
									<div class="form-group required-field">
										<label>Street Address </label>
										<input type="text" id="f3" name="shipadd_stadd" class="form-control">
									</div>
									<div class="form-group required-field">
										<label>City </label>
										<input type="text" id="f4" name="shipadd_cty" class="form-control">
									</div>
									<div class="form-group required-field">
										<label>Zip/Postal Code</label>
										<input type="text" id="f5" name="shipadd_zopc" class="form-control">
									</div>
									<div class="form-group">
										<label>Country</label>
										<input type="text" name="shipadd_cntry" class="form-control" value="Bangladesh">
									</div>
									<div class="form-group required-field">
										<label>Phone Number </label>
										<div class="form-control-tooltip">
											<input type="tel" id="f6" name="shipadd_phn" class="form-control">
											<span class="input-tooltip" data-toggle="tooltip" title="For delivery questions." data-placement="right">
												<i class="icon-question-circle"></i>
											</span>
										</div>
									</div>
										<div id="error-message"></div>
									<button type="submit" name="proceed_to_payment" id="save-data" class="btn btn-sm btn-warning float-right"> 
										Submit and Proceed to Payment
									</button>
								</form>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="mb-6">
		<!-- CREATE A EMPTY SPACE BETWEEN CONTENT -->
	</div>
</main>
<!--=*= ORDER SUBMISSION SECTION START =*=-->

<!--=*= FORM VALIDATION SCRIPT START =*=-->
<script type="text/javascript">
	$(document).ready(function(){
		$('#save-data').click(function(e){
			
			var fName = $("#f1").val();
			var lName = $("#f2").val();
			var stAdd = $("#f3").val();
			var city = $("#f4").val();
			var zipCode = $("#f5").val();
			var phone = $("#f6").val();
			
			if(fName == '' || lName == '' || stAdd == '' || city == '' || zipCode == '' || phone == '') {
				e.preventDefault();				
				$("#error-message").html('<div class="alert alert-warning alert-dismissible fade show" role="alert">All fields <b>*</b> are required!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>').slideDown();
			} else {
				return true;
			}
		});
	});
</script>
<!--=*= FORM VALIDATION SCRIPT END =*=-->
