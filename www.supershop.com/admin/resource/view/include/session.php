<?php
## ===*=== [L]OGOUT SESSION | ADMIN USER ===*=== ##
if(@$_REQUEST['exit'] == "yes")
{
	#== IN GET METHOD IF SOMEONE SENDS "yes" AS VALUE AGAINST "exit" THEN DESTROY SESSION
	session_start();
	session_destroy();
	header("Location: index.php");
}
## ===*=== [L]OGOUT SESSION | ADMIN USER ===*=== ##


## ===*=== [R]ESTRICTION ACCESS | ADMIN ===*=== ##
if(empty($_SESSION['SMC_login_time']) && empty($_SESSION['SMC_login_id']))
{
	#== FORCE USER TO GO TO LOGIN PAGE, IF THERE IS NO SESSION
	header("Location: index.php"); 
}
## ===*=== [R]ESTRICTION ACCESS | ADMIN ===*=== ##


## ===*=== [L]OGOUT SESSION | ADMIN USER ===*=== ##
if(@$_REQUEST['exit'] == "lock")
{
	#== IN GET METHOD IF SOMEONE SENDS "lock" AS VALUE AGAINST "exit"
	header("Location: lock-screen.php");
}
## ===*=== [L]OGOUT SESSION | ADMIN USER ===*=== ##


## ===*=== [A]DMIN ACCESS LABEL CONTROL | ADMIN ===*=== ##
$pagename = basename($_SERVER['PHP_SELF']);

#== TECHNICAL OPERATOR
$technicalOperatorPages = ['create-product.php', 'list-product.php', 'create-slider.php', 'list-slider.php', 'list-customer.php', 'invoice-list.php'];

if(in_array($pagename, $technicalOperatorPages) && $_SESSION['SMC_login_admin_type'] == "Technical Operator")
{
	header("Location: dashboard.php");
}

#== CONTENT MANAGER
$contentManagerPages = ['create-admin.php', 'list-admin.php', 'create-category.php', 'list-category.php', 'create-subcategory.php', 'list-subcategory.php', 'list-customer.php', 'list-order.php', 'detail-order.php', 'invoice-list.php'];

if(in_array($pagename, $contentManagerPages) && $_SESSION['SMC_login_admin_type'] == "Content Manager")
{
	header("Location: dashboard.php");
}

#== SALES MANAGER
$salesManagerPages = ['create-product.php', 'list-product.php', 'create-slider.php', 'list-slider.php', 'create-admin.php', 'list-admin.php', 'create-category.php', 'list-category.php', 'create-subcategory.php', 'list-subcategory.php'];

if(in_array($pagename, $salesManagerPages) && $_SESSION['SMC_login_admin_type'] == "Sales Manager")
{
	header("Location: dashboard.php");
}
## ===*=== [A]DMIN ACCESS LABEL CONTROL | ADMIN ===*=== ##

?>