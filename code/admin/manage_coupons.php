<?php
ob_start();
include "./includes/header.php";

if (!isset($_SESSION["type"]) || $_SESSION["type"] == 0) {
    redirect('../index.php');
}

// select all comments
$sql = "SELECT * FROM coupons";
$result = mysqli_query($conn, $sql);
$coupons = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_GET["do"])) {
    $do = $_GET["do"];
    // to Show previous values in edit
    if ($do == "edit") {
        $id = $_GET["id"];
        $sql = "SELECT * FROM coupons WHERE coupon_id =$id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
    }
    // delete
    if ($do == "delete") {
        $id = $_GET["id"];
        $sql = "DELETE FROM coupons WHERE coupon_id = '$id'";
        $result = mysqli_query($conn, $sql);
        redirect("manage_coupons.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $coupon_text = $_POST["coupon_text"];
        $coupon_percent = $_POST["coupon_percent"];
        $coupon_status = $_POST['status'];

        $check = 1;
        if ($coupon_text == "") {
            $check = 0;
            $couponError = "The coupon text shouldn't be empty!";
        }
        if ($coupon_percent == "") {
            $checkok = 0;
            $couponPercentError = "The coupon percent shouldn't be empty!";
        }
    }
    //edit
    if ($do == "edit" && @$check == 1) {
        $id = $_GET["id"];
        $sql = "UPDATE coupons SET coupon_text = '$coupon_text', coupon_percent = '$coupon_percent', coupon_status = '$coupon_status' WHERE coupon_id = $id";
        $result = mysqli_query($conn, $sql);
        redirect("manage_coupons.php");
    }
    //add
    if ($do == "add" && @$check == 1) {
        $sql = "INSERT INTO coupons (coupon_text, coupon_percent,coupon_status) VALUES ('$coupon_text', '$coupon_percent','$coupon_status')";
        $result = mysqli_query($conn, $sql);
        redirect("manage_coupons.php");
    }

?>
    <!-- start form -->
    <div class="col-md-5 offset-3 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Manage coupons</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" method="POST" enctype="multipart/form-data">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Coupon</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative row justify-content-center align-items-center d-flex">
                                            <input name="coupon_text" value="<?php echo $do == "edit" ? $row["coupon_text"] : ""; ?>" type="text" class="form-control col-9 mb-2" placeholder="coupon text" style="border: 1px solid #dce7f1 !important;" id="first-name-icon">
                                            <div class="form-control-icon col-3 ">
                                                <i class="bi bi-person" style="position: absolute; top:-10px; left: -20px;"></i>
                                            </div>
                                            <span class="text-danger mb-2"><?php echo isset($couponError) ? $couponError : ""; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Percent of Sale</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative row justify-content-center align-items-center d-flex">
                                            <input name="coupon_percent" value="<?php echo $do == "edit" ? $row["coupon_percent"] : ""; ?>" type="number" class="form-control col-9 mb-2" placeholder="percent of sale" style="border: 1px solid #dce7f1 !important;" id="first-name-icon">
                                            <div class="form-control-icon col-3 ">
                                                <i class="bi bi-person" style="position: absolute; top:-10px; left: -20px;"></i>
                                            </div>
                                            <span class="text-danger mb-2"><?php echo isset($couponPercentError) ? $couponPercentError : ""; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Status</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative row justify-content-center align-items-center d-flex">
                                            <select name="status">
                                                <option value="active">enable</option>
                                                <option value="disable">disable</option>
                                            </select>
                                            <div class="form-control-icon col-3 ">
                                            </div>
                                            <span class="text-danger mb-2"><?php echo isset($couponPercentError) ? $couponPercentError : ""; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1"><?php echo $_GET["do"] == "edit" ? "Save" : "Add"; ?></button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end form -->
<?php
}
?>

<!-- start table -->
<?php if (!isset($_GET["do"])) { ?>
    <div class="row">
        <div class="offset-2 col-lg-9">
            <div class="users-table table-wrapper">
                <button class="btn btn-primary" style="float: right;margin:10px 50px 0px 10px;">
                    <a href="?do=add">Add Coupon </a>
                </button>
                <table class="table table-striped" style="border: 2px solid #dce7f1 ;" id="table1">
                    <thead>
                        <tr class="users-table-info">
                            <th>Coupon</th>
                            <th>Percent of sale</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($coupons as $key => $value) { ?>
                            <tr>
                                <td>
                                    <?php echo $value["coupon_text"] ?>
                                </td>
                                <td>
                                    <?php echo $value["coupon_percent"] ?>
                                </td>
                                <td>
                                    <?php echo $value["coupon_status"] ?>
                                </td>
                                <td>
                                    <a href="?do=edit&id=<?php echo $value["coupon_id"] ?>" class="btn btn-success">Edit</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php } ?>
<!-- end table -->

<?php include "./includes/footer.php";
ob_end_flush(); ?>