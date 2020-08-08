<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;

?>

<!--=*= FORGOT AND RESET PASSWORD SECTION START =*=-->
<main class="main">
	<nav aria-label="breadcrumb" class="breadcrumb-nav">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
			</ol>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 order-lg-last dashboard-content">
			
				<?php 
					if(@$_SESSION['SSCF_login_id'] > 0) 
					{ 
				?>
					<div class="col-md-12">
						<form action="" method="">
							<div style="margin-top: -40px;">
								<h2>CHANGE PASSWORD</h2>
								<div class="form-group required-field">
									<label for="acc-pass2">Current Password</label>
									<input type="password" class="form-control" id="acc-pass2" name="acc-pass2">
								</div>						
								<div class="form-group required-field">
									<label for="acc-pass2">New Password</label>
									<input type="password" class="form-control" id="acc-pass2" name="acc-pass2">
								</div>
								<div class="form-group required-field">
									<label for="acc-pass3">Confirm Password</label>
									<input type="password" class="form-control" id="acc-pass3" name="acc-pass3">
								</div>
								<div class="form-footer">
									<button type="submit" class="btn btn-primary">Update Password</button>
								</div>
							</div>
						</form>
					</div>
					
				<?php 
					} 
					else 
					{
				?>
					<div class="col-md-12">
						<div class="heading mb-4">
							<h2 class="title">Reset Password</h2>
							<p>Please enter your email address below to receive a password reset link.</p>
						</div>
						<form action="" method="post">
							<div class="form-group required-field">
								<label for="reset-email">Email</label>
								<input type="email" class="form-control" id="reset-email" name="reset-email" required>
							</div>
							<div class="form-footer">
								<button type="submit" class="btn btn-primary">Reset My Password</button>
							</div>
						</form>
					</div>
					
				<?php 
					} 
				?>
		
			</div>
			<aside class="sidebar col-lg-3">
				<div class="widget widget-dashboard">
					<h3 class="widget-title">My Account</h3>
					<ul class="list">
						<li><a href="dashboard.php">Account Dashboard</a></li>
						<li><a href="register-account.php">Register an Account</a></li>
						<li class="active"><a href="user-password.php">Change Password</a></li>
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
	<div class="mb-10">
		<!-- CREATE A EMPTY SPACE BETWEEN CONTENT -->
	</div>
</main>
<!--=*= FORGOT AND RESET PASSWORD SECTION END =*=-->