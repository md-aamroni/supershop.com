<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/AdminController.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$adminCtrl = new AdminController;

## ===*=== [L]OGIN ACCESS ===*=== ##
if(isset($_POST['unlock']))
{
	#== LOGIN FORM INPUT FIELD
	$password = sha1($_POST['password']);
	
	#== CHECK VALUES WHICH USER PASSES THE DATA
	$adminData = $adminCtrl->unLock($password);
	
	if(!empty($adminData))
	{
		#== IF USER ID AND PASSWORD IS VALID THEN REDIRECT TO THE DASHBOARD PAGE 
		header("Location: dashboard.php");
	}
}
## ===*=== [L]OGIN ACCESS ===*=== ##
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<meta name="description" content="Back End Development">
		<meta name="author" content="Md. Abdullah Al Mamun Roni">
		
		<title>Admin Login | SuperShop</title>
		
		<!--=*= CSS FILES SOURCE START =*=-->
		<link rel="shortcut icon" href="../public/assets/images/favicon/faviconBackEnd.png" type="image/png">
		<link href="public/css/style.css" rel="stylesheet">
		<link href="public/css/style-responsive.css" rel="stylesheet">
		<!--=*= CSS FILES SOURCE END =*=-->
		
		<!--=*= JS FILES SOURCE START =*=-->
		<script src="./public/js/jquery-3.5.1.min.js"></script>
		<script src="./public/js/bootstrap.min.js"></script>
		<script src="./public/js/modernizr.min.js"></script>
		<!--=*= JS FILES SOURCE END =*=-->
		
		<!--=*= DISABLE IMAGE DRAG PROPERTIES =*=-->
		<style>
			img {
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
			user-select: none;
			-webkit-user-drag: none;
			user-drag: none;
			-webkit-touch-callout: none;
			}
		</style>
		<!--=*= DISABLE IMAGE DRAG PROPERTIES =*=-->
	</head>
	
	<body class="lock-screen">
		
		<div class="lock-wrapper">
			<div class="panel lock-box text-center">
            <img alt="lock avatar" src="<?php echo $GLOBALS['ADMINS_DIRECTORY'] . $_SESSION['SMC_login_admin_image'] ?>" style="width: 102px; height: 102px;">
            <div class="locked">
					<i class="fa fa-lock"></i>
				</div>
            <h1> <?php echo $_SESSION['SMC_login_admin_name'] ?> </h1>
            <div class="row">
					<form action="" method="post" class="form-inline" role="form">
						<div class="form-group col-md-12 col-sm-12 col-xs-12">
							<input type="password" name="password" class="form-control lock-input" placeholder="Password">
							<button type="submit" class="btn btn-lock pull-right" name="unlock">
								<i class="fa fa-check"></i>
							</button>
						</div>
					</form>
				</div>
			</div>
			
			<?php
				if(isset($_POST['unlock']))
				{
					if($password === sha1($_POST['password']))
					{
						echo '<div class="alert alert-warning"> 
						<button type="button" class="close close-sm" data-dismiss="alert"> <i class="fa fa-times"></i> </button>
						invalid password! try again or <a href="index.php"> <b> Login </b> </a>
						</div>';
					}
				}
			?>
			
		</div>		
	</body>
</html>		