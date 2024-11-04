<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Head.php");

$sname = $_SESSION['sname'];
$sellerid = $_SESSION['sid'];
$selSeller = "SELECT * FROM tbl_seller WHERE seller_id = ".$sellerid;
$resSeller = $con->query($selSeller);
$data = $resSeller->fetch_assoc();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">My Profile</h2>
    <form id="form1" name="form1" method="POST" action="">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <td colspan="2" align="center">
                        <img src="../Assets/Files/NewUser/<?php echo $data['seller_image'];?>" width="200" height="200" class="img-thumbnail" alt="Profile Image">
                    </td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?php echo $data['seller_name'];?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $data['seller_email'];?></td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td><?php echo $data['seller_contact'];?></td>
                </tr>
                
                <?php
                $selQry = "SELECT * FROM tbl_seller s 
                            INNER JOIN tbl_place p ON s.place_id = p.place_id 
                            INNER JOIN tbl_district d ON p.district_id = d.district_id 
                            WHERE s.seller_id = ".$sellerid;
                $result = $con->query($selQry);
                $placeData = $result->fetch_assoc();
                ?>
                <tr>
                    <td>District</td>
                    <td><?php echo $placeData['district_name'];?></td>
                </tr>
                <tr>
                    <td>Place</td>
                    <td><?php echo $placeData['place_name'];?></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <a href="Editprofile.php" class="btn btn-primary">Edit Profile</a>
                        <a href="Changepassword.php" class="btn btn-secondary">Change Password</a>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>

<?php
include("Foot.php");
?>
