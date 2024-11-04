<<?php
 include("../Assets/Connection/Connection.php");
 ob_start();
include("Head.php");
 $district='';
 $aid=0;
 if(isset($_POST['btnSubmit']))
 {
	 $aid = $_POST['txtaid'];
	 $district = $_POST['txtdistrict'];
	 
	 if($aid!=0)
	 {
	     $upQry = "UPDATE tbl_district SET
	      district_name ='$district' where district_id='$aid'";
	       if($con->query($upQry))
	         {
		    ?>
             <script>
		         alert("updated");
		         window.location = "District.php";
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
	 $insQry="INSERT INTO tbl_district(district_name) values ('$district')";	 
	 if($con->query($insQry))
	 {
     ?>
     <script>
	 alert("Inserted");
	 window.location="District.php";
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
   $districtID = $_GET["delID"];
   $delQry = "DELETE from tbl_district WHERE district_id = $districtID";
   if($con->query($delQry))
   {
?>
  <script>
  alert("Deleted");
  window.location = "District.php";
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
	 $selQry = "select * from tbl_district where district_id='$aid'";
	 $result = $con->query($selQry);
	 $data = $result->fetch_assoc();
	 $district = $data['district_name'];
 }
 ?><!DOCTYPE html>
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
    </style>
</head>
<body>
    <div class="table-container">
        <h2 align="center">Districts in Service</h2>
        <a href="AdminReg.php" class="btn btn:hover">Home</a>

        <form id="form1" name="form1" action="" method="POST">
            <table>
                <tr>
                    <td>District:</td>
                    <td>
                        <input type="hidden" name="txtaid" id="txtaid" value="<?php echo $aid; ?>"/>
                        <input type="text" name="txtdistrict" id="txtdistrict" value="<?php echo $district; ?>" required/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="center">
                        <input name="btnSubmit" type="submit" value="Submit" class="btn btn:success"/>
                    </td>
                </tr>
            </table>
        </form>

        <br><br>

        <table>
            <tr>
                <th>Slno</th>
                <th>District</th>
                <th>Action</th>
            </tr>
            <?php
            $selQry = "SELECT * FROM tbl_district";
            $result = $con->query($selQry);
            $i = 0;
            while ($data = $result->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo htmlspecialchars($data['district_name']); ?></td>
                <td>
                    <a href="District.php?delID=<?php echo $data['district_id']; ?>" class="btn btn-danger">Delete</a>
                    <a href="District.php?eID=<?php echo $data['district_id']; ?>" class="btn btn-success">Edit</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>