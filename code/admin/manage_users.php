<?php include "./includes/header.php";

if (!isset($_SESSION["type"]) || $_SESSION["type"] != 2) {
  redirect('../index.php');
}
?>

<?php
// function redirect($url)
// {
//   if (!headers_sent()) {
//     header('Location: ' . $url);
//     exit;
//   } else {
//     echo '<script type="text/javascript">';
//     echo 'window.location.href="' . $url . '";';
//     echo '</script>';
//     echo '<noscript>';
//     echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
//     echo '</noscript>';
//     exit;
//   }
// }

$sql = "SELECT * FROM users ";
$result = mysqli_query($conn, $sql);
$users  = mysqli_fetch_all($result, MYSQLI_ASSOC);
//delete
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $delete = "DELETE FROM users WHERE user_id = $id";
  $result = mysqli_query($conn, $delete);
  if (mysqli_query($conn, $delete)) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . mysqli_error($conn);
  }
  redirect("manage_users.php");
}
// add and edit 
if (isset($_GET['do'])) {
  $do = $_GET["do"];
  if ($do == "edit") {
    $id = $_GET["id"];
    $sql = "SELECT * FROM users WHERE user_id =$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    // print_r($row);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $check = 1;
      $image = ($_FILES["user_image"]);
      $name = ($_POST["user_name"]);
      $email = strtolower($_POST["user_email"]);
      $password = ($_POST["user_password"]);
      $gender = ($_POST["user_gender"]);
      //  input validation 
      // name validation 
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

      if ($password == "") {
        $check = 0;
        $passError = "The password shouldn't be empty!";
      }

      if ($gender == "") {
        $check = 0;
        $genderError = "The gender shouldn't be empty!";
      }

      $image_folder = "uploads/user_image/";
      $target_file = $image_folder . uniqid() . basename($image["name"]);
      move_uploaded_file($image["tmp_name"], $target_file);
      if ($check == 1) {
        $sql2 = "UPDATE users  SET user_name = '$name', user_email ='$email', user_password='$password', user_gender='$gender' ,user_image=' $target_file' WHERE user_id = '$id'";
        if ($conn->query($sql2) === TRUE) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
        $conn->close();
        redirect("manage_users.php");
      }
    }
    ################################ 

  } else if ($do == "add") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $check = 1;
      $image = ($_FILES["user_image"]);
      $name = ($_POST["user_name"]);
      $email = strtolower($_POST["user_email"]);
      $password = ($_POST["user_password"]);
      $gender = ($_POST["user_gender"]);
      //  input validation 
      // name validation 
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

      if ($password == "") {
        $check = 0;
        $passError = "The password shouldn't be empty!";
      }

      if ($gender == "") {
        $check = 0;
        $genderError = "The gender shouldn't be empty!";
      }

      $image_folder = "uploads/user_image/";
      $target_file = $image_folder . uniqid() . basename($image["name"]);
      move_uploaded_file($image["tmp_name"], $target_file);
      if ($check == 1) {
        $sql = "INSERT INTO `users` (`user_name`,`user_email`,`user_password`, `user_gender`,`user_image`) 
                            VALUES ('$name','$email','$password','$gender','$target_file')";
        if (mysqli_query($conn, $sql)) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $conn->close();
        redirect("manage_users.php");
      }
    }
  }
?>
  <div class="col-md-8 mt-5 col-12 offset-md-2">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Manage Users</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <form class="form form-horizontal" method="POST" enctype="multipart/form-data">
            <div class="form-body">
              <div class="row">
                <!-- <div class="col-md-4">
                  <label>Image</label>
                </div>
                <div class="col-md-8">
                  <div class="form-group has-icon-left">
                    <div class="position-relative row justify-content-center align-items-center d-flex">
                      <input type="file" name="user_image" class="form-control col-9 mb-2" placeholder="image" style="border: 1px solid #dce7f1 !important;" id="first-name-icon">
                      <div class="form-control-icon col-3 ">
                      </div>
                    </div>
                  </div>
                </div> -->
                <div class="col-md-4">
                  <label>Name</label>
                </div>
                <div class="col-md-8">
                  <div class="form-group has-icon-left">
                    <div class="position-relative row justify-content-center align-items-center d-flex">
                      <input type="text" name="user_name" class="form-control col-9 mb-2" placeholder="Name" style="border: 1px solid #dce7f1 !important;" id="first-name-icon"    value="<?php if ($do == "edit") {
                                                                                                                                                                                                                    echo $row['user_name'];
                                                                                                                                                                                                                  } ?>"   >
                      <div class="form-control-icon col-3 ">
                        <i class="bi bi-person" style="position: absolute; top:-10px; left: -20px;"></i>
                      </div>
                      <div style="color:red"><?php echo @$nameError;  ?></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <label>Email</label>
                </div>
                <div class="col-md-8">
                  <div class="form-group has-icon-left">
                    <div class="position-relative row justify-content-center align-items-center d-flex">
                      <input type="email" name="user_email" class="form-control col-9 mb-2" placeholder="Email" style="border: 1px solid #dce7f1 !important;" id="first-name-icon"    value="<?php if ($do == "edit") {
                                                                                                                                                                                                                          echo $row['user_email'];
                                                                                                                                                                                                                        } ?>">
                      <div class="form-control-icon col-3">
                        <i class="bi bi-envelope" style="position: absolute; top:-10px; left: -20px;"></i>
                      </div>
                      <div style="color:red"><?php echo @$emailError;  ?></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <label>Password</label>
                </div>
                <div class="col-md-8">
                  <div class="form-group has-icon-left">
                    <div class="position-relative row justify-content-center align-items-center d-flex">
                      <input type="password" name="user_password" class="form-control col-9 mb-2" placeholder="Password" style="border: 1px solid #dce7f1 !important;"   value="<?php if ($do == "edit") {
                                                                                                                                                                                                          echo $row['user_password'];
                                                                                                                                                                                                        } ?>">
                      <div class="form-control-icon col-3">
                        <i class="bi bi-lock" style="position: absolute; top:-10px; left: -20px;"></i>
                      </div>
                      <div style="color:red"><?php echo @$passError;  ?></div>
                    </div>
                  </div>
                </div>


                <div class="col-md-4">
                  <label>Gender</label>
                </div>
                <div class="col-md-8">
                  <div class="form-group has-icon-left">
                    <div class="position-relative row justify-content-center align-items-center d-flex">
                      <select name="user_gender" class="form-control col-9 mb-2" style="border: 1px solid #dce7f1 !important;" >
                    
                        <option>Male</option>
                        <option>Female </option>
                      </select>
                      <div class="form-control-icon col-3">
                      </div>
                      <div style="color:red"><?php echo @$genderError;  ?></div>
                    </div>
                  </div>
                </div>
                <div class="form-group col-md-8 offset-md-4">
                  <div class='form-check'>
                    <div class="checkbox">
                      <input type="checkbox" id="checkbox2" class='form-check-input' checked>
                      <label for="checkbox2">Remember Me</label>
                    </div>
                  </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                  <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
}
$conn->close();
?>



<?php
if (!isset($_GET['do'])) { ?>
  <main class="main users chart-page" id="skip-target">
    <div class="container">

      <!-- start table -->

      <div class="row">
        <div class="col-lg-12">
          <div class="users-table table-wrapper">
            <table class="table table-striped" id="table1">

              <button class="btn btn-primary" style="float: right;margin:10px 50px 0px 10px;">
                <a href="manage_users.php?do=add">Add user </a>
              </button>
              <thead>
                <tr class="users-table-info">
                  <!-- <th>
                    <label class="users-table__checkbox ms-20">
                      <input type="checkbox" class="check-all">User Image
                    </label>
                  </th> -->
                  <th>User Name</th>
                  <th>User Email</th>
                  <th>User Password</th>
                  <th>User Gender</th>
                  <th>User Creation Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($users as $key => $user) { ?>
                  <tr>
                  <!-- <td class="px-6 py-4">
                      <div class="text-sm text-gray-900 flex justify-center items-center">
                        <img src="<?php echo  $user['user_image']  ?>" class="mr-3" width="50px" alt="">
                        <?php echo $user["user_name"]; ?>
                      </div>
                    </td> -->
                    <td><?php echo isset($user['user_name']) ? $user['user_name'] : ''; ?></td>
                    <td><?php echo isset($user['user_email']) ? $user['user_email'] : ''; ?></td>
                    <td><?php echo isset($user['user_password']) ? $user['user_password'] : ''; ?></td>
                    <td><?php echo isset($user['user_gender']) ? $user['user_gender'] : ''; ?></td>
                    <td><?php echo isset($user['user_creation_date']) ? $user['user_creation_date'] : ''; ?></td>
                    <td>
                      <div class="table-data-feature">
                        <button class="btn btn-success" title="edit">
                          <a href="manage_users.php?do=edit&id=<?php echo $user['user_id'] ?>"> edit </a>
                        </button>
                        <button class="btn btn-danger" title="delete">
                          <a href="manage_users.php?delete=<?php echo $user['user_id'] ?>"> delete </a>
                        </button>
                      </div>
                    </td>
                  </tr>
                <?php } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
<?php } ?>


<!-- end table -->
<?php include "./includes/footer.php"; ?>