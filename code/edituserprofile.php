<?php
$title = "Profile";
include('includes/header.php');



$image     = "";
$name      = "";
$email     = "";
$password  = "";
$gender    = "";
$mobile    = "";
$location  = "";

//Start Function
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

// start Edit 
$sql    = "SELECT * FROM users WHERE user_id='{$_SESSION["user_id"]}'";
$result = mysqli_query($conn, $sql);
$user   = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $check    = 1;
    $image    = ($_FILES["userimg"]);
    $name     = ($_POST["name"]);
    $email    = strtolower($_POST["email"]);
    $password = ($_POST["password"]);
    $gender   = ($_POST["gender"]);
    $mobile   = ($_POST["mobile"]);
    $location   = ($_POST["location"]);

    // input validation 
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $nameError  = "Only letters and white space allowed";
        $check      = 0;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $emailError     = ("email is not a valid email address");
        $check          = 0;
    }
    if ($name == "") {

        $check          = 0;
        $nameError      = "The name shouldn't be empty!";
    }
    if ($email == "") {

        $check          = 0;
        $emailError     = "The email shouldn't be empty!";
    }
    if ($password == "") {

        $check          = 0;
        $passError      = "The password shouldn't be empty!";
    }
    if (!isset($user['user_image'])) {
        if (($image["size"]) == 0) {
            $target_file    = $user[0]['user_image'];
            $image_check    = "";
        }
    }
    //Image File
    $image_folder   = "admin/uploads/user_image/";
    $target_file    = $image_folder . uniqid() . basename($image["name"]);
    $image_check    = ",user_image='$target_file'";

    move_uploaded_file($image["tmp_name"], $target_file);
    if ($check == 1) {

        $id = (int)$_SESSION["user_id"];

        $sql2 = "UPDATE users  SET user_name = '$name', user_email ='$email', user_mobile='$mobile', user_location='$location', user_gender='$gender', user_password='$password' {$image_check} WHERE user_id =$id ";
        if ($conn->query($sql2) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
        $conn->close();
        redirect("profile.php");
    }
}
?>

<!--Links -->


<!-- End Links -->


<form action="" method="POST" enctype="multipart/form-data">
    <div class="page-header header-filter" data-parallax="true" style="background-image:url('images/product-04.jpg');"></div>
    <div class="main main-raised">
        <div class="profile-content" style="margin-bottom: 135px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <div class="profile" style="text-align: center;">
                            <label>
                                <div class="avatar">
                                    <img loading="lazy" src="<?php echo $user[0]['user_image'] ?>" alt="photo" style="margin-top:-90px; border-radius: 50%; width : 180px; height: 180px; cursor:pointer;">
                                    <div class="file ck" style="position: relative;">

                                        <input name="userimg" type="file" class="form-control" id="exampleInputPassword1" style="display: none;">
                                        <i class="fas fa-plus fa-3x" style="color: white; cursor:pointer; position:absolute;bottom:80%; right:-70px;"></i>

                                    </div>

                                </div>
                            </label>
                            <div class="name">
                                <h3 class="title"><?php echo $user[0]['user_name'] ?></h3>
                                <h6 class="created"><?php echo "DATE CREATED: " . $user[0]['user_creation_date'] ?></h6>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gutters ">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h5 class="personal">Personal Details</h5>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group ii">
                            <label for="fullName" class="fullname">Full Name</label>
                            <input name="name" type="text" class="form-control" id="fullName" placeholder="Enter full name" value="<?php echo $user[0]['user_name']; ?>">
                        </div>
                        <div style="color:red"><?php echo @$nameError; ?></div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group f ii">
                            <label for="eMail">Email</label>
                            <input name="email" type="email" class="form-control" id="eMail" placeholder="Enter email ID" value="<?php echo $user[0]['user_email']; ?>">
                        </div>
                        <div style="color:red"><?php echo @$emailError; ?></div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group ii">
                            <label for="phone">Phone</label>
                            <input name="mobile" type="text" class="form-control" id="phone" placeholder="Enter phone number" value="<?php echo $user[0]['user_mobile']; ?>">
                        </div>
                        <div style="color:red"><?php echo @$mobileError; ?></div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group f ii">
                            <label for="website">Password</label>
                            <input name="password" type="password" class="form-control" id="password" placeholder="Enter your password" value="<?php echo $user[0]['user_password']; ?>">
                        </div>
                        <div style="color:red"><?php echo @$passError; ?></div>
                    </div>
                </div>
                <div class="row gutters">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group ii">
                            <label for="Street">Gender</label>

                            <select name="gender" class="form-control col-9 mb-2" style="border: 1px solid #dce7f1 !important;">
                                <option value="male" <?php echo $user[0]['user_gender'] == 'male' ? "selected" : ""; ?>> Male </option>
                                <option value="female" <?php echo $user[0]['user_gender'] == 'female' ? "selected" : ""; ?>> Female </option>
                            </select>
                        </div>

                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group f ii">
                            <label for="ciTy">Location</label>
                            <input name="location" type="text" class="form-control" id="location" placeholder="Enter your Location" value="<?php echo $user[0]['user_location']; ?>">
                        </div>
                        <div style="color:red"><?php echo @$locationError; ?></div>
                    </div>

                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-right u z">
                                <style>
                                    .savebtn {
                                        background-color: #7D7D7D;
                                    }

                                    .savebtn:hover {
                                        background-color: #8A2BE2;
                                    }
                                </style>
                                <button class="bc" type="submit" id="submit" name="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</form>



<!-- End Form -->
<?php
$conn->close();
?>
<?php
include('includes/footer.php');
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == 0) {
    redirect('location:index.php');
}
?>