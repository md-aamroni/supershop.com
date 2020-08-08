<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/PageController.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$pageControl = new PageController;
$eloquent = new Eloquent;


## ===*=== [G]ET PRODUCT DATA IN A CATEGORY PAGE BASED ON SUBCATEGORY ID ===*=== ##
if(isset($_REQUEST['id']))
{
	#== CREATE A SESSION BASED ON REQUESTED ID
	$_SESSION['category_subcategory_id'] = $_REQUEST['id'];
}

if(empty($_SESSION['category_subcategory_id']))
{
	#== IF USER HIT URL DIRECTLY SO ON THE CATEGORY PAGE APPEARED BASED ON A STATIC SESSION DATA SUCH AS 1
	$_SESSION['category_subcategory_id'] = 1;
}
## ===*=== [G]ET PRODUCT DATA IN A CATEGORY PAGE BASED ON SUBCATEGORY ID ===*=== ##


## ===*=== [F]ETCH PRODUCT DATA BASED ON SUBCATEGORY ===*=== ##	
// $categoryDetails = $pageControl->fetchData('products', 'subcategory_id', $_SESSION['category_subcategory_id']);

// #== (nod = Number of Data) COUNT HOW MANY DATA IS AVAILABLE IN THIS SUBCATEGORY
// if($categoryDetails > 0)
// {
// 	$nod = count($categoryDetails);
// }
// else
// {
// 	$nod = $categoryDetails;
// }
// #== (rpp = Result Per Page) DEFINED HOW MANY RESULT PER PAGE WILL BE DISPLAYED
// $rpp = 5;
// #== (nop = Number of Page) DEFINE HOW MANY PAGE WILL BE APPEAR FOR PAGINATION
// $nop = ceil($nod/$rpp);

// #== IF THE PAGE IS NOT SET THEN ITS RENDERING FROM PAGE NO 1
// if(!isset($_GET['page'])) {
// 	$page = 1;
// 	} else {
// 	$page = $_GET['page'];
// }

// #== TEXT WILL BE RETURN THE CUMULATIVE VALUE OF DATA
// $text = 0;
// if($text >= $nod) {
// 	$text = $nod;
// 	} else if($text < $nod) {
// 	$text = $rpp * $page;
// }

// #== (cp = Current Page) DEFINE THE DATA DISPLAYED LIMIT
// $cp = ($page -1)*$rpp;	
// $categoryDetails = $pageControl->paginateData('products', 'subcategory_id', $_SESSION['category_subcategory_id'], $cp, $rpp);

// #== BUTTON OPTION FOR NEXT OR PREVIOUS
// $previous = $page - 1;
// $next = $page + 1;

// #== EMPTY VARIABLE WHICH RETURNS THE NUMBER OF PAGES
// $pageNumber = '';														
// for($i = 1; $i <= $nop; $i++)
// {
// 	$pageNumber .= '	<li class="page-item">
// 	<a class="page-link active" href="category-list.php?page='.$i.'">
// 	'.$i.'<span class="sr-only">(current)</span>
// 	</a>
// 	</li>
// 	';
// }
$categoryDetails = $pageControl->fetchData('products', 'subcategory_id', $_SESSION['category_subcategory_id']);

if(!empty($categoryDetails))
{
	#== (nod = Number of Data) COUNT HOW MANY DATA IS AVAILABLE IN THIS SUBCATEGORY
	$nod = count($categoryDetails);
	#== (rpp = Result Per Page) DEFINED HOW MANY RESULT PER PAGE WILL BE DISPLAYED
	if($nod > 8) {
		$rpp = 8;
		} else {
		$rpp = $nod;
	}
	#== (nop = Number of Page) DEFINE HOW MANY PAGE WILL BE APPEAR FOR PAGINATION
	$nop = ceil($nod/$rpp);
	
	#== IF THE PAGE IS NOT SET THEN ITS RENDERING FROM PAGE NO 1
	if(!isset($_GET['page'])) {
		$page = 1;
		} else {
		$page = $_GET['page'];
	}
	
	#== TEXT WILL BE RETURN THE CUMULATIVE VALUE OF DATA
	$text = 0;
	if($text >= $nod) {
		$text = $nod;
		} else if($text <= $nod) {
		$text = $rpp * $page;
	}
	
	#== (cp = Current Page) DEFINE THE DATA DISPLAYED LIMIT
	$cp = ($page -1)*$rpp;	
	$categoryDetails = $pageControl->paginateData('products', 'subcategory_id', $_SESSION['category_subcategory_id'], $cp, $rpp);
	
	#== BUTTON OPTION FOR NEXT OR PREVIOUS
	$previous = $page - 1;
	$next = $page + 1;
	
	#== EMPTY VARIABLE WHICH RETURNS THE NUMBER OF PAGES
	$pageNumber = '';														
	for($i = 1; $i <= $nop; $i++)
	{
		$pageNumber .= '	<li class="page-item">
		<a class="page-link active" href="category-list.php?page='.$i.'">
		'.$i.'<span class="sr-only">(current)</span>
		</a>
		</li>
		';
	}
}
## ===*=== [F]ETCH PRODUCT DATA BASED ON SUBCATEGORY ===*=== ##


## ===*=== [F]ETCH CATEGORY AND SUBCATEGORY DATA FOR BREADCRUMB AND TOGGLE FILTER ===*=== ##
$columnName= $tableName= $whereValue= null;
$columnName["1"] = "categories.id";
$columnName["2"] = "categories.category_name";
$columnName["3"] = "subcategories.subcategory_name";
$columnName["4"] = "subcategories.subcategory_banner";
$tableName["MAIN"] = "subcategories";
$joinType = "INNER";
$tableName["1"] = "categories";
$onCondition["1"] = ["subcategories.category_id", "categories.id"];
$whereValue["subcategories.id"] = $_SESSION['category_subcategory_id'];
$categoryResult = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue);
## ===*=== [F]ETCH CATEGORY AND SUBCATEGORY DATA FOR BREADCRUMB AND TOGGLE FILTER ===*=== ##
?>

<!--=*= CATEGORY LIST SECTION START =*=-->
<main class="main">
	<div class="banner banner-cat" style="background-image: url('<?= $GLOBALS['BANNER_DIRECTORY'] . $categoryResult[0]['subcategory_banner']; ?>');">
		<div class="banner-content container">
			<h2 class="banner-subtitle">
				<span>check out our latest collection <?= date("Y"); ?></span>
			</h2>
			<h1 class="banner-title">
				<?= @$categoryResult[0]['subcategory_name']; ?>
			</h1>
			<a href="#/" class="btn btn-primary">Shop Now</a>
		</div>
	</div>
	<nav aria-label="breadcrumb" class="breadcrumb-nav">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item">
					<a href="#"><?= $categoryResult[0]['category_name']; ?></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">
					<?= $categoryResult[0]['subcategory_name']; ?>
				</li>
			</ol>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				<nav class="toolbox">
					<div class="toolbox-left">
						<div class="toolbox-item toolbox-sort">
							<div class="select-custom">
								<select name="orderby" class="form-control">
									<option value="menu_order" selected="selected">DEFAULT SORTING</option>
									<option value="popularity">POPULARITY</option>
									<option value="date">NEW PRODUCT</option>
									<option value="price">PRICE (LOW to HIGH)</option>
									<option value="price-desc">PRICE (HIGH to LOW)</option>
								</select>
							</div>
							<a href="#" class="sorter-btn" title="Set Ascending Direction"><span class="sr-only">Set Ascending Direction</span></a>
						</div>
					</div>
					<div class="toolbox-item toolbox-show">

					<?php
						if(!empty($categoryDetails))
						{
							echo '<label>Showing '. ($cp + 1) . '–' . $text . ' of ' . $nod.' results</label>'; 
						}
						else
						{
							echo '<label>Showing 0-0 of 0 results</label>'; 
						}
					?>

					</div>
					<div class="layout-modes">
						<a href="category.php" class="layout-btn btn-grid" title="Grid">
							<i class="icon-mode-grid"></i>
						</a>
						<a href="category-list.php" class="layout-btn btn-list active" title="List">
							<i class="icon-mode-list"></i>
						</a>
					</div>
				</nav>
				
				<?php
					#== LIST OF PRODUCT DATA BASED ON SUBCATEGORY
					if(!empty($categoryDetails))
					{
						foreach($categoryDetails AS $eachCategory)
						{
							#== ASSIGN A NEW VARIABLE IF PRODUCT IMAGE IS NOT UNAVAILABLE
							if(empty($eachCategory['product_master_image'])) 
							{
								$productImage = "<img src='public/assets/images/no-product-found.png'>";
							} 
							else 
							{
								$productImage = $GLOBALS['PRODUCT_DIRECTORY'] . $eachCategory['product_master_image'];
							}
							
							#== IF PRODUCT DESCRIPTION IS MORE THAN 60 WORDS
							if(strlen($eachCategory['product_details']) > 218)
							{
								$prodDes = substr($eachCategory['product_details'], 0, 218) . ' ....';
							}
							
							echo '
							<div class="product product-list">
								<figure class="product-image-container">
									<a href="product.php?id='.$eachCategory['id'].'" class="categorylist-image">
										<img src="'. $productImage .'" alt="product">
									</a>
									<a href="product.php?id='.$eachCategory['id'].'" class="btn-quickview">Quick View</a>
								</figure>
								<div class="product-details">
									<h2 class="product-title">
										<a href="product.php?id='.$eachCategory['id'].'">' . $eachCategory['product_name'] . '</a>
									</h2>
									<div class="ratings-container">
										<div class="product-ratings">
											<span class="ratings" style="width:80%"></span>
										</div>
									</div>
									<div class="product-desc text-justify">
										<p>' . $prodDes . '<br/><a href="product.php?id='.$eachCategory['id'].'">Learn More</a></p>
									</div>
									<div class="price-box">
										<span class="product-price">' . $GLOBALS['CURRENCY'] . " " . $eachCategory['product_price'] . '</span>
									</div>
									<div class="product-action">
										<form method="post" action="">
											<button class="paction add-wishlist custom-desgne" title="Add to Wishlist"><span>Add to Wishlist</span></button>
											<button name="add_to_cart" class="paction add-cart custom-desgn" type="submit" title="Add to Cart">
											<input type="hidden" name="cart_product_id" value=" '. $eachCategory['id'] .'">
											<input type="hidden" name="cart_product_quantity" value="1">
											<span>Add to Cart</span>
											</button>
											<button href="#" class="paction add-compare custom-desgne" title="Add to Compare"><span>Add to Compare</span></button>
										</form>
									</div>
								</div>
							</div>
							';
						}
					}
				?>
				
				<nav class="toolbox toolbox-pagination">
					<div class="toolbox-item toolbox-show">

					<?php
						if(!empty($categoryDetails))
						{
							echo '<label>Showing '. ($cp + 1) . '–' . $text . ' of ' . $nod.' results</label>'; 
						}
						else
						{
							echo '<label>Showing 0-0 of 0 results</label>'; 
						}
					?>

					</div>

					<?php
						if(!empty($categoryDetails))
						{
					?>

					<ul class="pagination">
						<li class="page-item">
							<a class="page-link page-link-btn" href="category-list.php?page=<?= $previous ?>">
								<span class="page-link"><i class="icon-angle-left"></i> Previous &nbsp;</span>
							</a>
						</li>
						
						<?php 
							#== PAGINATION NUMBER
							echo $pageNumber;
						?>
						
						<li class="page-item">
							<a class="page-link page-link-btn" href="category-list.php?page=<?= $next ?>">
								<span class="page-link">&nbsp; Next <i class="icon-angle-right"></i></span>
							</a>
						</li>
					</ul>

					<?php
							}
					?>
					
				</nav>
			</div>
			<aside class="sidebar-shop col-lg-3 order-lg-first">
				<div class="sidebar-wrapper">
					<div class="widget">
						<h3 class="widget-title">
							<a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">
								
								<?php
									#== SUBCATEGORY CATEGORY NAME
									echo $categoryResult[0]['category_name'];
								?>
								
							</a>
						</h3>
						<div class="collapse show" id="widget-body-2">
							<div class="widget-body">
								<ul class="cat-list">
									
									<?php
										#== RELEVANT SUBCATEGORY LIST BASED ON CATEGORY
										$columnName= $tableName= $whereValue= null;
										$columnName = "*";
										$tableName = "subcategories";
										$whereValue['category_id'] =  $categoryResult[0]['id']; 
										$subcategoryList = $eloquent->selectData($columnName, $tableName, @$whereValue); 
										
										foreach($subcategoryList AS $eachsubcategory)
										{
											echo'<li><a href="category-list.php?id='.$eachsubcategory['id'].'">'.$eachsubcategory['subcategory_name'].'</a></li>';
										}
									?>
									
								</ul>
							</div>
						</div>
					</div>
					<div class="widget">
						<h3 class="widget-title">
							<a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">Price</a>
						</h3>
						<div class="collapse show" id="widget-body-3">
							<div class="widget-body">
								<form action="#" method="">
									<div class="price-slider-wrapper">
										<div id="price-slider"></div>
									</div>
									<div class="filter-price-action">
										<button type="submit" class="btn btn-primary">Filter</button>
										<div class="filter-price-text"> Price: <span id="filter-price-range"></span> </div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="widget">
						<h3 class="widget-title">
							<a data-toggle="collapse" href="#widget-body-6" role="button" aria-expanded="true" aria-controls="widget-body-6">Color</a>
						</h3>
						<div class="collapse show" id="widget-body-6">
							<div class="widget-body">
								<ul class="config-swatch-list d-flex">
									<li class="" style="">
										<a href="#"><span class="color-panel" style="background-color: #1645f3;"></span></a>
										<a href="#"><span class="color-panel" style="background-color: #f11010;"></span></a>
										<a href="#"><span class="color-panel" style="background-color: #fe8504;"></span></a>
										<a href="#"><span class="color-panel" style="background-color: #2da819;"></span></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</aside>
		</div>
	</div>
	<div class="mb-5">
		<!--=*= CREATE A EMPTY SPACE BETWEEN CONTENT =*=-->
	</div>
</main>
<!--=*= CATEGORY LIST SECTION END =*=-->								