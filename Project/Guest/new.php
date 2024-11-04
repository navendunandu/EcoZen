<?php
include("../Assets/Connection/connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';
if(isset($_POST['btn_register']))
{
	$name=$_POST['txt_name'];
	$email=$_POST['txt_email'];
	$contact=$_POST['txt_contact'];
	
	$place=$_POST['sel_place'];
	$photo=$_FILES['file_photo']['name'];
	$tempphoto=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($tempphoto,'../Assets/Files/NewUser/'.$photo);

	$password=$_POST['txt_password'];

	
	$selUser="select * from tbl_user where user_email='".$email."'";
	$selAdmin="select * from tbl_admin where admin_email='".$email."'";
	$selSel="select * from tbl_seller where seller_email='".$email."'";
	$resUser=$con->query($selUser);
	$resAdmin=$con->query($selAdmin);
	$resSel=$con->query($selSel);
	
	if($resUser->num_rows>0 || $resAdmin->num_rows>0 || $resSel->num_rows>0){
		?>
		  <script>
		    alert("Email Already Exists");
		  </script>
		  <?php	
	}
	else{
	 $insQry= "insert into tbl_user(user_name,user_email,user_contact,place_id,user_image,user_password) values('$name','$email','$contact','$place','$photo','$password')";
	 if($con->query($insQry))
	 {
     $mail = new PHPMailer(true);

     $mail->isSMTP();
     $mail->Host = 'smtp.gmail.com';
     $mail->SMTPAuth = true;
     $mail->Username = 'ecozenfresh2024@gmail.com'; // Your gmail
     $mail->Password = 'ptut zbgr wlyf stxf'; // Your gmail app password
     $mail->SMTPSecure = 'ssl';
     $mail->Port = 465;
   
     $mail->setFrom('ecozenfresh2024@gmail.com'); // Your gmail
   
     $mail->addAddress($email);
   
     $mail->isHTML(true);
   
     $mail->Subject = "Greetings ";  //Your Subject goes here
     $mail->Body = "Welcome to Ecozen Fresh"; //Mail Body goes here
   if($mail->send())
   {
     ?>
 <script>
     alert("Email Send")
 </script>
     <?php
   }
   else
   {
     ?>
 <script>
     alert("Something went wrong")
 </script>
     <?php
   }
	 }
	 else
	 {
		echo "Error"; 
	 }
 }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="295" border="1">
    <tr>
      <td width="166">Name</td>
      <td width="113"><label for="txt_name"></label>
      <input required type="text" name="txt_name" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" id="txt_name" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="email" required name="txt_email" id="txt_email" /></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txt_contact"></label>
      <input type="text" required name="txt_contact" pattern="[7-9]{1}[0-9]{9}" 
                title="Phone number with 6-9 and remaing 9 digit with 0-9" id="txt_contact" /></td>
    </tr>
    
    <tr>
      <td>District</td>
      <td><label for="sel_district"></label>
        <select required name="sel_district" id="sel_district"  onchange="getPlace(this.value)"+>
        <option>--Select--</option>
          <?php 
		  $selQry=" select * from tbl_district ";
		  $row=$con->query($selQry);
		  while($data=$row->fetch_assoc())
		  {
		  ?>
		  <option value="<?php echo $data['district_id'] ?>"><?php echo $data['district_name'] ; ?></option>
          <?php
		  }
		  ?>
      </select></td>
    </tr>
   <tr>
    <td>Place</td>
    <td>
    <select name="sel_place" id="sel_place" onchange="getLocation(this.value)">
    </select>
	</td>

    
  </tr>
    <tr>
    <td>Location</td>
    <td>
    <select name="sel_location" id="sel_location">
    </select>
	</td>
  </tr>
    <tr>
      <td>Photo</td>
      <td><label for="file_photo"></label>
      <input type="file" name="file_photo" id="file_photo" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="password" required name="txt_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" id="txt_password" /></td>
    </tr>
    <tr>
      <td>Confirm Password</td>
      <td><label for="txt_cpassword"></label>
      <input type="text"  name="txt_cpassword"  /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_register" id="btn_register" value="register" /></td>
    </tr>
  </table>
</form>
</body>
<script src ="../Assets/JQ/jQuery.js"></script>
<script>
function getPlace(cid){
   $.ajax({
	   url:"../Assets/AjaxPages/Ajaxplace.php?cid=" + cid,
	   success:function(result){
		   $("#sel_place").html(result);
	   }
   });
   }
   
function getLocation(lid){
	  $.ajax({
	   url:"../Assets/AjaxPages/AjaxLocation.php?lid=" + lid,
	   success:function(result){
		   $("#sel_location").html(result);
	   }
   });
   }
   </script>
</html>
		   


	