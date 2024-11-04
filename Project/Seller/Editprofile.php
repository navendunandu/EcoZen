<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Head.php");

if(isset($_POST['btnsubmit'])) {
    $name = $_POST['txtname'];
    $email = $_POST['txtemail'];
    $contact = $_POST['txtcontact'];
    
    $upQry = "UPDATE tbl_seller SET seller_name='$name', seller_email='$email', seller_contact='$contact' WHERE seller_id='".$_SESSION['sid']."'";
    
    if($con->query($upQry) === TRUE) {
        header("Location: MyProfile.php");
        exit;
    } else {
        echo "Error updating record: " . $con->error;
    }
}

$selSeller = "SELECT * FROM tbl_seller s 
               INNER JOIN tbl_place p ON s.place_id = p.place_id 
               INNER JOIN tbl_district d ON d.district_id = p.district_id 
               WHERE s.seller_id = '".$_SESSION['sid']."'";
$seller = $con->query($selSeller);
$Sellerdata = $seller->fetch_assoc();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Profile</h2>
    <form action="" method="POST">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <td>Name</td>
                    <td>
                        <input type="text" name="txtname" class="form-control" value="<?php echo $Sellerdata['seller_name']; ?>" required />
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="email" name="txtemail" class="form-control" value="<?php echo $Sellerdata['seller_email']; ?>" required />
                    </td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td>
                        <input type="text" name="txtcontact" class="form-control" value="<?php echo $Sellerdata['seller_contact']; ?>" required />
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <input name="btnsubmit" type="submit" value="Edit" class="btn btn-primary" />
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>

<?php
include("Foot.php");
?>
