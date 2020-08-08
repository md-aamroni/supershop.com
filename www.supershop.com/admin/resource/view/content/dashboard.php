<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/DashboardController.php");
include("app/Models/Eloquent.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$dashboard = new DashboardController;
$eloquent = new Eloquent;


## ===*=== [F]ETCH SUMMARY DATA ===*=== ##

#== TOTAL SALE STATUS
$saleResult = $dashboard->sumResult('orders', 'grand_total');
$totalSale = ceil($saleResult[0]['SUM(grand_total)']);	


#== THIS MONTH SALE STATUS
$monthResult = $dashboard->sumByDate('orders', 'grand_total', 'order_date');
$monthSale = ceil($monthResult[0]['SUM(grand_total)']);


#== NEWLY ADDED PRODUCT STATUS
$newResult = $dashboard->dateData('products', 'created_at');
$newProduct = count($newResult);	


#== TOTAL TAX STATUS
$taxResult = $dashboard->sumResult('orders', 'tax');
$totalTax = ceil($taxResult[0]['SUM(tax)']);	


#== NEW ORDER STATUS
$orderResult = $dashboard->getData('orders', 'order_item_status', 'Pending');
$totalOrder = count($orderResult);


#== PRODUCT STATUS
$columnName = $tableName = null;
$columnName["1"] = "id";
$tableName = "products";
$productResult = $eloquent->selectData($columnName, $tableName);
$totalProduct = count($productResult);	


#== SUBSCRIBER STATUS
$columnName = $tableName = null;
$columnName["1"] = "id";
$tableName = "newsletters";
$subscriberResult = $eloquent->selectData($columnName, $tableName);
$totalSubscriber = count($subscriberResult);	


#== CUSTOMER STATUS
$columnName = $tableName = null;
$columnName["1"] = "id";
$tableName = "customers";
$customerResult = $eloquent->selectData($columnName, $tableName);
$totalCustomer = count($customerResult);

## ===*=== [F]ETCH SUMMARY DATA ===*=== ##
?>

<!--=*= DASHBOARD SECTION START =*=-->
<div class="wrapper">	
	<div class="row states-info" style="text-transform: uppercase;">
		<div class="col-md-3">
			<div class="panel red-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-usd"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Total Sale </span>
							<h4 class="counter"> <?= $totalSale ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel blue-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-tags"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Sales This Month </span>
							<h4 class="counter"> <?= $monthSale ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel green-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-gavel"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> New Order </span>
							<h4 class="counter"> <?= $totalOrder ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel yellow-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-file-text"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Total Tax </span>
							<h4 class="counter"> <?= $totalTax ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<div class="row states-info" style="text-transform: uppercase;">
		<div class="col-md-3">
			<div class="panel green-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-dot-circle-o"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> New Products Added </span>
							<h4 class="counter"> <?= $newProduct ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel yellow-bg">
				
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-anchor"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Total Products </span>
							<h4 class="counter"> <?= $totalProduct ?></h4>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel red-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-chain"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Newsletter Subscriber </span>
							<h4 class="counter"> <?= $totalSubscriber ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel blue-bg">
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-4">
							<i class="fa fa-user"></i>
						</div>
						<div class="col-xs-8">
							<span class="state-title"> Register Customer </span>
							<h4 class="counter"> <?= $totalCustomer ?> </h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-body">
							<div class="profile-pic text-center">
								<img alt="" src="<?php echo $GLOBALS['ADMINS_DIRECTORY'] . $_SESSION['SMC_login_admin_image']; ?>">
							</div>
							<div class="text-center" style="padding-bottom: 10px;">
								<h3> <?php echo $_SESSION['SMC_login_admin_name']; ?> </h3>
								<h5 class="designation"> FULL STACK WEB DEVELOPER </h5>
							</div>
							<a class="btn p-follow-btn pull-left" href="#"> <i class="fa fa-check"></i> Following</a>
							<ul class="p-social-link pull-right">
								<li class="active">
									<a href="#">
										<i class="fa fa-github"></i>
									</a>
								</li>
								<li class="active">
									<a href="#">
										<i class="fa fa-stack-overflow"></i>
									</a>
								</li>
								<li class="active">
									<a href="#">
										<i class="fa fa-linkedin"></i>
									</a>
								</li>										
								<li class="active">
									<a href="#">
										<i class="fa fa-facebook"></i>
									</a>
								</li>									
								<li class="active">
									<a href="#">
										<i class="fa fa-twitter"></i>
									</a>
								</li>									
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-body">
							<div style="margin-bottom: 10px;">
								<a class="btn p-follow-btn" href="mailto:md.aamroni@hotmail.com"> 
									<i class="fa fa-envelope"></i> &nbsp; md.aamroni@hotmail.com 
								</a>
							</div>
							<div style="margin-bottom: 10px;">
								<a class="btn p-follow-btn" href="callto:8801316440504" style="margin-right: 8px;"> 
									<i class="fa fa-phone"></i> &nbsp; +880 1316 440504
								</a>
								<a class="btn p-follow-btn" href="skype:live:.cid.5ed7daebee5e7820"> 
									<i class="fa fa-skype"></i> &nbsp; md.aamroni
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					
					<section class="panel">
						<div class="carousel slide auto panel-body" id="c-slide">
							<ol class="carousel-indicators out">
								<li data-target="#c-slide" data-slide-to="0" class="active"></li>
								<li data-target="#c-slide" data-slide-to="1" class=""></li>
								<li data-target="#c-slide" data-slide-to="2" class=""></li>
								<li data-target="#c-slide" data-slide-to="3" class=""></li>
							</ol>
							<div class="carousel-inner">
								<div class="item text-center active">
									<h3> SUPERSHOP | ONLINE SHOPPING STORE </h3>
									<p> frontEnd Development </p>
									<p class="text-muted">
										supershop.com is a eCommerce application where all of the data is totally dynamic content
									</p>
								</div>
								<div class="item text-center">
									<h3> SUPERSHOP | ONLINE SHOPPING STORE </h3>
									<p> frontEnd Development </p>
									<p class="text-muted">
										and also lightweight as well, so that it will be load fast as user expectation and friendly
									</p>
								</div>
								<div class="item text-center">
									<h3> SUPERSHOP | ONLINE SHOPPING STORE </h3>
									<p> backEnd Development </p>
									<p class="text-muted">
										in this application, designed with MVC pattern and also clean coding standard
									</p>
								</div>								
								<div class="item text-center">
									<h3> SUPERSHOP | ONLINE SHOPPING STORE </h3>
									<p> backEnd Development </p>
									<p class="text-muted">
										without any framework, in raw PHP this application is totally dynamic for crud operation
									</p>
								</div>
							</div>
							<a class="left carousel-control" href="#c-slide" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a class="right carousel-control" href="#c-slide" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>
						</div>
					</section>
					
				</div>
				<div class="col-md-6">
					<div class="panel">
						<div class="panel-body p-states green-box">
							<div class="summary pull-left">
								<h4>Front End <span>Skiils</span></h4>
								<span>Designing Languages &amp; Libraries</span>
								<h5> HTML, CSS, Boostrap, SASS, JavaScript, jQuery & Ajax </h5>
							</div>
							<div id="expense" class="chart-bar"></div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel">
						<div class="panel-body p-states green-box">
							<div class="summary pull-left">
								<h4>Back End <span>Skiils</span></h4>
								<span>Programming Languages, Framework &amp; Database</span>
								<h5>PHP, MySQL, Laravel, Python</h5>
							</div>
							<div id="pro-refund" class="chart-bar"></div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel">
						<div class="panel-body p-states green-box">
							<div class="summary pull-left">
								<h4>Adobe Professional <span>Skiils</span></h4>
								<span>Softwares and Platforms</span>
								<h5>Adobe Photoshop CC | Adobe Illustrator CC </h5>
							</div>
							<div id="expense2" class="chart-bar"></div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel">
						<div class="panel-body p-states green-box">
							<div class="summary pull-left">
								<h4>Others <span>Skiils</span></h4>
								<span>Softwares and Platforms</span>
								<h5> Microsoft Office 2019 | SEO | Digital Marketing </h5>
							</div>
							<div id="expense2" class="chart-bar"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--=*= DASHBOARD SECTION END =*=-->
