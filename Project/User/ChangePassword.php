<?php
include("../Assets/Connection/Connection.php");
include("Head.php");
session_start();

if (isset($_POST['btnsubmit'])) {
    $old = $_POST['txtold'];
    $new = $_POST['txtnew'];
    $re = $_POST['txtre'];
    $selQry = "SELECT * FROM tbl_user WHERE user_id=" . $_SESSION['uid'];
    $result = $con->query($selQry);
    $data = $result->fetch_assoc();
    
    if ($data['user_password'] == $old) {
        if ($new == $re) {
            $upQry = "UPDATE tbl_user SET user_password='$new' WHERE user_id='" . $_SESSION['uid'] . "'";
            if ($con->query($upQry)) {
                echo "<script>window.location='MyProfile.php';</script>";
            } else {
                echo "error ";
            }
        } else {
            echo "<script>alert('New password and retype password do not match');</script>";
        }
    } else {
        echo "<script>alert('Not current password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Change Your Password</h2>
    <form action="" method="POST">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="txtold" class="form-label">Old Password</label>
                    <input name="txtold" type="password" class="form-control" id="txtold" placeholder="Enter old password" required />
                </div>
                <div class="mb-3">
                    <label for="txtnew" class="form-label">New Password</label>
                    <input name="txtnew" type="password" class="form-control" id="txtnew" placeholder="Enter new password" required />
                </div>
                <div class="mb-3">
                    <label for="txtre" class="form-label">Re-Type Password</label>
                    <input name="txtre" type="password" class="form-control" id="txtre" placeholder="Enter retype password" required />
                </div>
                <div class="d-flex justify-content-between">
                    <input name="btnsubmit" type="submit" class="btn btn-primary" value="Change Password" />
                    <input name="btncancel" type="button" class="btn btn-secondary" value="Cancel" />
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>
