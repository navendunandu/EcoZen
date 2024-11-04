
<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';
 $Name='';
 $Email='';
 $Password='';
 $aid=0;
 if(isset($_POST['btnSubmit']))
 {
	 $aid=$_POST['txtaid'];
	 $Name=$_POST["txtName"];
	 $Email=$_POST["txtEmail"];
	 $Password=$_POST["txtPassword"];
	 if($aid!=0)
	 {
	  $upQry ="update tbl_admin SET admin_name='$Name',admin_email='$Email',admin_password='$Password' where admin_id = '$aid'"; 
	 if($con->query($upQry))
	 {
		 ?>
         <script>
		  alert("updated");
		  window.location="AdminReg.php";
		  </script>
     <?php
	 }
	 else
	 {
		 echo "error";
	 }
	}
	 else
	 {
	 $insQry = "insert into tbl_admin(admin_name,admin_email,admin_password) values ('$Name','$Email','$Password')";
	 if($con-> query($insQry))
	 {
     ?>
   <script>
   			alert("Inserted");
			window.location="AdminReg.php";
   </script>
		 <?php
	 }
	 else
	    {
				 echo "error";
		}
     }
 
 }
if(isset($_GET["delID"]))
{
	$adminID=$_GET["delID"];
	$delQry="delete from tbl_admin where admin_id=$adminID";
	if($con-> query($delQry))
	 {
?>
   <script>
   			alert("Deleted");
			window.location="AdminReg.php";
   </script>
	 <?php
	 }
	 else
	    {
				 echo "error";
		}
     
}
 if(isset($_GET["eID"]))
 {
	 $aid = $_GET["eID"];
	 $selQry = "select * from tbl_admin where admin_id='$aid'";
	 $result = $con->query($selQry);
	 $data = $result->fetch_assoc();
	 $Name = $data['admin_name'];
	 $Email = $data['admin_email'];
	 $Password = $data['admin_password'];
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
        .form-label{
          font-size: 1.5rem;
          font-weight: bold;
        }
    </style>
</head>



<body>
   <style>
        td{
            color: black !important ;
        }
    </style>
<div class="container">
    <div style="max-height:100px">
      &nbsp;
    </div>
          <div class="form-container">
           <form  form id="form1" name="form1" action="" method="POST">
              <div class="form-group">
                <label for="txtName">Name</label>
                <input type="text" name="txtName" id="txtName" required  class="form-control" title="Name allows only alphabets ,Spaces and First letter must be capital letter" pattern="^[A-Z]+[a-zA-Z ]*$" value="<?php echo $Name;?>" />               
              </div>

              <div class="form-group">
               
              <label for="txtEmail">Email</label>
               <input name="txtEmail" type="text" id="txtEmail"  class="form-control" required  value="<?php echo $Email;?>"/>
             </div>

             <div class="form-group">             
               <label for="txtPassword">Password</label>
               <input name="txtPassword" type="text" id="txtPassword"  class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain atleast one number and one uppercase and lowercase letter and atleast 8 or more characters" required value="<?php echo $Password;?>"/></td>
             </div>

             <div class="form-group text-center">
                 <button type="submit" name="btnSubmit" class="btn btn-primary btn-block" >Submit</button>
                 <button type="reset"  name="btnCancel" class="btn btn-secondary btn-block" >Cancel</button>
            </div>
      </form>
      </div>
      </div>
      

            </table>
            <form  form id="form1" name="form1" action="" method="POST">
            <table width="500" border="1" align="center">
            <thead class="table-dark">
              <tr>
                <td>slno;</td>
                <td>name</td>
                <td>email</td>
                <td>Password</td>
                <td>Action</td>
              </tr>
          </thead>

              <?php
                $selQry ="select * from tbl_admin";
                $result = $con->query($selQry);
                $i=0;
                while($data=$result->fetch_assoc())
                {
	                 $i++;
              ?>
  
                 <tr>
                   <td><?php echo $i ?></td>
                   <td><?php echo $data['admin_name'];?></td>
                   <td><?php echo $data['admin_email'];?></td>
                   <td><?php echo $data['admin_password'];?></td>
                   <td><a href="AdminReg.php?delID=<?php echo $data['admin_id']?>">Delete</a>&nbsp;
                   <a href="AdminReg.php?eID=<?php echo $data['admin_id']?>">Edit</a></td>
                  </tr>
                 <?php
                }
                  ?>
</table>
</form>
</body>
</html>
 
<?php
include("Foot.php");
ob_flush();
?>