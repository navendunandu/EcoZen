<?php

include("../Assets/Connection/Connection.php");
session_start();
ob_start();
include("Head.php");
 if(isset($_POST['btnsubmit']))
 {
	 $email=$_POST['txtemail'];
	 $password=$_POST['txtpassword'];
	 $selNewuser="select * from tbl_user where user_email='".$email."' and user_password='".$password."'";
	 $selAdmin="select * from tbl_admin where admin_email='".$email."' and admin_password='".$password."'";
	 
	 $selSeller="select * from tbl_seller where seller_email='".$email."' and seller_password='".$password."'";
	 $selDel="select * from tbl_del_agent where del_email='".$email."' and del_password='".$password."'";
	 $resNewuser=$con->query($selNewuser);
	 $resAdmin=$con->query($selAdmin);
	 $resSeller=$con->query($selSeller);
	 $resDel=$con->query($selDel);
	 if($userData=$resNewuser->fetch_assoc())
	 {
		 $_SESSION['uid']=$userData['user_id'];
		 $_SESSION['uname']=$userData['user_name'];
		 $_SESSION['place']=$userData['place_id'];
		 header("location:../User/Homepage.php");
	 }
	 else if($adminData=$resAdmin->fetch_assoc())
	 {
		 $_SESSION['aid']=$adminData['admin_id'];
		 $_SESSION['aname']=$adminData['admin_name'];
		 header("location:../Admin/Homepage.php");
	 }
	 else if($sellerData=$resSeller->fetch_assoc())
	 {
		if($sellerData['seller_status']==0)
		{
			?>
			<script>
				alert('Not Verified');
			</script>
			<?php
		}
		elseif($sellerData['seller_status']==2)
		{
			?>
			<script>
				alert('Rejected Your Account');
			</script>
			<?php
		}
		else
		{
		 $_SESSION['sid']=$sellerData['seller_id'];
		 $_SESSION['sname']=$sellerData['seller_name'];
		 $_SESSION['place']=$sellerData['place_id'];
		 header("location:../Seller/Homepage.php");
		}
	 }
	 else if($delData=$resDel->fetch_assoc())
	 {
		 $_SESSION['did']=$delData['del_id'];
		 $_SESSION['dname']=$delData['del_name'];
		 header("location:../DelAgent/Homepage.php");
	 }
		 	 
	 else
	 {
		 ?>
<script>
	alert('Invalid Credentials');
</script>
<?php
	 }
 }
 ?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
	<style>
		.form-group {
			position: relative;
			margin-bottom: 1.5rem;
		}

		.form-control {
			width: 100%;
			padding: 10px;
			font-size: 16px;
			border: 1px solid #ccc;
			border-radius: 4px;
			outline: none;
			background: none;
			position: relative;
		}

		.form-label {
			position: absolute;
			top: 80%;
			left: 10px;
			transform: translateY(-100%);
			font-size: 16px;
			color: #777;
			pointer-events: none;
			transition: 0.2s ease all;
			padding-bottom: 5px;
		}

		.form-control:focus~.form-label,
		.form-control:not(:placeholder-shown)~.form-label {
			top: 0;
			left: 10px;
			font-size: 12px;
			font-weight: 100;
			color: #333;
		}

		.form-control:focus {
			border-color: #007bff;
		}

		.form-control:not(:placeholder-shown) {
			padding-top: 20px;
			padding-bottom: 10px;
		}
	</style>
</head>

<body>
	<div class="container-fluid p-0 mb-5">
		<div class="carousel slide">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="w-100" src="../Assets/Templates/Main/img/carousel-1.jpg" alt="Image">
					<div class="carousel-caption">
						<div class="container">
							<div class="row justify-content-start">
								<div class="col-lg-4">
									<h2 class="text-center mb-4" style="font-weight: bold; font-size: 28px; ">
										Welcome Back! Please Login
									</h2>
									<form action="" method="POST">
										<div class="form-group">
											<input type="email" name="txtemail" id="txtemail" class="form-control"
												placeholder=" " required>
											<label for="txtemail" class="form-label">Email</label>
										</div>
										<div class="form-group">
											<input type="password" name="txtpassword" id="txtpassword"
												class="form-control" placeholder=" " required>
											<label for="txtpassword" class="form-label">Password</label>
										</div>

										<div class="form-group">
											<a href="ForgotPass.php">Forgot Password</a>
										</div>
										<div class="form-group text-center">
											<button type="submit" name="btnsubmit"
												class="btn btn-primary">Login</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>
<?php
include("Foot.php");
ob_flush();
?>