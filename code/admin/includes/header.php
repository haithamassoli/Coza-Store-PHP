<?php
require("includes/connect.php");
require_once("functions.php");
session_start();
?>
<?php
if (isset($_SESSION["type"]) && $_SESSION["type"] != 0) {
  if ($_SESSION["type"] == 2) {
    $id = $_SESSION["super_admin_id"];
  } else {
    $id = $_SESSION["admin_id"];
  }
  $sql    = "SELECT * FROM admins WHERE admin_id=$id";
  $result = mysqli_query($conn, $sql);
  @$admins = mysqli_fetch_all($result, MYSQLI_ASSOC);
} elseif (!isset($_SESSION["type"])) {
  redirect('../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dahboard</title>
  <!-- Favicon -->
  <link rel="stylesheet" href="./assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
  <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
  <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <!-- Custom styles -->
  <link rel="stylesheet" href="./assets/css/style.min.css">
</head>

<body>
  <div class="layer"></div>
  <!-- ! Body -->
  <a class="skip-link sr-only" href="#skip-target">Skip to content</a>
  <div class="page-flex">
    <!-- ! Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-start">
        <div class="sidebar-head">
          <a href="index.php" class="logo-wrapper" title="Home">
            <span class="sr-only">Home</span>
            <span class="icon logo" aria-hidden="true"></span>
            <div class="logo-text">
              <i class="fa-light fa-house"></i>
            </div>

          </a>
          <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
            <span class="sr-only">Toggle menu</span>
            <span class="icon menu-toggle" aria-hidden="true"></span>
          </button>
        </div>
        <div class="sidebar-body">
          <ul class="sidebar-body-menu">
            <li>
              <a class="active" href="./index.php"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
            </li>
            <?php
            if (isset($_SESSION["type"])) {
              if ($_SESSION["type"] == 2) {
                echo '<li>
                                  <a href="manage_admins.php"><span class="icon document" aria-hidden="true"></span>Admin</a>
                                </li>
                                <li>
                                  <a href="manage_users.php"><span class="icon document" aria-hidden="true"></span>Users</a>
                                </li>';
              }
            }
            ?>
            </li>
            <li>
            <li>
              <a href="manage_categories.php"><span class="icon folder" aria-hidden="true"></span>Categories</a>
            </li>
            </li>
            <li>
            <li>
              <a href="manage_products.php"><span class="icon image" aria-hidden="true"></span>Products</a>
            </li>
            <li>
              <a href="manage_orders.php"><span class="icon paper" aria-hidden="true"></span>Orders</a>
            </li>
            <li>
              <a href="manage_comments.php"><span class="icon paper" aria-hidden="true"></span>Comments</a>
            <li>
            <li>
              <a href="manage_coupons.php"><span class="icon paper" aria-hidden="true"></span>Coupons</a>
            </li>
            <li>
              <a href="../index.php"><span class="icon paper" aria-hidden="true"></span>webisite</a>
            </li>
            </li>
          </ul>
          <?php
          if (isset($_SESSION["type"])) {
            if ($_SESSION["type"] == 2)
              echo '<div class="sidebar-footer" style="margin-top: 70px;">
            <a href="##" class="sidebar-user">
              <span class="sidebar-user-img">
              <img src="' . @$admins[0]['admin_image'] . '">
              </span>
              <div class="sidebar-user-info">
                <span class="sidebar-user__title">' . @$admins[0]['admin_name'] . '</span>
              </div>
            </a>
          </div>';
            else {
              echo '<div class="sidebar-footer" style="margin-top: 370px;">
              <a href="##" class="sidebar-user">
              <span class="sidebar-user-img">
              <img src="' . $admins[0]['admin_image'] . '">
              </span>
              <div class="sidebar-user-info">
                <span class="sidebar-user__title">' . $admins[0]['admin_name'] . '</span>
              </div>
            </a>
          </div>';
            }
          }
          ?>
    </aside>
    <div class="main-wrapper">
      <!-- ! Main nav -->
      <nav class="main-nav--bg">
        <div class="container main-nav">
          <div class="main-nav-start">
            <div style=" font-family: fantasy;background-color: blue;color: white;line-height: 2;width: 100px;padding-left: 22px;opacity: 0.5;"><a href="../index.php" style="text-decoration: none; color:white;">COZ SHOP</a></div>
          </div>
          <div class="main-nav-end">
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
              <span class="sr-only">Toggle menu</span>
              <span class="icon menu-toggle--gray" aria-hidden="true"></span>
            </button>
            <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
              <span class="sr-only">Switch theme</span>
              <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
              <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
            </button>
            <div class="notification-wrapper">
              <button class="gray-circle-btn dropdown-btn" title="To messages" type="button">

                <!-- <span class="sr-only"></span> -->

                <?php
                $sql = "SELECT * FROM comments";
                $result = mysqli_query($conn, $sql);
                $row   = mysqli_fetch_all($result);
                if ($result->num_rows == 0) {
                ?>
                  <span class="icon notification " aria-hidden="true"></span>
                  <i class="far fa-bell"></i>
              </button>
            </div>
          <?php } else {
                  echo '<span class=""><i class="notification mt-2 active far fa-bell"></i></span>

                  </button>
                  </div>';
                } ?>
          <div class="nav-user-wrapper">
            <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
              <span class="sr-only">My profile</span>
              <span class="nav-user-img">
                <img src="<?php echo  $admins[0]['admin_image'] ?>" alt="abcd">
              </span>
            </button>
            <ul class="users-item-dropdown nav-user-dropdown dropdown">
              <li><a class="danger" href="../logout.php">
                  <i data-feather="log-out" aria-hidden="true"></i>
                  <span>Log out</span>
                </a></li>
            </ul>
          </div>
          </div>
        </div>
      </nav>