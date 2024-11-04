<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");

if (isset($_POST['btn_submit'])) {
    $uid = $_SESSION['uid'];
    $pid = $_GET['pid'];
    $title = $_POST['txt_title'];
    $des = $_POST['txt_des'];
    $file = $_FILES['file_photo']['name'];
    $tempfile = $_FILES['file_photo']['tmp_name'];
    move_uploaded_file($tempfile, '../Assets/Files/Complaints/' . $file);

    $insQry = "INSERT INTO tbl_complaint (complaint_title, complaint_des, complaint_date, user_id, product_id, complaint_file) 
               VALUES ('$title', '$des', CURDATE(), '$uid', '$pid', '$file')";
    if ($con->query($insQry)) {
        ?>
        <script>
        alert("Complaint posted");
        window.location = "PostComplaint.php";
        </script>
        <?php
    } else {
        echo "Error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Complaint</title>
    <!-- Bootstrap CSS is included in Head.php -->
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Post a Complaint</h2>
    <form id="form1" name="form1" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="txt_title">Title</label>
            <input type="text" name="txt_title" id="txt_title" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="txt_des">Description</label>
            <textarea name="txt_des" id="txt_des" rows="5" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="file_photo">File</label>
            <input name="file_photo" type="file" class="form-control-file" />
        </div>
        <div class="form-group text-center">
            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-primary" />
        </div>
    </form>
</div>

</body>
</html>

<?php
include("Foot.php");
ob_flush();
?>
