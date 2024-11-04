<?php
 include("../Assets/Connection/Connection.php");
 ob_start();
include("Head.php");
 if(isset($_GET["delID"]))
 {
	 $userid=$_GET["delID"];
	 $delqry="delete from tbl_user where user_id=$userid";
	 if($con->query($delqry))
	 {
		 ?>
         <script>
		 alert("deleted");
		 window.location="Userlist.php";
		 </script>
         <?php
	 }
	  else
	  {
		  echo "error";
	  }
 }		 
 ?>
<<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Userlist</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            font-weight: bold; /* Make all text bold */
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: 60%;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px; /* Increased padding for better visibility */
            text-align: center;
            font-size: 18px; /* Increased font size for clarity */
            font-weight: bold; /* Ensure table text is bold */
            color: black;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        input[type="text"] {
            width: 95%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-weight: bold; /* Ensure input text is bold */
        }

        input[type="submit"], .btn {
            background-color: navy; /* Navy background for buttons */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            margin-top: 10px;
            font-weight: bold; /* Ensure button text is bold */
        }

        input[type="submit"]:hover, .btn:hover {
            background-color: darkblue; /* Darker navy on hover */
        }

        .btn {
            display: inline-block;
            transition: background-color 0.3s ease;
            margin: 5px;
            text-decoration: none; /* Remove underline from link buttons */
        }

        .btn-danger {
            background-color: #f44336; /* Red color for delete button */
        }

        .btn-danger:hover {
            background-color: #c9302c; /* Darker red on hover */
        }

        .btn-success {
            background-color: #4CAF50; /* Green color for edit button */
        }

        .btn-success:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        .center {
            text-align: center;
        }
        .accept-btn {
    background-color: oliveDrab; /* Lime Green */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    }
    .reject-btn {
    background-color: #ff8c00; /* Dark Orange */
    color: white;
    padding: 10px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    }
    </style>
</head>
<a href="AdminReg.php" class="btn btn:hover">Home</a>
<body>
<h2>Users List</h2>
<form method="POST" action="" enctype="multipart/form-data">
<table width="200" border="1">
  <tr>
  <td>Slno</td>
  <td>District</td>
  <td>Place</td>
    <td>Name</td>
    <td>Gender</td>
    <td>Contact</td>
    <td>Email</td>
    <td>Password</td>
    <td>Photo</td>
	<td>Profile</td>
    <td>Action</td>
	
  </tr>
  <?php
  $selQry="select * from tbl_user n inner join tbl_place p on n.place_id=p.place_id inner join tbl_district d  on p.district_id=d.district_id";
   $result=($con->query($selQry));
  $i=0;
  while($data=$result->fetch_assoc())
  {
	  $i++;
  ?>
  <tr> 
    <td><?php echo $i?></td>
    <td><?php echo $data['district_name']?></td>
    <td><?php echo $data['place_name']?></td>
    <td><?php echo $data['user_name']?></td>
    <td><?php echo $data['user_gender']?></td>
    <td><?php echo $data['user_contact']?></td>
    <td><?php echo $data['user_email']?></td>
    <td><?php echo $data['user_password']?></td>
	<td><img src="../Assets/Files/NewUser/<?php echo $data['user_image'];?>" width="50" height="50"></td>
    <td><img src="../Assets/Files/NewUser/<?php echo $data['user_proof'];?>" width="50" height="50"></td>
	<td><a href="Userlist.php?aid=<?php echo $data['user_id'];?>"class="accept-btn">Accept</a>
    <br>
    <br>
    
    
    <a href="Userlist.php?rid=<?php echo $data['user_id'];?>"class="reject-btn">Reject</a></td>
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