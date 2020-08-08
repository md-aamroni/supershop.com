<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$eloquent = new Eloquent;


## ===*=== [W]HEN USER TRY TO LOG IN ===*=== ##
if( isset($_POST['user_login']) )
{
	#== FETCH DATA FROM THE CUSTOMER TABLE AND VALIDATE WITH SUBMITTED DATA
	$columnName = "*";
	$tableName = "customers";
	$whereValue["customer_email"] = $_POST['user_email'];
	$whereValue["customer_password"] = sha1($_POST['user_pass']);
	$userLogin = $eloquent->selectData($columnName, $tableName, @$whereValue);
	
	#== AFTER VALIDATAION CREATE A SESSION FOR USER ENTIRE FRONT END APPLICATION
	if(!empty($userLogin))
	{
		$_SESSION['SSCF_login_time'] = date("Y-m-d H:i:s");
		$_SESSION['SSCF_login_id'] = $userLogin[0]['id'];
		$_SESSION['SSCF_login_user_name'] = $userLogin[0]['customer_name'];
		$_SESSION['SSCF_login_user_email'] = $userLogin[0]['customer_email'];
		$_SESSION['SSCF_login_user_mobile'] = $userLogin[0]['customer_mobile'];
		$_SESSION['SSCF_login_user_address'] = $userLogin[0]['customer_address'];
		
		echo '<meta http-equiv="Refresh" content="0; url=index.php" />';
	}
}
## ===*=== [W]HEN USER TRY TO LOG IN ===*=== ##
?>

<!--=*= LOG IN SECTION START =*=-->
<main class="main">
	<nav aria-label="breadcrumb" class="breadcrumb-nav">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">HOME </a></li>
				<li class="breadcrumb-item"><a href="login.php">LOG IN </a></li>
			</ol>
		</div>
	</nav>
	<div class="container">
		
		<?php
			if(isset($_POST['user_login']))
			{
				#== ERROR MESSAGE IF USER IS EMPTY OR NOT REGISTER
				if(empty($userLogin))
				{
					echo '<div class="alert alert-danger">Either customer dosen\'t exist or credential is wrong. Please retry!</div>';
				}
			}
		?>
		
		<div class="row">
			<div class="col">
				<div class="featured-boxes">
					<div class="row">
						<div class="col-md-5 offset-md-1">
						</div>
						<div class="col-md-5 offset-md-1">
							<div class="featured-box featured-box-primary text-left mt-5">
								<div class="box-content">
									<h2 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">LOG IN</h2>
									<form action="" id="frmSignIn" method="post" class="needs-validation">
										<div class="form-row">
											<div class="form-group col">
												<label class="font-weight-bold text-dark text-2">E-mail Address</label>
												<input type="email" name="user_email" class="form-control form-control-lg" placeholder="type your email address" required>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col">
												<a class="float-right" href="user-password.php">(forgot your Password?)</a>
												<label class="font-weight-bold text-dark text-2">Password</label>
												<input type="password" name="user_pass" class="form-control form-control-lg" placeholder="type your password" required>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-lg-6">
												<!-- CREATE A EMPTY SPACE BETWEEN CONTENT -->
											</div>
										</div>
										<div class="form-footer">
											<a href="index.php" class="btn btn-outline-warning">
												<i class="icon-angle-double-left"></i>BACK TO HOME
											</a>
											<div class="form-footer-right">
												<button type="submit" name="user_login" class="btn btn-primary">LOGIN</button>
											</div>
										</div>
										<div class="form-row">
											<div class="font-weight-bold text-info text-2">
												OR | <a href="register-account.php" class="btn btn-info">REGISTER AN ACCOUNT</a>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>	
<!--=*= LOG IN SECTION END =*=-->