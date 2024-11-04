<?php
include("../Assets/Connection/Connection.php");
session_start();
include("Head.php");

$dname = $_SESSION['dname'];
$delid = $_SESSION['did'];

// Fetch delivery agent's data
$selDel = "SELECT * FROM tbl_del_agent WHERE del_id = $delid";
$resDel = $con->query($selDel);
$data = $resDel->fetch_assoc();

// Fetch place and district details
$selQry = "SELECT * FROM tbl_del_agent s
           INNER JOIN tbl_place p ON s.place_id = p.place_id
           INNER JOIN tbl_district d ON p.district_id = d.district_id
           WHERE s.del_id = $delid";
$result = $con->query($selQry);
$placeData = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Agent Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">My Profile</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow p-4">
                <!-- Profile Image -->
                <div class="text-center mb-4">
                    <img src="../Assets/Files/DelAgent/<?php echo $data['del_image']; ?>" class="img-thumbnail" width="200" height="200">
                </div>

                <!-- Profile Details -->
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td><?php echo $data['del_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $data['del_email']; ?></td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td><?php echo $data['del_contact']; ?></td>
                    </tr>
                    <tr>
                        <th>District</th>
                        <td><?php echo $placeData['district_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Place</th>
                        <td><?php echo $placeData['place_name']; ?></td>
                    </tr>
                </table>

                <!-- Edit and Change Password Links -->
                <div class="text-center mt-3">
                    <a href="Editprofile.php" class="btn btn-primary">Edit Profile</a>
                    <a href="Changepassword.php" class="btn btn-secondary">Change Password</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (Optional for additional Bootstrap functionalities) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
include("Foot.php");
?>