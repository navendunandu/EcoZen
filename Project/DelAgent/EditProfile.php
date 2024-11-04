<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Head.php");

if (isset($_POST['btnsubmit'])) {
    $name = $_POST['txtname'];
    $email = $_POST['txtemail'];
    $contact = $_POST['txtcontact'];

    $upQry = "UPDATE tbl_del_agent SET del_name='$name', del_email='$email', del_contact='$contact' WHERE del_id='" . $_SESSION['did'] . "'";
    
    if ($con->query($upQry) === TRUE) {
        header("Location: MyProfile.php");
        exit;
    } else {
        echo "Error updating record: " . $con->error;
    }
}

$selDel = "SELECT * FROM tbl_del_agent a 
           INNER JOIN tbl_place p ON a.place_id = p.place_id 
           INNER JOIN tbl_district d ON d.district_id = p.district_id 
           WHERE a.del_id = '" . $_SESSION['did'] . "'";

$del = $con->query($selDel);
$DelData = $del->fetch_assoc();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Profile</h2>
    <form action="" method="POST">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow p-4">
                    <div class="form-group mb-3">
                        <label for="txtname">Name</label>
                        <input type="text" class="form-control" name="txtname" value="<?php echo $DelData['del_name']; ?>" required />
                    </div>
                    <div class="form-group mb-3">
                        <label for="txtemail">Email</label>
                        <input type="email" class="form-control" name="txtemail" value="<?php echo $DelData['del_email']; ?>" required />
                    </div>
                    <div class="form-group mb-3">
                        <label for="txtcontact">Contact</label>
                        <input type="text" class="form-control" name="txtcontact" value="<?php echo $DelData['del_contact']; ?>" required />
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="btnsubmit" class="btn btn-primary">Update</button>
                        <a href="MyProfile.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
include("Foot.php");
?>
