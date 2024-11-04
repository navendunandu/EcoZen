<?php
include("../Assets/Connection/Connection.php");
include("Head.php");
// session_start();

if (isset($_POST['btnsubmit'])) {
    $old = $_POST['txtold'];
    $new = $_POST['txtnew'];
    $re = $_POST['txtre'];

    $selQry = "SELECT * FROM tbl_seller WHERE seller_id=" . $_SESSION['sid'];
    $result = $con->query($selQry);
    $data = $result->fetch_assoc();

    if ($data['seller_password'] == $old) {
        if ($new == $re) {
            $upQry = "UPDATE tbl_seller SET seller_password='$new' WHERE seller_id='" . $_SESSION['sid'] . "'";
            if ($con->query($upQry)) {
                echo "<script>window.location='MyProfile.php';</script>";
            } else {
                echo "Error: " . $con->error;
            }
        } else {
            echo "<script>alert('New password and retype password do not match');</script>";
        }
    } else {
        echo "<script>alert('Incorrect current password');</script>";
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Change Password</h2>
    <form action="" method="POST" class="mx-auto" style="max-width: 500px;">
        <div class="mb-3">
            <label for="oldPassword" class="form-label">Old Password</label>
            <input name="txtold" type="password" class="form-control" id="oldPassword" placeholder="Enter old password" required>
        </div>
        <div class="mb-3">
            <label for="newPassword" class="form-label">New Password</label>
            <input name="txtnew" type="password" class="form-control" id="newPassword" placeholder="Enter new password" required>
        </div>
        <div class="mb-3">
            <label for="retypePassword" class="form-label">Re-type New Password</label>
            <input name="txtre" type="password" class="form-control" id="retypePassword" placeholder="Re-type new password" required>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" name="btnsubmit" class="btn btn-primary">Change Password</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='MyProfile.php'">Cancel</button>
        </div>
    </form>
</div>

<?php
include("Foot.php");
?>
