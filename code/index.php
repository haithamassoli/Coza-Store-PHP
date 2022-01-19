<?php
$title = "CozaStore";
include("admin/includes/connect.php");
/*adding new visitor */
if (isset($_GET["checked"])) {
?>
	<script>
		setTimeout(() => {
			swal("Thank you!", "your order is sent", "success");
		}, 100);
	</script>
<?php } ?>
<?php
$visitor_ip = $_SERVER["REMOTE_ADDR"];
/* CHECK IF VISITOR IS UNIQUE*/
$sql = "SELECT * FROM `unique_visitors`";
$result = mysqli_query($conn, $sql);
$visitors = mysqli_fetch_all($result);
$visitor_check = 1;
if (!($result->num_rows < 1)) {
	foreach ($visitors as $array) {
		if ($array["visitor_ip"] = $visitor_ip) {
			$visitor_check = 0;
		}
	}
} else if ($result->num_rows < 1) {
	$visitor_check = 0;
}
if ($visitor_check = 1) {
	$sql = "INSERT INTO unique_visitors(visitor_ip) VALUE ('$visitor_ip')";
	if (mysqli_query($conn, $sql)) {
		echo "";
	} else {
		echo "";
	}
}
?>
<?php
include("includes/header.php");

$sql = "SELECT * FROM categories WHERE category_name='Women' OR category_name='Men' ";
$result = mysqli_query($conn, $sql);
$cat  = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<!-- photo Slider -->
<section class="section-slide">
	<div class="wrap-slick1 rs2-slick1">
		<div class="slick1">
			<div class="item-slick1 bg-overlay1" style="background-image: url(images/slide-05.jpg);" data-thumb="images/thumb-01.jpg" data-caption="Women’s Wear">
				<div class="container h-full">
					<div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
						<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
							<span class="ltext-202 txt-center cl0 respon2">
								Women Collection 2022
							</span>
						</div>

						<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
							<h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
								New arrivals
							</h2>
						</div>

						<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
							<a href="shop.php?page=1" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Shop Now
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="item-slick1 bg-overlay1" style="background-image: url(images/slide-06.jpg);" data-thumb="images/thumb-02.jpg" data-caption="Men’s Wear">
				<div class="container h-full">
					<div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
						<div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
							<span class="ltext-202 txt-center cl0 respon2">
								Men New-Season
							</span>
						</div>

						<div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
							<h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
								Jackets & Coats
							</h2>
						</div>

						<div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
							<a href="shop.php?page=1" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Shop Now
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="item-slick1 bg-overlay1" style="background-image: url(images/slide-07.jpg);" data-thumb="images/thumb-03.jpg" data-caption="Men’s Wear">
				<div class="container h-full">
					<div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
						<div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
							<span class="ltext-202 txt-center cl0 respon2">
								Men Collection 2022
							</span>
						</div>

						<div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
							<h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
								NEW SEASON
							</h2>
						</div>

						<div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
							<a href="shop.php?page=1" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Shop Now
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="wrap-slick1-dots p-lr-10"></div>
	</div>
</section>

<!-- Banner -->
<div class="sec-banner bg0 p-t-95 p-b-55">
	<div class="container">
		<div class="row">

			<?php foreach ($cat as $val) {   ?>
				<div class="col-md-6 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="<?php echo 'admin/' . $val['category_image'];  ?>" loading="lazy" alt="IMG-BANNER">

						<a href="shop.php?sort=category&id=<?php echo $val['category_id'] ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									<?php echo $val['category_name'];  ?>
								</span>

								<span class="block1-info stext-102 trans-04">
									<?php echo $val['category_description'];  ?>
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Shop Now
								</div>
							</div>
						</a>
					</div>
				</div>

			<?php   } ?>

			<?php

			$sql = "SELECT * FROM categories WHERE category_name='Shoes' OR category_name='Bags' OR category_name='Accessories'";
			$result = mysqli_query($conn, $sql);
			$cat2  = mysqli_fetch_all($result, MYSQLI_ASSOC);

			foreach ($cat2 as $val) {   ?>
				<div class="col-md-6 col-lg-4 p-b-30 m-lr-auto">
					<div class="block1 wrap-pic-w">
						<img style="height:280px; object-fit:cover;" loading="lazy" src="<?php echo 'admin/' . $val['category_image'];  ?>" alt="IMG-BANNER">

						<a href="shop.php?sort=category&id=<?php echo $val['category_id'] ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									<?php echo $val['category_name'];  ?>
								</span>

								<span class="block1-info stext-102 trans-04">
									<?php echo $val['category_description'];  ?>
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Shop Now
								</div>
							</div>
						</a>
					</div>
				</div>
			<?php   } ?>
		</div>

	</div>
</div>



<!-- News section  -->

<section class="bg0 p-t-23 p-b-130">
	<div class="container">
		<div class="p-b-10">
			<h3 class="ltext-103 cl5">
				New Items
			</h3>
		</div>

		<!-- block two  -->
		<!-- connectto  sql  -->
		<?php

		$sql = "SELECT * FROM products WHERE product_tag LIKE '%new%' LIMIT 4 ";
		$result = mysqli_query($conn, $sql);
		$product  = mysqli_fetch_all($result, MYSQLI_ASSOC);

		?>

		<div class="row isotope-grid">

			<!-- first image  -->
			<?php foreach ($product as $val) { ?>
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item sales">
					<!-- Block2 -->

					<div class="block2">
						<div class="block2-pic hov-img0 label-new" data-label="New">
							<a href="product-detail.php?id=<?php echo $val["product_id"] ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								<img loading="lazy" src="<?php echo 'admin/' . $val['product_main_image'];  ?>" alt="IMG-PRODUCT">
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product-detail.php?id=<?php echo $val["product_id"] ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<?php echo $val["product_name"]   ?>
								</a>

								<span class="stext-105 cl3">
									<?php echo "$" . $val["product_price"]   ?>
								</span>
							</div>
						</div>

					</div>
				</div>
			<?php  }  ?>

		</div>


	</div>
</section>


<!-- sales section  -->

<section class="bg0 p-t-23 p-b-130">
	<div class="container">
		<div class="p-b-10">
			<h3 class="ltext-103 cl5">
				Items On Sale
			</h3>
		</div>

		<!-- block two  -->
		<!-- connectto  sql  -->
		<?php

		$sql = "SELECT * FROM products WHERE product_tag LIKE '%sales%' LIMIT 4 ";
		$result = mysqli_query($conn, $sql);
		$product  = mysqli_fetch_all($result, MYSQLI_ASSOC);

		?>

		<div class="row isotope-grid">

			<!-- first image  -->
			<?php foreach ($product as $val) {     ?>
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item sales">
					<!-- Block2 -->

					<div class="block2">
						<div class="block2-pic hov-img0 ">
							<a href="product-detail.php?id=<?php echo $val["product_id"] ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								<div style="width:15%;height:5vh;border-radius:50px;background-color:red;text-align:center;position:absolute ;padding-top:10px;color:white;font-weight:bold"> 50% </div>
								<img loading="lazy" src="<?php echo 'admin/' . $val['product_main_image'];  ?>" alt="IMG-PRODUCT">
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product-detail.php?id=<?php echo $val["product_id"] ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<?php echo $val["product_name"]   ?>
								</a>
								<span class="stext-105 cl3">
									<?php echo "$" . $val["product_price"]   ?>
								</span>
							</div>
						</div>
					</div>
				</div>
			<?php  }  ?>
		</div>
	</div>
</section>
<?php
include("includes/footer.php");
?>