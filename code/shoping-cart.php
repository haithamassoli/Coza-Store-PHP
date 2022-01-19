<?php
ob_start(); // Output Buffering Start
$title = "Cart";
include "./includes/header.php";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	@$coupon = $_POST["coupon"];
	if (isset($_SESSION['cart'])) {
		if (isset($_POST['update'])) {

			foreach ($_SESSION['cart'] as $keys => $value) {
				foreach ($_POST as $key => $value) {
					if ($keys == $key) {
						$_SESSION['cart'][$keys]['quantity'] = $_POST[$key];
						header("location:shoping-cart.php");
					}
				}
			}
		}
		if (isset($_POST['remove'])) {
			unset($_SESSION['cart']);
			unset($_SESSION['total']);
			header("location:shoping-cart.php");
		}
	}
}
?>

<!-- breadcrumb -->
<div class="container">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
			Home
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<span class="stext-109 cl4">
			Shoping Cart
		</span>
	</div>
</div>

<!-- Shoping Cart -->
<form class="bg0 p-t-75 p-b-85" method="POST">
	<div class="container">

		<div class="row">
			<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
				<div class="m-l-25 m-r--38 m-lr-0-xl">
					<div class="wrap-table-shopping-cart">
						<table class="table-shopping-cart">
							<tr class="table_head">
								<th class="column-1">Product</th>
								<th class="column-2"></th>
								<th class="column-3">Price</th>
								<th class="column-4">Quantity</th>
								<th class="column-5">Total</th>
							</tr>
							<?php
							if (isset($_SESSION["cart"]) && count($_SESSION["cart"]) >= 1) {
								foreach ($_SESSION['cart'] as $key => $value) { ?>
									<tr class="table_row">
										<td class="column-1">
											<a href="shoping-cart.php?delete=<?php echo $value['product_id'] . $value['size'] ?>">
												<div class="how-itemcart1">
													<img src="<?php echo 'admin/' . $value['product_image']; ?>" loading="lazy" alt="IMG">
												</div>
											</a>
										</td>
										<td class="column-2"><?php echo $value['product_name'] .  " " . $value['size']; ?></td>
										<td class="column-3">$ <?php echo $value['product_price']; ?></td>
										<td class="column-4">
											<div class="wrap-num-product flex-w m-l-auto m-r-0">
												<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
													<i class="fs-16 zmdi zmdi-minus"></i>
												</div>
												<input class="mtext-104 cl3 txt-center num-product" type="number" min=1 max=100 name="<?php echo $value['product_id'] . $value['size']; ?>" value="<?php echo $value['quantity']; ?>">

												<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
													<i class="fs-16 zmdi zmdi-plus"></i>
												</div>
											</div>
										</td>
										<td class="column-5"> $ <?php $total += $value['product_price'] * $value['quantity'];
																						$totalback += $value['product_price'] * $value['quantity'];
																						echo $value['product_price'] * $value['quantity']; ?><a href="shoping-cart.php?delete=<?php echo $value['product_id'] . $value['size'] ?>"><button class="ml-4" type="button" name="<?php echo "removeItem" . $value['product_id'] . $value['size'] ?>"><i style="display: block;" class="far fa-trash-alt fa-lg"></i></button></a>
										</td>
									</tr>
							<?php }
							} else {
								echo	'<div class="text-center h2 mb-5">No item in cart</div>';
							}
							?>

						</table>
					</div>
					<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
						<div class="flex-w flex-m m-r-20 m-tb-5">
							<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
							<div style="color: red;font-weight:bold"><?php if (isset($_POST['coupon_set'])) echo @$couponError ?></div>
							<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" type:'submit'>
								<button name="coupon_set" type="submit">
									Apply Coupon
								</button>
							</div>
						</div>
						<?php if (isset($_POST["coupon_set"])) {
							$sql = "SELECT * FROM coupons WHERE coupon_text ='$coupon' ORDER BY coupon_percent DESC";
							$result = mysqli_query($conn, $sql);
							if ($result->num_rows > 0) {
								$coupons = mysqli_fetch_all($result, MYSQLI_ASSOC);
								$couponsDis = $coupons[0]['coupon_percent'];
								if ($coupons[0]['coupon_status'] == 'enable') {
									$couponError = "";
									// $total -= $total * ($_SESSION['couponsDis'] / 100);
									$_SESSION['couponsDis'] = $couponsDis;
								} else {
									$couponError = " Sorry this coupon is Disaples";
								}
							} else {
								$couponError = "this coupon isnt valid";
								// $_SESSION['total'] = $totalback;
							}
						} ?>
						<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
							<button name="update" type="submit">
								Update Cart
							</button>
						</div>
						<?php echo isset($couponError) ? "<span class='text-danger>'" . $couponError . "</span>" : ""; ?>
						<style>
							.deleteCart {
								border-radius: 50%;
							}
						</style>
						<div class="flex-c-m stext-101 cl2 p-2 trans-04 pointer m-tb-10 deleteCart">
							<button name="remove" type="submit">
								<div style="display: flex; align-items:center;">
									<i style="display: block;" class="far fa-trash-alt fa-lg"></i><span class="ml-3">Delete All</span>
								</div>
							</button>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-10 col-lg-10 col-xl-5 m-lr-auto m-b-50">
				<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
					<h4 class="mtext-109 cl2 p-b-30">
						Cart Totals
					</h4>
					<div class="flex-w flex-t p-t-27 p-b-33">
						<div class="size-208">
							<span class="mtext-101 cl2">
								<?php if (isset($_SESSION['couponsDis']) && isset($_SESSION['cart'])) { ?>
									<div style="color:red; width:120%; margin-bottom: 30px !important;">Coupon: <?php echo $_SESSION['couponsDis'] . '%'; ?></div>
									<div style=" margin-bottom: 10px !important; width:125%;">Total: <?php echo '<del style="color:#999;">' . '   ' . ' $' . $totalback . '</del>' . " $" . $totalback - $totalback * ($_SESSION['couponsDis'] / 100) . '</div>';
																																									} ?>
									<!-- echo   "$"  . $totalback . "  "; -->
							</span>
						</div>
					</div>
					<button type="submit" name="checkout" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
						Proceed to Checkout
					</button>
					<?php
					if (isset($_POST['checkout']) && $total == 0 && count($_SESSION['cart']) == 0) {
						echo	'<div style="width:100%;" class="text-center text-danger h5 mt-2">you must add to cart!</div>';
					} elseif (isset($_POST['checkout']) && $total != 0) {
						header("location:checkout.php");
					}
					?>
				</div>
			</div>
		</div>
	</div>
</form>
<?php include "./includes/footer.php"; ?>
<?php ob_end_flush(); // Release The Output
?>