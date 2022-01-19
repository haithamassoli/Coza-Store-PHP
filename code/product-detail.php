<?php
if (!isset($_GET["id"])) {
	header('location:index.php');
}
?>
<?php
ob_start(); // Output Buffering Start
$title = "Product";
include "./includes/header.php";
function redirect($url)
{
	if (!headers_sent()) {
		header('Location: ' . $url);
		exit;
	} else {
		echo '<script type="text/javascript">';
		echo 'window.location.href="' . $url . '";';
		echo '</script>';
		echo '<noscript>';
		echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
		echo '</noscript>';
		exit;
	}
}
require('admin/includes/connect.php');

//select products

if (isset($_GET["id"])) {
	@$comment_product_id  = $_GET["id"];
	@$user_id = $_SESSION["user_id"];
	@$comment = $_POST["review"];
	@$rating = $_POST["rating"];

	// @$product_rate = $_POST["product_rate"];
	@$image = $_FILES["image"];
	$sql = "SELECT * FROM products INNER JOIN categories ON products.product_categorie_id = categories.category_id WHERE product_id = {$_GET['id']}";
	$result = mysqli_query($conn, $sql);
	$product  = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$related = $product[0]['category_name'];
	if ($result->num_rows < 1) {
		redirect("index.php");
	}
	//select comments
	$sql = "SELECT * FROM comments INNER JOIN products ON comments.comment_product_id = products.product_id INNER JOIN users ON comments.comment_user_id = users.user_id WHERE products.product_id = {$_GET['id']}";
	$result = mysqli_query($conn, $sql);
	$comments  = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//select related
	$sql = "SELECT * FROM products WHERE product_tag LIKE '%{$related}%' LIMIT 4";
	$result = mysqli_query($conn, $sql);
	$related  = mysqli_fetch_all($result, MYSQLI_ASSOC);


	//review
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST["submit"])) {
			$check = 1;
			if ($comment == "") {
				$check = 0;
				header('Location: ' . $_SERVER['PHP_SELF'] . "?id=" . "$comment_product_id");
				$commentErorr = "you should right a comment";
			}
			if ($check == 1 && $image["size"] == 0) {
				$sql = "INSERT INTO `comments` (`comment`, 
			`comment_product_id`,`comment_user_id`,`comment_rate`)
			VALUES ('$comment',$comment_product_id,$user_id,$rating)";

				if (mysqli_query($conn, $sql)) {
					redirect("product-detail.php?id={$comment_product_id}");
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			} elseif ($check == 1) {
				$image_folder = "uploads/";
				$target_file  = $image_folder . uniqid() . basename($image["name"]);
				move_uploaded_file($image["tmp_name"], $target_file);
				$sql1 = "INSERT INTO `comments` (`comment`, `comment_image`, 
			`comment_product_id`,`comment_user_id`,`comment_rate`)
			VALUES ('$comment','$target_file',$comment_product_id,$user_id,$rating)";
			}
			if (mysqli_query($conn, $sql1)) {
				redirect("product-detail.php?id={$comment_product_id}");
			} else {
				echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
			}
			$conn->close();
			redirect("product-detail.php?id={$comment_product_id}");
		}
	}
	// add to cart
	if (isset($_POST["add_to_cart"])) {
		$ok = 1;
		if ($_POST['size'] == 0) {
			$sizeError = "you must choose size!";
			$ok = 0;
		}
		if ($ok == 1) {
			if (isset($_SESSION['cart'])) {
				$items = array_column($_SESSION["cart"], 'product_id');
				$size = array_column($_SESSION["cart"], 'size');
				if (in_array($_POST['add_to_cart_id'], $items)  && in_array($_POST['size'], $size)) {
					$_SESSION["cart"][$_POST['add_to_cart_id']  . $_POST['size']]["quantity"] += $_POST['num-product'];
					header("location:product-detail.php?id={$_GET['id']}");
				} else {
					$item_array = array(
						'product_id' => $_POST['add_to_cart_id'],
						'product_price' => $_POST['product_price'],
						'quantity' => $_POST['num-product'],
						'product_name' => $_POST['product_name'],
						'product_image' => $_POST['product_image'],
						'size' => $_POST['size']
					);
					$_SESSION["cart"][$_POST['add_to_cart_id'] . $_POST['size']] = $item_array;
					header("location:product-detail.php?id={$_GET['id']}");
				}
			} else {
				$item_array = array(
					'product_id' => $_POST['add_to_cart_id'],
					'product_price' => $_POST['product_price'],
					'quantity' => $_POST['num-product'],
					'product_name' => $_POST['product_name'],
					'product_image' => $_POST['product_image'],
					'size' => $_POST['size']
				);
				$_SESSION["cart"][$_POST['add_to_cart_id'] . $_POST['size']] = $item_array;
				header("location:product-detail.php?id={$_GET['id']}");
			}
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

		<a href="shop.php?page=1" class="stext-109 cl8 hov-cl1 trans-04">
			<?php echo $product[0]['category_name'] ?>
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<span class="stext-109 cl4">
			<?php echo $product[0]['product_name'] ?>
		</span>
	</div>
</div>
<span class="text-danger"><?php echo isset($commentErorr) ? $commentErorr : ""; ?></span>

<?php foreach ($product as $key => $row) { ?>

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
							<div class="slick3 gallery-lb">
								<div class="item-slick3" data-thumb="<?php echo 'admin/' . $row["product_main_image"]; ?>">
									<div class="wrap-pic-w pos-relative">
										<img loading="lazy" src="<?php echo 'admin/' . $row["product_main_image"]; ?>" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo 'admin/' . $row["product_main_image"]; ?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
								<?php if (isset($row["product_desc_image_2"])) { ?>
									<div class="item-slick3" data-thumb="<?php echo 'admin/' . $row["product_desc_image_2"];  ?>">
										<div class="wrap-pic-w pos-relative">
											<img loading="lazy" src="<?php echo 'admin/' . $row["product_desc_image_2"]; ?>" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo 'admin/' . $row["product_desc_image_2"]; ?>">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								<?php } ?>
								<?php if (isset($row["product_desc_image_3"])) { ?>
									<div class="item-slick3" data-thumb="<?php echo 'admin/' . $row["product_desc_image_3"]; ?>">
										<div class="wrap-pic-w pos-relative">
											<img loading="lazy" src="<?php echo 'admin/' . $row["product_desc_image_3"]; ?>" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo 'admin/' . $row["product_desc_image_3"]; ?>">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								<?php } ?>
								<?php if (isset($row["product_nd_color_image"])) { ?>
									<div class="item-slick3" data-thumb="<?php echo 'admin/' . $row["product_nd_color_image"]; ?>">
										<div class="wrap-pic-w pos-relative">
											<img loading="lazy" src="<?php echo 'admin/' . $row["product_nd_color_image"]; ?>" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo 'admin/' . $row["product_nd_color_image"]; ?>">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								<?php } ?>
								<?php if (isset($row["product_thd_color_image"])) { ?>
									<div class="item-slick3" data-thumb="<?php echo 'admin/' . $row["product_thd_color_image"]; ?>">
										<div class="wrap-pic-w pos-relative">
											<img loading="lazy" src="<?php echo 'admin/' . $row["product_thd_color_image"]; ?>" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo 'admin/' . $row["product_thd_color_image"]; ?>">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								<?php } ?>
								<?php if ($row["product_fourth_color_image"] == '') { ?>
									<div class="item-slick3" data-thumb="<?php echo 'admin/' . $row["product_fourth_color_image"]; ?>">
										<div class="wrap-pic-w pos-relative">
											<img loading="lazy" src="<?php echo 'admin/' . $row["product_fourth_color_image"]; ?>" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo 'admin/' . $row["product_fourth_color_image"]; ?>">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<form method="POST">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							</h4>

							<h4 class="mtext-106 cl2">
								<?php echo $row["product_name"];  ?>
							</h4>
							<br>
							<span class="mtext-106 cl2">
								<?php echo '$' . $row["product_price"];  ?>
							</span>

							<p class="stext-102 cl3 p-t-23">
								<?php echo $row["product_description"];  ?>
							</p>

							<!--  -->
							<div class="p-t-33">

								<div class="flex-w flex-r-m p-b-10" style="<?php echo $row['product_size'] == "" ? 'display: none' : ''; ?>;">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="size">
												<option value="<?php echo $row['product_size'] == "" ? "-" : 0; ?>">Choose an option</option>
												<?php
												if ($row['product_size'] != "") {
													$sizeStr = $row['product_size'];
													$sizeArr = explode(',', $sizeStr);
													foreach ($sizeArr as $size) {
												?>
														<option value="<?php echo $size; ?>"><?php echo $size; ?></option>
												<?php }
												} ?>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
										<span class="text-danger"><?php echo isset($sizeError) ? $sizeError : ""; ?></span>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
										<a href="product-detail.php?id=<?php echo $row["product_id"];  ?>">
											<input type="hidden" name="add_to_cart_id" value="<?php echo $_GET['id']; ?>">
											<input type="hidden" name="product_name" value="<?php echo $product[0]['product_name']; ?>">
											<input type="hidden" name="product_image" value="<?php echo $product[0]['product_main_image']; ?>">
											<input type="hidden" name="product_price" value="<?php echo $row["product_price"]; ?>">
											<br>
											<br>
											<button type="submit" name="add_to_cart" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
												Add to cart
											</button>
										</a>
									</div>
								</div>
							</div>

							<!--  -->
							<div class="flex-w ml-5 flex-m p-l-100 p-t-40 respon7">
								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>
							</div>
						</form>
					</div>
				</div>
			<?php } ?>
			</div>

			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
						</li>

						<li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (<?php print_r(count($comments)); ?>)</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- - -->
						<div class="tab-pane fade show active" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<p class="stext-102 cl6">
									<?php echo $row["product_description"];  ?></p>
							</div>
						</div>


						<!-- - -->
						<div class="tab-pane fade" id="reviews" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">
										<!-- Review -->
										<?php foreach ($comments as  $row) { ?>
											<div class="flex-w flex-t p-b-68">
												<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
													<img loading="lazy" src="<?php echo $row["user_image"];  ?>" alt="AVATAR">
												</div>
												<div class="size-207">
													<div class="flex-w flex-sb-m p-b-17">
														<span class="mtext-107 cl2 p-r-20">
															<?php echo $row["user_name"];  ?>
														</span>
														<!-- <span class="fs-18 cl11">
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star-half"></i>
													</span> -->

														<span class="fs-18 cl11">
															<?php
															for ($r = 1; $r <= $row["comment_rate"]; $r++) {
																echo '<i class="zmdi zmdi-star"></i>';
															}
															for ($e = 1; $e <= 5 - $row["comment_rate"]; $e++) {
																echo '<i class="item-rating pointer zmdi zmdi-star-outline"></i>';
															}
															?>
															<input class="dis-none" type="number" name="rating">
														</span>
													</div>
													<p class="stext-102 cl6">
														<?php echo $row["comment"];  ?>
													</p>
													<p class="stext-102 cl6">
														<?php if ($row["comment_image"] != "") { ?>
															<img loading="lazy" src="<?php echo $row["comment_image"];  ?>" style='width:300px; height:200px; ' alt="">
														<?php } ?>
													</p>
												</div>
											</div>
										<?php } ?>
										<!-- Add review -->
										<?php
										if (isset($_SESSION['type'])) {
											if ($_SESSION['type'] == 0) {
										?>
												<form class="w-full" enctype="multipart/form-data" method="POST">
													<h5 class="mtext-108 cl2 p-b-7">
														Add a review
													</h5>

													<div class="flex-w flex-m p-t-50 p-b-23">
														<span class="stext-102 cl3 m-r-16">
															Your Rating
														</span>
														<span class="wrap-rating fs-18 cl11 pointer">
															<i class="item-rating pointer zmdi zmdi-star-outline"></i>
															<i class="item-rating pointer zmdi zmdi-star-outline"></i>
															<i class="item-rating pointer zmdi zmdi-star-outline"></i>
															<i class="item-rating pointer zmdi zmdi-star-outline"></i>
															<i class="item-rating pointer zmdi zmdi-star-outline"></i>
															<input class="dis-none" type="number" name="rating">
														</span>
													</div>

													<div class="file-upload-wrapper" data-text="Select your file!">

														<div class="row p-b-25">
															<div class="col-12 p-b-5">
																<label class="stext-102 cl3" for="review">Your review</label>
																<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
															</div>
															<input name="image" type="file" class="file-upload-field" value="">

														</div>
													</div>
									</div>
									<button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10" value="submit" name="submit">
										Submit
									</button>
									</form>
							<?php }
										} ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- Related Products -->
	<section class="sec-relate-product bg0 p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					Related Products
				</h3>
			</div>


			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
					<?php foreach ($related as $key => $row) { ?>
						<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
							<!-- Block2 -->
							<div class="block2">
								<a href="product-detail.php?id=<?php echo $row["product_id"] ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<div class="block2-pic hov-img0">
										<img loading="lazy" src="<?php echo 'admin/' . $row["product_main_image"];  ?>" alt="IMG-PRODUCT">
									</div>
								</a>
								<div class="block2-txt flex-w flex-t p-t-14">
									<div class="block2-txt-child1 flex-col-l ">
										<a href="product-detail.php?id=<?php echo $row["product_id"] ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
											<?php echo $row["product_name"];  ?>
										</a>
										<span class="stext-105 cl3">
											<?php echo '$' . $row["product_price"];  ?>
										</span>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>



		</div>
	</section>
	<?php include "./includes/footer.php";
	ob_end_flush(); // Release The Output
	?>