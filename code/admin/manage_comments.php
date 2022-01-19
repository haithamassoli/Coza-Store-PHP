<?php include "./includes/header.php";

if (!isset($_SESSION["type"]) || $_SESSION["type"] == 0) {
  redirect('../index.php');
}
// select all comments
$sql = "SELECT comments.*, products.product_name, users.user_name, users.user_image FROM comments INNER JOIN products ON products.product_id = comments.comment_product_id INNER JOIN users ON users.user_id = comments.comment_user_id";
$result = mysqli_query($conn, $sql);
$comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_GET["do"])) {
  $do = $_GET["do"];
  $id = $_GET["id"];
  // delete
  if ($do == "delete") {
    $sql = "DELETE FROM comments WHERE comment_id = '$id'";
    $result = mysqli_query($conn, $sql);
  }
} ?>

<!-- start table -->
<div class="row">
  <div class="offset-2 col-lg-9">
    <div class="users-table table-wrapper">
      <table class="table table-striped" style="border: 2px solid #dce7f1 ;" id="table1">
        <thead>
          <tr class="users-table-info">
            <th>User</th>
            <th>Comment</th>
            <th>image</th>
            <th>date created</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($comments as $key => $value) { ?>
            <tr>
              <td>
                <img src="<?php echo  $value["user_image"] ?>" alt=""> <?php echo $value["user_name"] ?>
              </td>
              <td>
                <?php echo $value["comment"] ?>
              </td>
              <td>
                <?php if ($value["comment_image"] != NULL) { ?>
                  <img src="<?php echo $value["comment_image"] ?>">
                <?php } else {
                  echo "No image";
                } ?>
              </td>
              <td><?php echo $value["comment_date"] ?></td>
              <td>
                <span class="p-relative">
                  <button class="dropdown-btn transparent-btn" type="button" title="More info">
                    <div class="sr-only">More info</div>
                    <i data-feather="more-horizontal" aria-hidden="true"></i>
                  </button>
                  <ul class="users-item-dropdown dropdown">
                    <li><a href="?do=delete&id=<?php echo $value["comment_id"] ?>">Trash</a></li>
                  </ul>
                </span>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- end table -->

<?php include "./includes/footer.php"; ?>