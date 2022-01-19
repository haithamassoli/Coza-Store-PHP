<?php
session_start();
$total = 0;
$quantity = 0;
$totalback = 0;
include "./admin/includes/connect.php";

if (isset($_GET['delete'])) {
	$del = $_GET['delete'];
	if (isset($_SESSION['cart'])) {
		foreach ($_SESSION['cart'] as $key => $value) {
			if ($key == $del) {
				unset($_SESSION['cart'][$key]);
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo isset($title) ? $title : "CozaStore"; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" href="./css/order.css">
	<link rel="stylesheet" href="./css/styling.css">
	<!--===============================================================================================-->
</head>

<body class="animsition">
	<!-- Header -->
	<header class="header-v2">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">

					<!-- Logo desktop -->
					<a href="index.php" class="logo">
						<img src="images/icons/logo-01.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="index.php">Home</a>
							</li>

							<li>
								<a href="shop.php?page=1">Shop</a>
							</li>
							<li>
								<a href="about.php">About</a>
							</li>

							<li>
								<a href="contact.php">Contact</a>
							</li>
						</ul>
					</div>

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<?php if (!isset($_SESSION['type'])) { ?>
							<li class="cl2 hov-cl1 trans-04 p-l-22 p-r-11">
								<a href="sign_in.php" class="cl1">Login</a>
							</li>
							<li class="cl2 hov-cl1 trans-04 p-l-22 p-r-11">
								<a href="sign_up.php" class="cl1">Sign Up</a>
							</li>
						<?php } elseif ($_SESSION['type'] == 0) { ?>
							<li class="cl2 hov-cl1 trans-04 p-l-22 p-r-11">
								<a href="profile.php" class="cl1">Profile</a>
							</li>
							<li class="cl2 hov-cl1 trans-04 p-l-22 p-r-11">
								<a href="logout.php" class="cl1">Logout</a>
							</li>
						<?php } elseif ($_SESSION['type'] == 1 || $_SESSION['type'] == 2) { ?>
							<li class="cl2 hov-cl1 trans-04 p-l-22 p-r-11">
								<a href="admin/index.php" class="cl1">DashBoard</a>
							</li>
							<li class="cl2 hov-cl1 trans-04 p-l-22 p-r-11">
								<a href="logout.php" class="cl1">Logout</a>
							</li>
						<?php } ?>
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?php if (isset($_SESSION['cart'])) {
																																																													foreach ($_SESSION['cart'] as $key => $value) {
																																																														$quantity += $value['quantity'];
																																																													}
																																																													echo $quantity;
																																																												} else {
																																																													echo 0;
																																																												}; ?>">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>

					</div>
				</nav>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->
			<div class="logo-mobile">
				<a href="index.php"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?php if (isset($_SESSION['cart'])) {
																																																											foreach ($_SESSION['cart'] as $key => $value) {
																																																												$quantity += $value['quantity'];
																																																											}
																																																											echo $quantity;
																																																										} else {
																																																											echo 0;
																																																										}; ?>">
					<i class="zmdi zmdi-shopping-cart"></i>

				</div>

			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="main-menu-m">
				<li>
					<a href="index.php">Home</a>
				</li>

				<li>
					<a href="shop.php?page=1">Shop</a>
				</li>

				<li>
					<a href="about.php">About</a>
				</li>

				<li>
					<a href="contact.php">Contact</a>
				</li>
				<?php if (!isset($_SESSION['type'])) { ?>
					<li>
						<a href="sign_in.php">Login</a>
					</li>
					<li>
						<a href="sign_up.php">Sign Up</a>
					</li>
				<?php } elseif ($_SESSION['type'] == 0) { ?>
					<li>
						<a href="profile.php">Profile</a>
					</li>
					<li>
						<a href="logout.php">Logout</a>
					</li>
				<?php } elseif ($_SESSION['type'] == 1 || $_SESSION['type'] == 2) { ?>
					<li>
						<a href="admin/index.php">DashBoard</a>
					</li>
					<li>
						<a href="logout.php">Logout</a>
					</li>
				<?php } ?>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15" method="GET" action="shop.php">
					<button class="flex-c-m trans-04" type="submit">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="search" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>

	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>

			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
						foreach ($_SESSION['cart'] as $key => $value) { ?>
							<li class="header-cart-item flex-w flex-t m-b-12">
								<a href="?delete=<?php echo $value['product_id'] . $value['size'] ?>">
									<div class="header-cart-item-img">
										<img src="<?php echo 'admin/' . $value['product_image']; ?>" alt="IMG">
									</div>
								</a>

								<div class="header-cart-item-txt p-t-8">
									<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
										<?php echo $value['product_name'] . " " . $value['size']; ?>
									</a>

									<span class="header-cart-item-info">
										<?php echo $value['quantity'] . " x $" . $value['product_price'];
										$total += (int)$value['product_price'] * (int)$value['quantity']; ?>
									</span>
								</div>
							</li>
					<?php }
					} else {
						echo '<div style="" class="header-cart-item-txt h4 text-center p-t-8">No items in cart</div>';
					} ?>
				</ul>

				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: $<?php echo $total; ?>
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="shoping-cart.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>

						<a href="checkout.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>