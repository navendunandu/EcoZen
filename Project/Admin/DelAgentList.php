<?php
 include("../Assets/Connection/Connection.php");
 ob_start();
include("Head.php");
  if(isset($_GET["aid"]))
 {
	 $upqry="update tbl_del_agent set del_status='1' where del_id=".$_GET['aid'];
	 if($con->query($upqry))
	 {
		 ?>
         <script>
		 alert("Accepted");
		 window.location="AcceptedDelAgentList.php";
		 </script>
         <?php
	 }
	 
 }		 
  if(isset($_GET["rid"]))
 {
	 $upqry="update tbl_del_agent set del_status='2' where del_id=".$_GET['rid'];
	 if($con->query($upqry))
	 {
		 ?>
         <script>
		 alert("Rejected");
		 window.location="RejectedDelAgentList.php";
		 </script>
         <?php
	 }
	 
 }		 
 ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>District Management</title>
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
    .reject-btn {
    background-color: #ff8c00; /* Dark Orange */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
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
    </style>
</head>
<a href="Homepage.php" class="btn btn:hover">Home </a>
<body>
  <div class ="table-container">
<h2 align="center">Delivery agents</h2>
<form method="POST" action="" enctype="multipart/form-data">
<table width="200" border="1" align="center">
  <tr>
  <th>Slno</th>
  <th>District</th>
  <th>Place</th>
    <th>Name</th>
    <th>Gender</th>
    <th>Contact</th>
    <th>Email</th>
    <th>Password</th>
    <th>Proof</th>
	<th>Profile</th>
    <th>Action</th>
	
  </tr>
  <?php
  $selQry="select * from tbl_del_agent n inner join tbl_place p on n.place_id=p.place_id inner join tbl_district d  on p.district_id=d.district_id where del_status=0";
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
    <td><?php echo $data['del_name']?></td>
    <td><?php echo $data['del_gender']?></td>
    <td><?php echo $data['del_contact']?></td>
    <td><?php echo $data['del_email']?></td>
    <td><?php echo $data['del_password']?></td>
	<td><img src="../Assets/Files/NewUser/<?php echo $data['del_image'];?>" width="50" height="50"></td>
    <td><img src="../Assets/Files/NewUser/<?php echo $data['del_proof'];?>" width="50" height="50"></td>
	<td><a href="DelAgentList.php?aid=<?php echo $data['del_id'];?>"class="accept-btn">Accept</a><br><br>
    <a href="DelAgentList.php?rid=<?php echo $data['del_id'];?>"class="reject-btn">Reject</a></td>
  </tr>
  <?php
  }
  ?>
 
</table>
</form>
</div>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>