<?php
session_start();
include "./admin/includes/connect.php";
if (isset($_SESSION["type"])) {
    header('location:../index.php');
}
?>
<?php
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $img = '<img src="./uploads/61addacec48a1blog-06.jpg">';
    $check               = 1;
    $user_name           = ($_POST["user_name"]);
    $email               = strtolower($_POST["email"]);
    $password            = $_POST['password'];
    $password_confirm    = $_POST['password_confirm'];
    $emailError          = "";
    $passwordError       = "";
    $passwordConfirmError = "";
    $user_name_Error = "";
    // Check file size

    if (!preg_match("/^[a-zA-Z-' ]*$/", $user_name)) {
        $user_name_Error = "Only letters and white space allowed";
        $check = 0;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = ("$email is not a valid email address");
        $check = 0;
    }

    if ($user_name == "") {
        $check = 0;
        $user_name_Error = "The user_name shouldn't be empty!";
    }
    if ($email == "") {
        $check = 0;
        $emailError = "The email shouldn't be empty!";
    }
    if ($password != $password_confirm) {
        $passwordConfirmError = "passwords should be the same";
        $check = 0;
    }
    if ($password_confirm == "") {
        $passwordConfirmError = "passwords should be the same";
        $check = 0;
    }
    if ($password == "") {
        $passwordError = "cant be empty";
        $check = 0;
    }
    if ($check == 1) {
        $check_exist = "SELECT * FROM users WHERE user_email = '$email' ORDER BY user_id DESC";
        $result = mysqli_query($conn, $check_exist);
        $data = mysqli_fetch_array($result, MYSQLI_NUM);
        if ($data[0] > 1) {
            $emailError = "User Already exist go to sign in";
        } else {
            $check_exist2 = "SELECT * FROM users  ORDER BY user_id DESC";
            $result2 = mysqli_query($conn, $check_exist2);
            $data2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
            $NEW_USER_ID = $data2[0]["user_id"];
            $_SESSION["type"] = 0;
            $_SESSION["user_id"] = $NEW_USER_ID;
            $sql = "INSERT INTO `users`( `user_name`, `user_email`, `user_password`) VALUES ('$user_name','$email','$password')";
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            $conn->close();
            redirect("index.php");
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>SignUP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/signing_style.css">
</head>

<body>

    <div class="wrapper" style="background-image: url('images/bg-registration-form-1.jpg');">
        <div class="inner">
            <div class="image-holder">
                <img loading="lazy" src="https://cdn.discordapp.com/attachments/914883219546058815/917071612061319290/registration-form-1.jpg" alt="">
            </div>
            <form id="signup_form" method="POST" enctype="multipart/form-data">
                <h3>Register Now</h3>
                <div class="form-wrapper">
                    <input type="text" placeholder="Username" class="form-control" id="signup_input_username" name="user_name" required autofocus>
                    <i class="zmdi zmdi-account"></i>
                    <div style="color: red;font-weight:bold;" id="username_help"><?php echo @$user_name_Error ?></div>
                </div>
                <div class="form-wrapper">
                    <input type="text" placeholder="Email Address" class="form-control" id="signUp_email_input" name="email" style="text-transform:lowercase">
                    <i class="zmdi zmdi-email"></i>
                    <div style="color: red;font-weight:bold;" id="emailHelp"><?php echo @$emailError ?></div>
                </div>
                <div class="form-wrapper">
                    <input type="password" placeholder="Password" class="form-control" id="signUP_pass_input" name="password">
                    <i class="zmdi zmdi-lock"></i>
                    <div style="color: red;font-weight:bold;" id="passHelp"><?php echo @$passwordError ?></div>
                </div>
                <div class="form-wrapper">
                    <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirm" id="signUP_pass2_input">
                    <i class="zmdi zmdi-lock"></i>
                    <div style="color: red;font-weight:bold;" id="pass2Help"><?php echo @$passwordConfirmError ?></div>
                </div>
                <div class="form-wrapper">
                    <!-- <input name="image" type="file" class="form-control" required> -->
                    <!-- <div style="color: red;font-weight:bold;" id="image"><?php echo @$imageError ?></div> -->


                </div>
                <button id="signUp_insignup_btn" type="submit" name="btn">Register
                    <i class="zmdi zmdi-arrow-right"></i>
                </button>
                <div class="dont">
                    <span class="dont">Already have an account? <a class="ms-1 regster-href" href="sign_in.php">Login</a></span>
                </div>
            </form>
        </div>
    </div>
</body>
<!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>