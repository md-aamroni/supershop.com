<?php
class HomeController extends Controller
{
	public function productLister($productList)
	{
		foreach($productList AS $eachProduct)
		{
			if(empty($eachProduct['product_master_image']))
				$productImage = "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";
			else
				$productImage = $GLOBALS['PRODUCT_DIRECTORY'] . $eachProduct['product_master_image'];
									
			echo '
            <div class="col-6 col-md-3">
                <div class="product">
                    <figure class="product-image-container">
                        <a href="product.php?id='.$eachProduct['id'].'" class="home-image">
                            <img src="'. $productImage .'" alt="product" style="width: 277px; height: 277px;">
                        </a>
                        <a href="product.php?id='. $eachProduct['id'] .' " class="btn-quickview">Quick View</a>
                    </figure>
                    <div class="product-details">
						  <!--<div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:80%"></span>
                            </div>
                        </div>-->
                        <h2 class="product-title">
                            <a href="product.php?id='.$eachProduct['id'].'">'. $eachProduct['product_name'] .'</a>
                        </h2>
                        <div class="price-box">
                            <span class="product-price">'. $GLOBALS['CURRENCY'] . " " . $eachProduct['product_price'] .'</span>
                        </div>
						<div class="product-action">
							<form method="post" action="">
								<button class="paction add-wishlist" title="Add to Wishlist"><span>Add to Wishlist</span></button>
								<input type="hidden" name="cart_product_id" value="'. $eachProduct['id'] .'"/>
								<input type="hidden" name="cart_product_quantity" value="1"/>
								<button name="add_to_cart" class="paction add-cart" type="submit" title="Add to Cart" style="margin-left: 7px; padding-top: 6px;">
									<span>Add to Cart</span>
								</button>
								<button class="paction add-compare" title="Add to Compare"><span>Add to Compare</span></button>
							</form>
						</div>
                    </div>
                </div>
            </div>';
		}
	}
}
?>