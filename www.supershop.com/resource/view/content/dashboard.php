<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;


## ===*=== [U]PDATE CUSTOMER ACCOUNT INFORMATION ===*=== ##
if(isset($_POST['update_accinfo']))
{
	$tableName = "customers";
	$columnValue["customer_name"] = $_POST['upcstmr_name'];
	$columnValue["customer_email"] = $_POST['upcstmr_email'];
	$columnValue["customer_mobile"] = $_POST['upcstmr_phn'];
	$columnValue["customer_address"] = $_POST['upcstmr_add'];
	$whereValue["id"] = $_SESSION['SSCF_login_id'] ;
	$updatecustomerData = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}
## ===*=== [U]PDATE CUSTOMER ACCOUNT INFORMATION ===*=== ##


## ===*=== [F]ETCH SHIPPING DATA WHEN USER LOGED IN AND HAVE SUBMITTED ===*=== ##
if(@$_SESSION['SSCF_login_id'] > 0)
{
	$columnName = $tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "shippings";
	$whereValue["shippings.customer_id"] = $_SESSION['SSCF_login_id'];
	$cstmrShipDetails = $eloquent->selectData($columnName, $tableName, @$whereValue);		
	
	$columnName = $tableName = $whereValue = null;
	$columnName = "*";
	$tableName = "customers";
	$whereValue["id"] = $_SESSION['SSCF_login_id'];
	$cstmrDetails = $eloquent->selectData($columnName, $tableName, @$whereValue);

}
## ===*=== [F]ETCH SHIPPING DATA WHEN USER LOGED IN AND HAVE SUBMITTED ===*=== ##
?>

<!--=*= DASHBOARD SECTION START =*=-->
<main class="main">
	<nav aria-label="breadcrumb" class="breadcrumb-nav">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
			</ol>
		</div>
	</nav>	
	<div class="container">
		<div class="row">
			<div class="col-lg-9 order-lg-last dashboard-content">
				<h2>MY DASHBOARD</h2>
				
				<?php
					#== A GREETING MESSEGE IF USER LOGGED IN
					if(@$_SESSION['SSCF_login_id'] > 0)
					{
						echo '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Hello, <strong>'. @$_SESSION['SSCF_login_user_name'] .'</strong> Welcome to your account dashboard and you could update your account information.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						';
					}
					
					#== IF ACCOUNT IS UPDATED A SUCCESS MESSAGE WILL BE APPEAR
					if(isset($_POST['update_accinfo']))
					{
						if(@$updatecustomerData > 0)
						echo '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Hello, <strong>'. @$_SESSION['SSCF_login_user_name'] .'</strong> Your account information is successfully updated.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						';
					}
				?> 
				
				<div class="mb-4">
					<!--=*= CREATE A EMPTY SPACE BETWEEN CONTENT =*=-->
				</div>
				<h3>Account Information</h3>
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								Contact Information
							</div>
							<div class="card-body">
								
								<?php 
									#== CONTACT INFORMATION
									if(@$_SESSION['SSCF_login_id'] > 0) 
									{
										echo '<p>'. $cstmrDetails[0]['customer_name'] .'<br/>'. $cstmrDetails[0]['customer_email'] .'<br/>'. $cstmrDetails[0]['customer_mobile'] .'</p>';
									} 
									else 
									{
										echo '<p> You have not create an account. <a href="register-account.php" class="text-info"> <b>Register an Account</b> </a> </p>';
									}
								?>
								
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
							<div class="card-header"> Newsletters </div>
							<div class="card-body">
								
								<?php
									#== NEWSLETTER INFORMATION
									if(!empty($_SESSION['SMCF_login_user_newsletter'])) //newsletter section work in pending
									{
										if(@$_SESSION['SSCF_login_id'] > 0)
										echo "<p>" . @$_SESSION['SMCF_login_user_newsletter'] . "</p>";
										else
										echo '<p> You are currently not subscribed to any newsletter. </p>';
									}
									else
									{
										echo '<p> You are currently not subscribed to any newsletter. </p>';
									}
								?>
								
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header"> Address Book </div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<h4 class="">Your Billing Address</h4>
								
								<?php 
									#== REGISTERED CUSTOMER ADDRESS DATA
									if(@$_SESSION['SSCF_login_id'] > 0) {
										echo '<address>' . @$cstmrDetails[0]['customer_address'] . '</address>';
										} else {
										echo '<p> You have not set a default shipping address. </p>';
									}
								?>
								
							</div>
							<div class="col-md-6">
								<h4 class="">Last Shipping Address</h4>
								
								<?php
									#== SHIPPING ADDRESS DATA
									if(@$_SESSION['SSCF_login_id'] > 0) {
										echo '<address> '. 
										@$cstmrShipDetails[0]['shipcstmr_name'] . '<br/>' .
										@$cstmrShipDetails[0]['shipcstmr_mobile'] . '<br/>' .
										@$cstmrShipDetails[0]['shipcstmr_profession'] . '<br/>' .
										@$cstmrShipDetails[0]['shipcstmr_streetadd'] . '<br/>' .
										@$cstmrShipDetails[0]['shipcstmr_city'] . "-" . @$cstmrShipDetails[0]['shipcstmr_zip'] . '<br/>' .
										@$cstmrShipDetails[0]['shipcstmr_country'] . '<br/>' .
										'</address>';
										} else {
										echo '<p> You have not set a default shipping address. </p>';
									}
								?>
								
							</div>
						</div>
					</div>
				</div>
				<div>
					
					<?php
						#== EDIT ACCOUNT BUTTON
						if(@$_SESSION['SSCF_login_id'] > 0)
						{
					?>
						
						<div class="checkout-discount">
							<h2 class="step-title">
								<a data-toggle="collapse" href="#edit-account" class="collapsed card-edit btn btn-sm btn-outline-info float-right" role="button">
									Edit Account Information
								</a>
							</h2>
							<div class="collapse" id="edit-account">
								<form action="" method="post">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group required-field">
												<input type="text" name="upcstmr_name" class="form-control" name="" value="<?php echo $cstmrDetails[0]['customer_name']; ?>">
											</div>
											<div class="form-group required-field">
												<input type="email" name="upcstmr_email" class="form-control" value="<?php echo $cstmrDetails[0]['customer_email']; ?>">
											</div>
											<div class="form-group required-field">
												<input type="text" name="upcstmr_phn" class="form-control" value="<?php echo $cstmrDetails[0]['customer_mobile']; ?>">
											</div>
											<div class="form-group required-field">
												<input type="text" name="upcstmr_add" class="form-control" value="<?php echo $cstmrDetails[0]['customer_address']; ?>">
											</div>
											<button type="submit" name="update_accinfo" class="btn btn-sm btn-outline-info">Update</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						
					<?php
						}
					?>
					
				</div>
			</div>
			
			<aside class="sidebar col-lg-3">
				<div class="widget widget-dashboard">
					<h3 class="widget-title">My Account</h3>
					<ul class="list">
						<li class="active"><a href="dashboard.php">Account Dashboard</a></li>
						<li><a href="register-account.php">Register an Account</a></li>
						<li><a href="user-password.php">Change Password</a></li>
						<!-- 
							=*= FOR LATER USED ONLY =*=
							<li><a href="#">My Orders</a></li>
							<li><a href="#">Billing Agreements</a></li>
							<li><a href="#">Recurring Profiles</a></li>
							<li><a href="#">My Product Reviews</a></li>
							<li><a href="#">My Tags</a></li>
							<li><a href="#">My Wishlist</a></li>
							<li><a href="#">My Applications</a></li>
							<li><a href="#">Newsletter Subscriptions</a></li>
							<li><a href="#">My Downloadable Products</a></li>
						-->
					</ul>
					</div>
				</aside>
			</div>
	</div>
	<div class="mb-5">
		<!-- CREATE A EMPTY SPACE BETWEEN CONTENT -->
	</div>
</main>
<!--=*= DASHBOARD SECTION START =*=-->