<?php
 include("../Assets/Connection/Connection.php");
 ob_start();
include("Head.php");
 if(isset($_POST["btnsubmit"]))
 {
	 $Place=$_POST["txtplace"];
	 $Pincode=$_POST["txtpincode"];
	 $district=$_POST["selDistrict"];
	 $insQry="insert into tbl_place(place_name,place_pincode,district_id) values
	 ('$Place','$Pincode','$district')";
	 if($con->query($insQry))
	 {
?>
      <script>
      alert("Inserted");
	  //window.location="Place.php";
	  </script>
      <?php
	 }
		  else
		  {
			  echo "error";
		  }
 }
	if(isset($_GET["delID"]))
    {
	$placeID=$_GET["delID"];
	$delQry="delete from tbl_place where place_id='$placeID'";
	if($con-> query($delQry))
	 {
    ?>
   <script>
   			alert("Deleted");
			window.location="Place.php";
   </script>
	 <?php
	 }
	 else
	    {
				 echo "error";
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
    select {
    width: 100%;                 /* Make the dropdown full-width */
    padding: 12px 20px;          /* Add padding inside the dropdown */
    border: 2px solid #4CAF50;   /* Green border to match theme */
    border-radius: 8px;          /* Rounded corners */
    background-color: white;     /* Set background color */
    color: #333;                 /* Dark text color */
    font-size: 16px;             /* Increase font size */
    font-weight: bold;           /* Bold text */
    background-image: url('arrow-down.svg'); /* Custom arrow icon */
    background-repeat: no-repeat;
    background-position: right 10px center; /* Position custom arrow */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Soft shadow */
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    background-image: url('path/to/your/arrow-icon.svg');
    }
}
    </style>
</head>
<h2 align = "center">Places in service</h2>
<a href="AdminReg.php" class="class=btn btn:hover">Home</a>
<body>
<div class="table-container">
<form action="" method="POST" name="form1">
<table width="200" border="1" align="center">
<tr>
   <td>District</td>
   <td>
      <select name="selDistrict">
        <option value = "---select---">---select---</option>
        <?php
		$selQry="select * from tbl_district";
		$result=$con->query($selQry);
		while($data=$result->fetch_assoc())
		{
	    ?>
        <option value = "<?php echo $data['district_id']?>">
		<?php echo $data['district_name']; ?></option>
        <?php
		}
		?>
        </select>
  <tr>
    <td>Place</td>
    <td><input type="text" name="txtplace" /></td>
  </tr>
  <tr>
    <td>Pincode</td>
    <td><input name="txtpincode" type="text" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="btnsubmit" type="submit" value="Submit" class="btn btn:hover" /></td>
  </tr>
</table>
<br>
<br>
<table width="200" border="1" align="center">
  <tr>
    <th>Slno</th>
    <th>Place</th>
    <th>Pincode</th>
    <th>District</th>
    <th>Action</th>
  </tr>
  <?php
  $selQry="select * from tbl_place p inner join 
  tbl_district d on p.district_id=d.district_id" ;
  $result=$con->query($selQry);
  $i=0;
  while($data=$result->fetch_assoc())
  {
	  $i++;
  ?>
  <tr>
    <td><?php echo $i?></td>
    <td><?php echo htmlspecialchars($data["place_name"])?></td>
    <td><?php echo $data["place_pincode"]?></td>
    <td><?php echo $data["district_name"]?></td>
	<td><a href="Place.php?delID=<?php echo $data['place_id']?>"class="btn btn-danger">Delete</a></td>
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