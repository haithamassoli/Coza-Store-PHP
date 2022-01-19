<?php
//start sesstion
$title = "Profile";
include('includes/header.php');
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
$sessionUse     = "";
if (isset($_SESSION['type'])) {
	$sessionUser = $_SESSION['type'];
}
if (isset($_SESSION['type']) && $_SESSION['type'] == 0) {
	// Query
	$sql = "SELECT * FROM users WHERE user_id='{$_SESSION["user_id"]}'";
	$result = mysqli_query($conn, $sql);
	$user  = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
	<div class="page-header header-filter" data-parallax="true" style="background-image:url('images/product-04.jpg');"></div>
	<div class="main main-raised">
		<div class="profile-content" style="margin-bottom: 135px;">
			<div class="container">
				<div class="row">
					<div class="col-md-6 ml-auto mr-auto">
						<div class="profile" style="text-align: center;">
							<div class="avatar">
								<img loading="lazy" src="<?php echo $user[0]['user_image'] ?>" alt="photo" style="margin-top:-90px; border-radius: 50%; width : 180px; height: 180px;">
							</div>
							<div class="name">
								<h3 class="title"><?php echo $user[0]['user_name'] ?></h3>
								<h6 class="created"><?php echo "Date created: " . $user[0]['user_creation_date'] ?></h6>

							</div>
						</div>
					</div>
				</div>

				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
						<h5 class="personal">Personal Details</h5>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group f2">
							<label for="fullName" class="fullname">Full Name</label>
							<div class="borderDiv">
								<p><?php echo $user[0]['user_name'] ?>
							</div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group f f2">
							<label for="eMail">Email</label>
							<div class="borderDiv"><?php echo $user[0]['user_email'] ?></div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group f2">
							<label for="phone">Phone</label>
							<div class="borderDiv"><?php echo $user[0]['user_mobile'] ?></div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group f f2">
							<label for="website">Password</label>
							<div class="borderDiv"><?php echo $user[0]['user_password'] ?></div>
						</div>
					</div>
				</div>
				<div class="row gutters">
					<!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<h6 class="mb-3 text-primary">Address</h6>
					</div> -->
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group f2">
							<label for="Street">Gender</label>
							<div class="borderDiv"><?php echo $user[0]['user_gender'] == 0 ? "Male" : "Female"; ?></div>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group f f2">
							<label for="ciTy">Location</label>
							<div class="borderDiv"><?php echo $user[0]['user_location'] ?> </div>
						</div>
					</div>
					<!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="sTate">State</label>
							<div class="borderDiv">ggg </div> 
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group f">
							<label for="zIp">Zip Code</label>
							<<div class="borderDiv">ggg </div>
						</div>
					</div> -->


					<div style="text-align: right;">
						<a class="bt" href="edituserprofile.php" style="text-decoration: none;">
							<button type="button" id="submit" name="submit" class="btn btn-primary">
								Edit Profile
							</button>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>
<?php
} else {
	header('location:sign_in.php');
	exit();
}
include('includes/footer.php');
?>
<?php
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == 0) {
	header('location:index.php');
}
?>