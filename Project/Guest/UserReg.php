<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';


function welcomeEmail($email, $name){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ecozenfresh2024@gmail.com'; // Your Gmail
    $mail->Password = ''; // Your Gmail app password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('ecozenfresh2024@gmail.com', 'Ecozen Products'); // Your Gmail with sender name

    $mail->addAddress($email);

    $mail->isHTML(true);
    $message = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Welcome to Ecozen Fresh</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 20px; }
        .container { background: #fff; border-radius: 5px; padding: 20px; max-width: 600px; margin: auto; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .header { font-size: 24px; margin-bottom: 20px; color: #e67e22; }
        .footer { font-size: 12px; color: #999; margin-top: 20px; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            Welcome to DryDelights, " . htmlspecialchars($name) . "!
        </div>
        <p>Hi " . htmlspecialchars($name) . ",</p>
        <p>Thank you for joining EcoZen products as a user! We are thrilled to see your purchases from our website</p>
        <p><strong>Important:</strong> Your account is currently under review by our administrator. Once your account has been verified, you'll receive a notification, and you'll be able to log in and start selling.</p>
        <p>Warm regards,<br>DryDelights Team</p>
        <div class='footer'>
            This is an automated message. Please do not reply.
        </div>
    </div>
</body>
</html>
";


    $mail->Subject = "Welcome to EcoZen Fresh!";
    $mail->Body = $message;
  
    if($mail->send()) {
        echo "<script>
                alert('Welcome email sent successfully');
                window.location='Login.php';
              </script>";
    } else {
        echo "<script>
                alert('Email sending failed');
              </script>";
    }
}


if (isset($_POST["btnsubmit"])) {
    $place = $_POST["sel_place"];
    $name = $_POST["txt_name"];
    $gender = $_POST["rdgender"];
    $contact = $_POST["txtcontact"];
    $address=$_POST["txtarea_address"];
    $email = $_POST["txtemail"];
    $password = $_POST["password"];
    $confirm = $_POST["txtconfirm"];
    if($confirm==$password)
    {
           $selUser = "select * from tbl_user where user_email='" . $email . "'";
           $selAdmin = "select * from tbl_admin where admin_email='" . $email . "'";
           $selSeller = "select * from tbl_seller where seller_email='" . $email . "'";
           $selDel = "select * from tbl_del_agent where del_email='" . $email . "'";

           $resUser = $con->query($selUser);
           $resAdmin = $con->query($selAdmin);
           $resSeller = $con->query($selSeller);
           $resDel = $con->query($selDel);

       if ($resAdmin->num_rows > 0 || $resDel->num_rows > 0 || $resSeller->num_rows > 0 || $resUser->num_rows > 0)
        {
           echo "<script>alert('Email already exists. Please use another email address.');</script>";
        } else {   
                 $photo = $_FILES['file_photo']['name'];
                 $tempphoto = $_FILES['file_photo']['tmp_name'];
                 move_uploaded_file($tempphoto, '../Assets/Files/User/' . $photo);

                 $insQry = "INSERT INTO tbl_user(user_name, user_gender, user_contact, user_email, user_password, user_image, place_id,user_address) 
                 VALUES ('$name','$gender','$contact','$email','$password','$photo','$place','$address')";
            
                 if ($con->query($insQry)) 
                  {
                     welcomeEmail($email,$name);
           
                  } else {
                          echo "Error";
                         }
                }
    }
      else{
        ?>
        <script>
            alert('Password and Confirm does not match');
        </script>
        <?php
     
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .form-title {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-check-inline {
            margin-right: 15px;
        }
    </style>
</head>

<body>
</div>
<div class="container">
    <div class="max-height:100px">
        &nbsp;
    </div>
        <div class="form-container">
            <div class="form-title">USER REGISTRATION</div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                                    <label for="txt_name" >Name</label>
                                    <input type="text" class="form-control" name="txt_name" id="txt_name" required pattern="^[A-Z]+[a-zA-Z ]*$" title="Name allows only alphabets, spaces and the first letter must be capital">
                                </div>
                                
                <div class="form-group">
                    <label for="sel_district">District</label>
                    <select name="sel_district" id="sel_district" class="form-control" onchange="getPlace(this.value)" required>
                        <option value="">--- Select District ---</option>
                        <?php
                        $selQry = "SELECT * FROM tbl_district";
                        $result = $con->query($selQry);
                        while ($data = $result->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $data['district_id']; ?>"><?php echo $data['district_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel_place">Place</label>
                    <select name="sel_place" id="sel_place" class="form-control" onchange="getLocation(this.value)" required>
                        <option value="">--- Select Place ---</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sel_location">Location</label>
                    <select name="sel_location" id="sel_location" class="form-control" required>
                        <option value="">--- Select Location ---</option>
                    </select>
                </div>
                <div class="form-group">
                            <label for="txtarea_address">Address</label>
                            <textarea name="txtarea_address" id="txtarea_address" class="form-control" required></textarea>
                        </div>
                <div class="form-group">
                    <label>Gender</label><br>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="rdgender" value="Male" class="form-check-input" required>
                        <label class="form-check-label">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="rdgender" value="Female" class="form-check-input" required>
                        <label class="form-check-label">Female</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtcontact">Contact</label>
                    <input type="text" name="txtcontact" id="txtcontact" class="form-control" pattern="[7-9]{1}[0-9]{9}" title="Phone number starting with 7-9 and 10 digits" required>
                </div>

                <div class="form-group">
                    <label for="txtemail">Email</label>
                    <input type="email" name="txtemail" id="txtemail" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase, and lowercase letter, and at least 8 characters" required>
                </div>

                <div class="form-group">
                    <label for="txtconfirm">Confirm Password</label>
                    <input type="password" name="txtconfirm" id="txtconfirm" class="form-control" required>
                </div>


                <div class="form-group">
                    <label for="file_photo">Photo</label>
                    <input type="file" name="file_photo" id="file_photo" class="form-control-file" required>
                </div>


                <div class="form-group text-center">
                    <button type="submit" name="btnsubmit" class="btn btn-primary btn-block">Submit</button>
                    <button type="reset" class="btn btn-secondary btn-block">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</body>
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
<?php
include("Foot.php");
ob_flush();
?>
