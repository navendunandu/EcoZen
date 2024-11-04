<?php
include("../Assets/Connection/Connection.php");
include("Head.php");
session_start();
if(isset($_POST['btnsubmit']))
{
$name=$_POST['txtname'];
$email=$_POST['txtemail'];
$contact=$_POST['txtcontact'];
$upQry="UPDATE tbl_user SET user_name='$name',user_email='$email',user_contact='$contact' where user_id='".$_SESSION['uid']."'";
if($con->query($upQry)===TRUE)
{
	header("Location:MyProfile.php");
	exit;
}
else
{
	echo "error updating record" .$con->error;
}
}
 $seluser="select * from tbl_user n inner join tbl_place p on n.place_id=p.place_id inner join tbl_district d on d.district_id=p.district_id where n.user_id='".$_SESSION['uid']."'";

$user=$con->query($seluser);
$userdata=$user-> fetch_assoc();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<h2 align="center">Edit your profile</h2>
<body>
<form action="" method="POST">
<table width="200" border="1"align="center">
  <tr>
    <td>Name</td>
    <td><label for="txtname"></label><input type="text" name="txtname" value="<?php echo $userdata['user_name'];?>"/></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><input type="text" name="txtemail" value="<?php echo $userdata['user_email'];?>"/></td>
  </tr>
  <tr>
    <td>Contact</td>
    <td><input type="text" name="txtcontact" value="<?php echo $userdata['user_contact'];?>"/></td>
  </tr>
  <tr>
  <td colspan="2" align="center"><input name="btnsubmit" type="submit" value="Edit" /></td>
  </tr>
</table>
</form>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>