<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Head.php");

if (isset($_POST['btnsubmit'])) {
    $old = $_POST['txtold'];
    $new = $_POST['txtnew'];
    $re = $_POST['txtre'];
    $selQry = "SELECT * FROM tbl_del_agent WHERE del_id = " . $_SESSION['did'];
    $result = $con->query($selQry);
    $data = $result->fetch_assoc();

    if ($data['del_password'] == $old) {
        if ($new == $re) {
            $upQry = "UPDATE tbl_del_agent SET del_password = '$new' WHERE del_id = '" . $_SESSION['did'] . "'";
            if ($con->query($upQry)) {
                ?>
                <script>
                    window.location = "MyProfile.php";
                </script>
                <?php
            } else {
                echo "Error updating password.";
            }
        } else {
            ?>
            <script>
                alert('New password and retype password do not match!');
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert('Incorrect current password!');
        </script>
        <?php
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Change Password</h2>
    <form action="" method="POST">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow p-4">
                    <div class="form-group mb-3">
                        <label for="txtold">Old Password</label>
                        <input type="password" class="form-control" name="txtold" placeholder="Enter old password" required />
                    </div>
                    <div class="form-group mb-3">
                        <label for="txtnew">New Password</label>
                        <input type="password" class="form-control" name="txtnew" placeholder="Enter new password" required />
                    </div>
                    <div class="form-group mb-3">
                        <label for="txtre">Re-Type Password</label>
                        <input type="password" class="form-control" name="txtre" placeholder="Re-enter new password" required />
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="btnsubmit" class="btn btn-primary">Change Password</button>
                        <button type="button" name="btncancel" class="btn btn-secondary" onclick="window.location.href='MyProfile.php'">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
include("Foot.php");
?>
