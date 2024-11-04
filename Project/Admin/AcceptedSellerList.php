<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
if(isset($_GET['rid']))
{
	$upQry="update tbl_seller set seller_status='2' where seller_id=".$_GET['rid'];
	if($con->query($upQry))
	{
		?>
        <script>
		alert("Rejected");
		window.location="SellerAcceptedList.php";
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
            width: 100%%;
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
            font-size: 16px; /* Increased font size for clarity */
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
    padding: 10px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    }
    </style>
   </head>
<a href="Homepage.php"class="btn btn:hover">HOME</a>
<body>
<div class="table-container">
<h2 align="center"><u>Verified sellers</u></h2>
<form id="form1" name="form1" method="post"action="">
<table width="200" border="1">
<tr>
   <th>Slno</th>
   <th>Name</th>
    <th>Gender</th>
   <th>Contact</th>
   <th>Email</th>
   <th>Password</th>
    <th>Photo</th>
   <th>Proof</th>
   <th>Action</td>
 </tr>
 <?php
 
 $selQry="select * from tbl_seller where seller_status=1";
 $result=$con->query($selQry);
 $i=0;
 
 while($data=$result->fetch_assoc())
 {
	 $i++;
	 ?>
     <tr>
     <td><?php echo $i;?></td>
        <td><?php echo $data['seller_name'];?></td>
         <td><?php echo $data['seller_gender'];?></td>
           <td><?php echo $data['seller_contact'];?></td>
            <td><?php echo $data['seller_email'];?></td>
             <td><?php echo $data['seller_password'];?></td>
              <td><img src="../Assets/Files/Seller/<?php echo $data['seller_image'];?>"width="100" height="100"></td>
               <td><img src="../Assets/Files/Seller/<?php echo $data['seller_proof'];?>"width="100" height="100"></td>
               <td> <a href="SellerList.php?rid=<?php echo $data['seller_id'];?>"class="reject-btn">Reject</a> <br><br>
               <a href="SellerSalesReport.php?sid=<?php echo $data['seller_id'];?>"class="btn btn-primary btn-sm">View Sales</a>
            </td>
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
   
   
   
