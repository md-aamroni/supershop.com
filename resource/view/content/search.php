<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/SearchController.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$searchCtrl = new SearchController;
$eloquent = new Eloquent;


## ===*=== [F]ETCH PRODUCT LIST BASED ON PRODUCT TAGS ===*=== ##
if(isset($_POST['keywords']))
$_SESSION['search_keywords'] = strip_tags($_POST['keywords']);


## ===*=== [M]ATCH THE KEYWORD AGAINST TAGS ===*=== ##
$searchedProductList = $searchCtrl->searchProduct($_SESSION['search_keywords']);

#== (nod = Number of Data) COUNT HOW MANY DATA IS AVAILABLE IN THIS SUBCATEGORY
if(!empty($searchedProductList))
{	
	$_SESSION['SEARCH_CATEGORY_ID'] = $searchedProductList[0]['category_id'];
	@$nod = count($searchedProductList);
}

#== (rpp = Result Per Page) DEFINED HOW MANY RESULT PER PAGE WILL BE DISPLAYED
$rpp = 8;
#== (nop = Number of Page) DEFINE HOW MANY PAGE WILL BE APPEAR FOR PAGINATION
$nop = ceil(@$nod/$rpp);

#== IF THE PAGE IS NOT SET THEN ITS RENDERING FROM PAGE NO 1
if(!isset($_GET['page'])) {
	$page = 1;
	} else {
	$page = $_GET['page'];
}

#== (cp = Current Page) DEFINE THE DATA DISPLAYED LIMIT
$cp = ($page -1)*$rpp;	
$searchedProductList = $searchCtrl->searchProductLimit($_SESSION['search_keywords'], $cp, $rpp);

if(!empty($searchedProductList))
{
	$value = count(array_keys($searchedProductList));
}

#== TEXT WILL BE RETURN THE CUMULATIVE VALUE OF DATA
$text = 0;
if($text > @$nod) {
	$text = @$nod;
	} else if($text < @$nod) {
	$text = $value * $page;
}

#== BUTTON OPTION FOR NEXT OR PREVIOUS
$previous = $page - 1;
$next = $page + 1;

#== EMPTY VARIABLE WHICH RETURNS THE NUMBER OF PAGES
$pageNumber = '';														
for($i = 1; $i <= $nop; $i++)
{
	$pageNumber .= '	<li class="page-item"> <a class="page-link active" href="search.php?page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a></li>';
}
## ===*=== [F]ETCH PRODUCT LIST BASED ON PRODUCT TAGS ===*=== ##
?>

<!--=*= SEARCH SECTION START =*=-->
<main class="main">
	<div class="banner banner-cat" style="background-image: url('public/assets/images/newsletter_popup_bg.jpg');">
		<div class="banner-content container">
			<h2 class="banner-subtitle text-dark"><span>check out our latest collection <?= date("Y"); ?></span></h2>
			<h1 class="banner-title text-dark">
				SEARCH YOUR PRODUCTS HERE
			</h1>
		</div>
	</div>
	<nav aria-label="breadcrumb" class="breadcrumb-nav">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="search.php">Search</a></li>
			</ol>
		</div>
	</nav>
	<div class="container">
		<div class="alert alert-success">
			Showing search result against: <strong><?php echo @$_SESSION['search_keywords']; ?></strong>
		</div>
		<nav class="toolbox horizontal-filter">
			<div class="toolbox-left">
				<div class="filter-toggle">
					<span>Filters:</span>
					<a href=#>&nbsp;</a>
				</div>
			</div>
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
			<div class="toolbox-item">
				<div class="toolbox-item toolbox-show">
					
					<?php
						#== SEARCH PRODUCT COUNT
						if($searchedProductList > 0)
						{							
							echo '<label>Showing '. ($cp + 1) .'–'. $text .' of '. $nod .' results</label>';
						} 
						else 
						{
							echo '<label>Showing 0–0 of 0 results</label>';
						}
					?>
					
				</div>
				<div class="layout-modes">
					<a href="category.php" class="layout-btn btn-grid active" title="Grid">
						<i class="icon-mode-grid"></i>
					</a>
					<a href="category-list.php" class="layout-btn btn-list" title="List">
						<i class="icon-mode-list"></i>
					</a>
				</div>
			</div>
			<div class="toolbox-item">
			</nav>
			<div class="row products-body">
				<div class="col-lg-9 main-content">
					
					<?php 
						#== WHEN SEARCH PRODUCT IS UNAVAILABLE
						if(empty($searchedProductList))
						{
							echo '<div class="d-flex justify-content-center">
										<img src="public/assets/images/sorry.png" style="width: auto; height:400px;"/>
									</div>';
						}
					?>
					
					<div class="row row-sm category-grid">
						
						<?php
							#== SEARCH PRODUCT DATA
							if(!empty($searchedProductList))
							{
								foreach($searchedProductList AS $eachProduct)
								{	
									#== IF SOMEHOW PRODUCT IMAGE IS UNAVAILABLE
									if(empty($eachProduct['product_master_image'])) {
										$productImage = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";
										} else {
										$productImage = $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_master_image'];
									}
									echo '
									<div class="col-6 col-md-4 col-xl-3">
										<div class="grid-product">
											<figure class="product-image-container">
												<a href="product.php?id='.$eachProduct['id'].'" class="categoryflexgrid-image">
													<img src="'. $productImage .'" alt="product">
												</a>
												<a href="ajax/product-quick-view.html" class="btn-quickview">Quick View</a>
											</figure>
											<div class="product-details">
												<div class="ratings-container">
													<div class="product-ratings">
														<span class="ratings" style="width:80%"></span>
													</div>
												</div>
												<h2 class="product-title">
													<a href="product.php?id='.$eachProduct['id'].'">'. $eachProduct['product_name'] .'</a>
												</h2>
												<div class="price-box">
													<span class="product-price">'. $eachProduct['product_price'] .'</span>
												</div>
												<div class="product-grid-action">
													<form method="post" action="">
														<button class="paction add-wishlist custom-desgne" title="Add to Wishlist">
															<span>Add to Wishlist</span>
														</button>
														<button name="add_to_cart" class="paction add-cart custom-desgn" type="submit" title="Add to Cart">
															<input type="hidden" name="cart_product_id" value=" '. $eachProduct['id'] .'">
															<input type="hidden" name="cart_product_quantity" value="1">
															<span>Add to Cart</span>
														</button>
														<button href="#" class="paction add-compare custom-desgne" title="Add to Compare">
															<span>Add to Compare</span>
														</button>
													</form>
												</div>
											</div>
										</div>
									</div>
									';
								}
							}
						?>
						
					</div>
					<nav class="toolbox toolbox-pagination">
						<div class="toolbox-item toolbox-show">
							
							<?php
								#== SEARCH PRODUCT COUNT
								if($searchedProductList > 0)
								{							
									echo '<label>Showing '. ($cp + 1) .'–'. $text .' of '. $nod .' results</label>';
								} 
								else 
								{
									echo '<label>Showing 0–0 of 0 results</label>';
								}
							?>
							
						</div>
						<ul class="pagination">
							<li class="page-item">
								<a class="page-link page-link-btn" href="search.php?page=<?= $previous ?>">
									<span class="page-link"><i class="icon-angle-left"></i> Previous &nbsp;</span>
								</a>
							</li>
							
							<?php 
								#== PAGINATION NUMBER
								echo $pageNumber;
							?>
							
							<li class="page-item">
								<a class="page-link page-link-btn" href="search.php?page=<?= $next ?>">
									<span class="page-link">&nbsp; Next <i class="icon-angle-right"></i></span>
								</a>
							</li>
						</ul>
					</nav>
				</div>
				<div class="sidebar-overlay"></div>
				<aside class="sidebar-shop col-lg-3 order-lg-first">
					<div class="sidebar-wrapper">
						<div class="widget">
							<h3 class="widget-title">
								<a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">
									
									<?php
										#== CATEGORY NAME
										if($searchedProductList > 0)
										{	
											$columnName= $tableName= $whereValue= null;
											$columnName = "*";
											$tableName = "categories";
											$whereValue['id'] = $_SESSION['SEARCH_CATEGORY_ID']; 
											$categoryList = $eloquent->selectData($columnName, $tableName, @$whereValue);
											
											echo $categoryList[0]['category_name'];
										}
									?>
									
								</a>
							</h3>
							<div class="collapse show" id="widget-body-2">
								<div class="widget-body">
									<ul class="cat-list">
										
										<?php
											#== RELEVANT SUBCATEGORY LIST BASED ON CATEGORY
											if($searchedProductList > 0)
											{
												$columnName= $tableName= $whereValue= null;
												$columnName = "*";
												$tableName = "subcategories";
												$whereValue['category_id'] = $_SESSION['SEARCH_CATEGORY_ID']; 
												$subcategoryList = $eloquent->selectData($columnName, $tableName, @$whereValue); 
												
												foreach($subcategoryList AS $eachsubcategory)
												{
													echo'<li><a href="category.php?id='.$eachsubcategory['id'].'">'.$eachsubcategory['subcategory_name'].'</a></li>';
												}
											}
										?>
										
									</ul>								
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
	</div>
	<div class="mb-5">
		<!-- CREATE A EMPTY SPACE BETWEEN CONTENT -->
	</div>
</main>
<!--=*= SEARCH SECTION START =*=-->	