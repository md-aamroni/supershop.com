<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;


## ===*=== [U]PDATE CART PRODUCT DATA ===*=== ##
if(isset($_POST['update_cart']))
{
	$columnValue = $tableName = $whereValue = null;
	$tableName = "shopcarts";
	$columnValue["quantity"] = $_POST['quantity'];
	$whereValue["id"] = $_POST['cart_id'];
	$updateCartItem = $eloquent->updateData($tableName, $columnValue, @$whereValue);
}
## ===*=== [U]PDATE CART PRODUCT DATA ===*=== ##


## ===*=== [R]EMOVE CART PRODUCT DATA===*=== ##
if(isset($_POST['remove_cart']))
{
	$tableName = $whereValue = null;
	$tableName = "shopcarts";
	$whereValue["id"] = $_POST['remove_id'];
	$deleteCart = $eloquent->deleteData($tableName, @$whereValue);
}
## ===*=== [R]EMOVE CART PRODUCT DATA===*=== ##


## ===*=== [A]PPLY DISCOUNT AMOUNT DATA ===*=== ##
if(isset($_POST['discount_amnt']))
{
	#== FETCH DISCOUNT DATA IF AVAILABLE
	$columnValue = $tableName = null;
	$columnName = "*";
	$tableName = "discounts";
	$discountResult = $eloquent->selectData($columnName, $tableName);
	
	#== CHECK VALIDATION => AGAINST SUBMITTED VALUE
	if(!empty($_POST['dscnt_cd']))
	{
		$getDiscount;
		
		if($_POST['dscnt_cd'] === @$discountResult[0]['discount_code']) {
			$getDiscount = @$discountResult[0]['price_discount_amount'];
			} else {
			$getDiscount = 0;
		}
		@$_SESSION['SSCF_DISCOUNT_AMOUNT'] = $getDiscount;
	}
}
## ===*=== [A]PPLY DISCOUNT AMOUNT DATA ===*=== ##


## ===*=== [F]ETCH CART PRODUCTS DATA FOR USER'S VISUALIZATION ===*=== ##
$columnName = $tableName = $joinType = $onCondition = $whereValue = $formatBy = $paginate = null;
$columnName["1"] = "shopcarts.quantity";
$columnName["2"] = "shopcarts.id";
$columnName["3"] = "products.product_name";
$columnName["4"] = "products.product_price";
$columnName["5"] = "products.product_master_image";
$tableName["MAIN"] = "shopcarts";
$joinType = "INNER";
$tableName["1"] = "products";
$onCondition["1"] = ["shopcarts.product_id", "products.id"];
$whereValue["shopcarts.customer_id"] = @$_SESSION['SSCF_login_id'];
$formatBy["DESC"] = "shopcarts.id";
$myShopcartItems = $eloquent->selectJoinData($columnName, $tableName, $joinType, $onCondition, @$whereValue, @$formatBy, @$paginate);
## ===*=== [F]ETCH CART PRODUCTS DATA FOR USER'S VISUALIZATION ===*=== ##


## ===*=== [I]NSERT DELIVERY CHARGE DATA ===*=== ##
if(isset($_POST['fob']))
{
	if(@$_SESSION['SSCF_login_id'] > 0)
	{
		#== FETCH DELIVERY CHARGE DATA
		$columnName = $tableName = $whereValue = null;
		$columnName = "*";
		$tableName = "deliveries";
		$whereValue["customer_id"] = $_SESSION['SSCF_login_id'];
		$availibilityCharge = $eloquent->selectData($columnName, $tableName, @$whereValue);
		
		#== IF NOT EMPTY THEN UPDATE DELIVERY CHARGE DATA 
		if(!empty($availibilityCharge))
		{
			$columnValue = $tableName = $whereValue = null;
			$tableName = "deliveries";
			$columnValue["created_at"] = date("Y-m-d H:i:s");
			$columnValue["shipping_charge"] = $_POST['shipping_method'];
			$whereValue["customer_id"] = $_SESSION['SSCF_login_id'];
			$updateCharge = $eloquent->updateData($tableName, $columnValue, @$whereValue);
		}
		
		#== IF EMPTY THEN INSERT DELIVERY CHARGE DATA 
		else
		{
			$columnValue = $tableName = null;
			$tableName = "deliveries";
			$columnValue["created_at"] = date("Y-m-d H:i:s");
			$columnValue["customer_id"] = $_SESSION['SSCF_login_id'];
			$columnValue["shipping_charge"] = $_POST['shipping_method'];
			$insertCharge = $eloquent->insertData($tableName, $columnValue, @$whereValue);
		}
	}
}
## ===*=== [I]NSERT DELIVERY CHARGE DATA ===*=== ##


## ===*=== [F]ETCH DELIVERY CHARGE DATA ===*=== ##
$columnName = $tableName = $whereValue = null;
$columnName = "*";
$tableName = "deliveries";
$deliveryCharge = $eloquent->selectData($columnName, $tableName, @$whereValue);

#== ASSIGN A VARIABLE WHICH HOLD THE UPDATE VALUE
@$fobCost = $deliveryCharge[0]['shipping_charge'];
## ===*=== [F]ETCH DELIVERY CHARGE DATA ===*=== ##
?>

<!--=*= CART SECTION START =*=-->
<main class="main">
	<nav aria-label="breadcrumb" class="breadcrumb-nav mb-1">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
			</ol>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				
				<?php 
					#== DELETE CONFIRMATION MESSAGE
					if(isset($_POST['remove_cart']))
					{
						if($deleteCart > 0)
						{
							echo '<div class="alert alert-success">The Cart Item is deleted successfully</div>';
						} 
						else 
						{
							echo '<div class="alert alert-danger">Something went wrong! Unable to delete. Please recheck.</div>';
						}
					}
					
					#== DISCOUNT CONFIRMATION MESSAGE
					if(isset($_POST['discount_amnt']))
					{
						if(@$getDiscount > 0) {
							echo '
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Congratulation!</strong> You have get BDT '. @$_SESSION['SSCF_DISCOUNT_AMOUNT'] .' tk discount.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>';
						} 
						else 
						{
							echo '
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Be Careful</strong> and don\'t try to become a fruad...!
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>';
						}
					}
				?>
				
				<div class="cart-table-container">
					<table class="table table-cart">
						<thead>
							<tr>
								<th class="product-col">Product</th>
								<th class="price-col">Price</th>
								<th class="qty-col">Qty</th>
								<th class="price-col">Subttl</th>
								<th >Action</th>
							</tr>
						</thead>
						<tbody>
							
							<?php
								#== DYNAMIC CART PRODUCT LIST
								foreach($myShopcartItems AS $eachCartItems)
								{
									echo '
									<form method="post" action="">
										<tr class="product-row">
											<td class="product-col">
												<figure class="product-image-container">
													<a href="product.php?id='. $eachCartItems['id'].'" class="shopcart-image">
														<img src="' . $GLOBALS['PRODUCT_DIRECTORY'] . $eachCartItems['product_master_image']. '" alt="product">
													</a>
												</figure>
												<h2 class="product-title">
													<a href="product.php?id='. $eachCartItems['id'].'">'.$eachCartItems['product_name'].'</a>
												</h2>
											</td>
											<td>' . $GLOBALS['CURRENCY'] . " " . $eachCartItems['product_price']. '</td>
											<td style="max-width: 60px;">
												<input name="quantity" class="form-control" type="number" min="1" value="'.@$eachCartItems['quantity'].'">
											</td>
											<td>' . $GLOBALS['CURRENCY'] . " " . ($eachCartItems['product_price'] * $eachCartItems['quantity']) . '</td>
											<td class="bb">
												<div class="d-flex checkout-steps-action">
													<input type="hidden" name="cart_id" value=" ' . $eachCartItems['id'] . ' " />
													<button name="update_cart" type="submit" class="btn btn-sm btn-outline-info">Update</button> &nbsp;
													<input type="hidden" name="remove_id" value=" ' . $eachCartItems['id'] . ' " />
													<button name="remove_cart" type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
												</div>
											</td>
										</tr>
									</form>
									';
								}
							?>
							
						</tbody>
						<tfoot>
							<tr>
								<td colspan="8" class="clearfix">
									<div class="float-left">
										<a href="index.php" class="btn btn-outline-success">Continue Shopping</a>
									</div>
								</td>
							</tr>                    
						</tfoot>
					</table>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="cart-summary">
					<h3>Summary</h3>
					<table class="table table-totals">
						<tbody>
							<tr>
								<td>Subtotal</td>
								<td>
									
									<?php 
										#== SUBTOTAL PRICE SUMMATION
										$cartSubtotal = 0;
										foreach ($myShopcartItems AS $eachSubtotal)
										{
											$cartSubtotal += ($eachSubtotal['quantity'] * $eachSubtotal['product_price']);
										}
										echo $GLOBALS['CURRENCY'] . " " . $cartSubtotal;
									?>
									
								</td>
							</tr>
							<tr>
								<td>Tax</td>
								<td><?= $GLOBALS['CURRENCY'] . " " . $tax = ($cartSubtotal * $GLOBALS['TAX']) / 100; ?></td>
							</tr>
							<tr>
								<td>Delivery Charge</td>
								<td>
									<?= $GLOBALS['CURRENCY'] . " "; ?>
									<span id="charge">
										
										<?php 
											if(@$fobCost <= 0)
											{
												echo 0;
											}
											else 
											{
												echo @$fobCost; 
											}
										?>
										
									</span>
								</td>
							</tr>								
							<tr>
								<td>Discount Amout</td>
								<td> <?= $GLOBALS['CURRENCY'] . " "; ?> <?= @$_SESSION['SSCF_DISCOUNT_AMOUNT'];?> </td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td>Order Total</td>
								<td>
									<?= $GLOBALS['CURRENCY'] . " " . $grandTotal = round((($cartSubtotal + $tax) - @$_SESSION['SSCF_DISCOUNT_AMOUNT']) + $fobCost); ?>
								</td>
							</tr>
						</tfoot>
					</table>
					<span id="message" style="display: none;">
						<div class="alert alert-warning fade show" role="alert">
							Confirm <strong> Delivery Charge </strong> Prior to Order
						</div>
					</span>
					<div class="checkout-methods">
						
						<?php
							if(!empty(@$fobCost))
							{
						?>
							
						<form action="order.php" method="post">
								
						<?php 
							}
						?>
							<input type="hidden" name="cartsub_total" value="<?php echo $cartSubtotal; ?>">
							<input type="hidden" name="tax_total" value="<?php echo $tax; ?>">
							<input type="hidden" name="discount_amount" value="<?php echo @$_SESSION['SSCF_DISCOUNT_AMOUNT']; ?>">
							<input type="hidden" name="delivery_charge" value="<?php echo @$fobCost; ?>">
							<input type="hidden" name="grand_total" value="<?php echo $grandTotal; ?>">
							<button name="submit_order" id="fEvent" class="btn btn-block btn-sm btn-primary">Proceed to Order</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<div class="cart-discount">
					<h4>Apply Discount Code</h4>
					<form action="" method="post">
						<div class="input-group">
							<input name="dscnt_cd" type="text" class="form-control form-control-sm" placeholder="Enter discount code" required>
							<div class="input-group-append">
								<button name="discount_amnt" class="btn btn-sm btn-primary" type="submit">Apply Discount</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="cart-discount">
					<h4>Shipping Methods</h4>
					<form action="" method="post">
						<div class="input-group">
							<select class="form-control" name="shipping_method">
								<option> select shipping method </option>
								<option value="50"> BDT 50 Tk Inside of Dhaka </option>
								<option value="120"> BDT 120 Tk Outside of Dhaka</option>
							</select>
							<div class="input-group-append">
								<button name="fob" class="btn btn-sm btn-info" type="submit">Confirm Shipping</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="mb-6">
		<!-- CREATE A EMPTY SPACE BETWEEN CONTENT -->
	</div>
</main>
<!--=*= CART SECTION START =*=-->

<!--=*= ORDER PLACED FORM CART =*=-->
<script type="text/javascript">
	$(document).ready(function(){
		var data = $('#charge').html();
		$('#fEvent').click(function(){
			if(data == 0){
				$('#message').show();
			}
		});
	});
</script>
<!--=*= ORDER PLACED FORM END =*=-->