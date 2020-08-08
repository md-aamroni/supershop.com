<!DOCTYPE html>
<html lang="en">
	<head>

	<?php
			$pageName = basename($_SERVER['PHP_SELF']);
			$pageName = str_replace('.php', '', $pageName);

			if($pageName === 'index')
			{
				$pageTitle = ucwords('Online Shopping');
			}
			else
			{
				$strReplace =  str_replace('-', ' ', $pageName);
				$pageTitle = ucwords($strReplace);
			}
		?>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<meta name="description" content="Back End Development">
		<meta name="author" content="Md. Abdullah Al Mamun Roni">
		<link rel="shortcut icon" href="../public/assets/images/favicon/faviconBackEnd.png" type="image/png">
		
		<title>SuperShop | <?php echo $pageTitle ?> </title>
		
		<!--=*= CSS FILES SOURCE START =*=-->
		<link href="public/summernote/summernote-lite.min.css" rel="stylesheet">
		<link href="public/js/datatable/css/demo_table.css" rel="stylesheet">
		<link href="public/css/style.css" rel="stylesheet">
		<link href="public/css/style-responsive.css" rel="stylesheet">
		<link href="public/css/custom.css" rel="stylesheet">
		<!--=*= CSS FILES SOURCE END =*=-->
		
		<!--=*= JS SOURCE START =*=-->
		<script src="public/js/jquery-3.5.1.min.js"></script>
		<script src='public/tagplug/index.js'></script>
		<!--=*= JS SOURCE END =*=-->
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="public/js/html5shiv.js"></script>
			<script src="public/js/respond.min.js"></script>
		<![endif]-->
	</head>
	
	<body class="sticky-header">
		<section>
			<div class="left-side sticky-left-side">														
				<div class="logo">
					<a href="dashboard.php">
						<img src="../public/assets/images/favicon/logoBackEnd.png" alt="" height="36px">
					</a>
				</div>
				<div class="logo-icon text-center">
					<a href="dashboard.php">
						<img src="../public/assets/images/favicon/logoBackEnd(1).png" alt="" height="34px" width="34px">
					</a>
				</div>
				<div class="left-side-inner">
					
					<!--=*= VISIBLE ON SMALL DEVICES =*=-->
					<div class="visible-xs hidden-sm hidden-md hidden-lg">			
						<div class="media logged-user">
							<img alt="" src="<?php echo $GLOBALS['ADMINS_DIRECTORY'] . $_SESSION['SMC_login_admin_image']; ?>" class="media-object">
							<div class="media-body">
								<h4> <a href="#"> <?php echo $_SESSION['SMC_login_admin_name']; ?> </a> </h4>
								<span> FULL STACK WEB DEVELOPER </span>
							</div>
						</div>
						<h5 class="left-nav-title"> Account Information </h5>
						<ul class="nav nav-pills nav-stacked custom-nav">
							<li>
								<a href="?exit=lock"> <i class="fa fa-user"></i> <span> Lock Screen </span> </a>
							</li>
							<li>
								<a href="?exit=yes"> <i class="fa fa-sign-out"></i> <span> Sign Out </span> </a>
							</li>
						</ul>
					</div>
					<!--=*= VISIBLE ON SMALL DEVICES =*=-->
					
					<ul class="nav nav-pills nav-stacked custom-nav">
						<li>
							<a href="dashboard.php">
								<i class="fa fa-home"></i> <span>Dashboard</span>
							</a>
						</li>
						
						<?php
							## ===*=== [A]CCESS CONTROL CONTENT START ===*=== ##
							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Technical Operator")
							{
								echo '
								<li class="menu-list">
									<a href="#"> <i class="fa fa-user"></i> <span>Manage Admin</span> </a>
									<ul class="sub-menu-list">
										<li>
											<a href="create-admin.php"> <i class="fa fa-plus-circle"></i> Create Admin </a>
										</li>
										<li>
											<a href="list-admin.php"> <i class="fa fa-user"></i> List Admin </a>
										</li>
									</ul>
								</li>
								';
							}
							
							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Content Manager")
							{
								echo '
								<li class="menu-list">
									<a href="#"> <i class="fa fa-picture-o"></i></i> <span> Manage Slider </span> </a> <i class="fas fa-sliders-h"></i>
									<ul class="sub-menu-list">
										<li>
											<a href="create-slider.php"> Add Image Slider </a>
										</li>
										<li>
											<a href="list-slider.php"> List Image Slider </a>
										</li>
									</ul>
								</li>
								';
							}
							
							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Sales Manager")
							{
								echo '
								<li class="menu-list">
									<a href="#"> <i class="fa fa-users"></i> <span> Manage Customer </span> </a>
									<ul class="sub-menu-list">
										<li>
											<a href="list-customer.php"> Customer List </a>
										</li>
										<li>
											<a href="review.php"> Customer Overview </a>
										</li>
									</ul>
								</li>
								';
							}
							
							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Technical Operator")
							{
								echo '
								<li class="menu-list">
									<a href="#"> <i class="fa fa-folder-open"></i> <span> Manage Category </span> </a>
									<ul class="sub-menu-list">
										<li>
											<a href="create-category.php"> Create Category </a>
										</li>
										<li>
											<a href="list-category.php"> List Category </a>
										</li>
									</ul>
								</li>
								';
							}
							
							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Technical Operator")
							{
								echo '
								<li class="menu-list">
									<a href="#"> <i class="fa fa-list-alt"></i> <span> Manage Sub Category </span> </a>
									<ul class="sub-menu-list">
										<li>
											<a href="create-subcategory.php"> Create Sub Category </a>
										</li>
										<li>
											<a href="list-subcategory.php"> Sub Category List </a>
										</li>
									</ul>
								</li>
								';
							}
							
							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Content Manager")
							{
								echo '
								<li class="menu-list">
									<a href="#"> <i class="fa fa-th"></i> <span> Manage Products </span> </a>
									<ul class="sub-menu-list">
										<li>
											<a href="create-product.php"> Create Products</a>
										</li>
										<li>
											<a href="list-product.php"> Products List </a>
										</li>
									</ul>
								</li>
								';
							}
							
							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Sales Manager")
							{
								echo '
								<li class="menu-list">
									<a href="#"> <i class="fa fa-tags"></i> <span> Manage Orders </span> </a> <i class="fas fa-sort-amount-up-alt"></i>
									<ul class="sub-menu-list">
										<li>
										<a href="list-order.php"> Orders List </a>
										</li>
										<li>
										<a href="invoice-list.php"> Invoice List </a>
										</li>
									</ul>
								</li>';
							}
							
							if($_SESSION['SMC_login_admin_type'] == "Root Admin" || $_SESSION['SMC_login_admin_type'] == "Sales Manager")
							{
								echo '
								<li class="menu-list">
									<a href="#"> <i class="fa fa-tags"></i> <span> SEO </span> </a> <i class="fas fa-sort-amount-up-alt"></i>
									<ul class="sub-menu-list">
										<li>
											<a href="pages.php"> Pages </a>
										</li>										
										<li>
											<a href="pages-details.php"> Pages Details </a>
										</li>
									</ul>
								</li>';
							}
							## ===*=== [A]CCESS CONTROL CONTENT END ===*=== ##
						?>
						
					</ul>
				</div>
			</div>
				
				
				<!--=*= MAIN CONTENT START =*=-->
				<div class="main-content" >
					<div class="header-section">
						<a class="toggle-btn"> <i class="fa fa-bars"></i> </a>
						
						<form class="searchform" action="" method="post">
							<input type="text" class="form-control" name="keyword" placeholder="Search here..." />
						</form>
						
						<div class="menu-right">
							<ul class="notification-menu">
								<li>
									<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
										<img src="<?php echo $GLOBALS['ADMINS_DIRECTORY'] . $_SESSION['SMC_login_admin_image']; ?>" alt="" />
										<?php echo $_SESSION['SMC_login_admin_name']; ?> 
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu dropdown-menu-usermenu pull-right">
										<li>
											<a href="?exit=lock"><i class="fa fa-user"></i> Lock Screen </a>
										</li>
										<li>
											<a href="?exit=yes"><i class="fa fa-sign-out"></i> Log Out </a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>																																																