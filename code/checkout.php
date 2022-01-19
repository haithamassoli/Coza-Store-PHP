<?php
ob_start();
$title = "Checkout";
include "./includes/header.php";
include "admin/includes/functions.php";
if (!isset($_SESSION["type"]) || $_SESSION["type"] != 0) {
  header('location:sign_in.php?back_to_checkout');
}
if (!isset($_SESSION['cart'])) {
  header('location:shop.php?page=1');
}

if (isset($_SESSION['user_id'])) {
  $id = $_SESSION['user_id'];
}
$sql = "SELECT * FROM users WHERE user_id =$id";
$result = mysqli_query($conn, $sql);
$users  = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['pay'])) {
  $check = 1;
  $name = ($_POST["name"]);
  $email = strtolower($_POST["email"]);
  $location = ($_POST["city"]);
  $mobile   = ($_POST["number"]);
  if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
    $nameError = "Only letters and white space allowed";
    $check = 0;
  }
  // email validation 
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailError = ("email is not a valid email address");
    $check = 0;
  }
  if ($name == "") {
    $check = 0;
    $nameError = "The name shouldn't be empty!";
  }
  if ($email == "") {
    $check = 0;
    $emailError = "The email shouldn't be empty!";
  }
  if ($location == "") {
    $check = 0;
    $locationError = "The location shouldn't be empty!";
  }
  if ($mobile == "") {
    $check = 0;
    $mobileError = "The mobile shouldn't be empty!";
  }
  if (!preg_match("/^[077|079|078]+[0-9]{7}$/", $mobile)) { //mobile 
    $mobileError  = "should be a mobile number";
    $check      = 0;
  }
  if ($check == 1) {
    foreach ($_SESSION['cart'] as $key => $val) {
      $total += (int)$value['product_price'] * (int)$value['quantity'];
      $cartStr = "," . $val['product_name'] . "," . $val['product_price'] . "," . $val['product_id'] . "," . $val['product_size'] . "," . $val['product_quantity'];
      $cart = $cart . $cartStr;
    }
    if ($total != 0) {
      $tot = $_SESSION['total'];
      $sql = "INSERT INTO orders (`order_details`,`order_location`,`order_mobile`,`order_user_id`,`order_user_name`,`order_total`) VALUES ('$cart','$location',$mobile,$id,'$name','$tot')";
      $result = mysqli_query($conn, $sql);
      unset($_SESSION['cart']);
      unset($_SESSION['total']);
      unset($_SESSION['couponsDis']);
      redirect("index.php?checked");
      $conn->close();
    }
  }
}

?>
<?php
if (isset($_POST['checkout']) && $total == 0) {
  echo  '<div class="text-center h5 mt-5">you must add to cart!</div>';
} elseif (isset($_POST['checkout']) && $total != 0) {
  unset($_SESSION['cart']);
  unset($_SESSION['total']);
  unset($_SESSION['couponsDis']);
  header("location:index.php?checked");
}


?>

</div>
</form>
<!-- breadcrumb -->
<div class="container">
  <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
    <a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
      Home
      <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
    </a>

    <span class="stext-109 cl4">
      Checkout
    </span>
  </div>
</div>


<!-- Shoping Cart -->
<form class="bg0 p-t-75 p-b-85" method="POST">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
        <div class="m-l-25 m-r--38 m-lr-0-xl">
          <form class="needs-validation" novalidate>
            <div class="form-row">
              <div class="col-md-6 mb-4">
                <label for="validationCustom01">Full Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $users[0]['user_name'] ?>">
                <div class="valid-feedback text-danger">
                  <?php echo isset($nameError) ? $nameError : ""; ?>

                </div>
              </div>
              <div class="col-md-6 mb-4">
                <label for="validationCustom01">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $users[0]['user_email']; ?>">
                <div class="valid-feedback text-danger">
                  <?php echo isset($emailError) ? $emailError : ""; ?>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 mb-4">
                <label for="validationCustom03">Mobile</label>
                <input type="number" name="number" class="form-control" value="<?php echo isset($users[0]['user_mobile']) ? $users[0]['user_mobile'] : ""; ?>" placeholder="Mobile">
                <div class=" text-danger">
                  <?php echo isset($mobileError) ? $mobileError : ""; ?>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <label for="validationCustom04">City</label>
                <input type="text" name="city" class="form-control" value="<?php echo isset($users[0]['user_location']) ? $users[0]['user_location'] : ""; ?>" placeholder="City">
                <div class="text-danger">
                  <?php echo isset($locationError) ? $locationError : ""; ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-check">
                <input style="position:absolute; left:20px;" class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                  Cash on delivery
                </label>
                <div class="invalid-feedback">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="col-sm-10 col-lg-10 col-xl-5 m-lr-auto m-b-50">
        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
          <h4 class="mtext-109 cl2 p-b-30">
            Cart Totals
          </h4>
          <ul class="header-cart-wrapitem w-full">
            <?php if (isset($_SESSION['cart'])) {
              foreach ($_SESSION['cart'] as $key => $value) { ?>
                <li class="header-cart-item flex-w flex-t m-b-12">
                  <div class="header-cart-item-img">
                    <img loading="lazy" src="<?php echo "admin/" . $value['product_image']; ?>" alt="IMG">
                  </div>

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
            } ?>
          </ul>
          <hr>
          <div class="flex-w flex-t  p-b-33">
            <div class="size-208">
              <span class="mtext-101 cl2">
                Total: <?php echo isset($_SESSION['total']) ?  "$" . $_SESSION['total'] : "$" . $total / 2 ?>
              </span>
            </div>
          </div>
          <button type="submit" name="pay" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
            Pay
          </button>
          <!-- <script>
            const btn = document.querySelector(".btn1");
            btn.addEventListener("click", (e) => {
              swal("Good job!", "You clicked the button!", "success");
              e.preventDefault()
              setTimeout(() => {
                window.location = "index.php"
              }, 5000);
            })
          </script> -->
        </div>
      </div>
    </div>
  </div>
</form>

<?php include "./includes/footer.php";
ob_end_flush(); ?>