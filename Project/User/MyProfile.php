<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
 $uname=$_SESSION['uname'];
 $userid=$_SESSION['uid'];
 $SelUser="select * from tbl_user where user_id=".$userid;
 $resUser=$con->query($SelUser);
$data=$resUser->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
                    <!-- <img src="../Assets/Files/DelAgent/<?php echo $data['del_image']; ?>" class="img-thumbnail" width="200" height="200"> -->
                </div>

     <body>
     <form id="form1" name="form1" method="POST" action="">
    <table width="200" border="1" align="center">
    <tr>
    <td colspan="2" align="center"><img src="../Assets/Files/User/<?php echo $data['user_image'];?>" width="200" height="200"></td>
    <tr>
    <td width="48">Name</td>
    <td width="136"><?php echo $data['user_name'];?></td>
    </tr>
    <tr>
    <td>Email</td>
    <td><?php echo $data['user_email'];?></td>
    </tr>
    <tr>
    <td>Contact</td>
    <td><?php echo $data['user_contact'];?></td>
    </tr>
  
     <?php
  $selQry="select * from tbl_user n  inner join  tbl_place p on n.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id";
  $result=($con->query($selQry));
  $data=$result->fetch_assoc()
 ?>
  <tr>
    <td>District</td>
    <td><?php echo $data['district_name'];?></td>
  </tr>
  <tr>
    <td>Place</td>
    <td><?php echo $data['place_name'];?></td>
  </tr>
  </table>
  
  <div class="text-center mt-3">
   <a href="Editprofile.php" class="btn btn-primary">Edit Profile</a>
  <a href="Changepassword.php" class="btn btn-secondary">Change Password</a>
  </div>

</form>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?> 