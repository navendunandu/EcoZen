<?php
 include("../Assets/Connection/Connection.php");
 ob_start();
include("Head.php");
 if(isset($_POST["btnsubmit"]))
 {
	 $Subcategory = $_POST["txtname"];
	 $Category=$_POST["selcategory"];
	 $insQry="insert into tbl_subcategory(subcategory_name,category_id) values
	 ('$Subcategory','$Category')";
	 if($con->query($insQry))
	 {
?>
      <script>
      alert("Inserted");
	  window.location="Subcategory.php";
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
	$subcategoryID = $_GET["delID"];
	$delQry = "delete from tbl_subcategory where subcategory_id = '$subcategoryID'";
	if($con -> query($delQry))
	 {
    ?>
   <script>
   			alert("Deleted");
			window.location="Subcategory.php";
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
    .cancel-btn {
            background-color: darkRed; /* Red background for cancel button */
            color: white;              /* White text */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            margin-top: 10px;
            font-weight: bold; /* Ensure button text is bold */
        }
    }
    .cancel-btn:hover {
    background-color: #d32f2f; /* Darker red on hover */
    }
    </style>
</head>
<a href="Homepage.php" class="btn btn:hover">Home </a>
<body>
  <div class="table-container">
<h2 align="center">Subcategories of products</h2>
<form action="" method="POST">
<table width="200" border="1"align="center">
  <tr>
    <td>Category</td>
    <td><select name="selcategory">
        <option value = "---select---">---select---</option>
        <?php
		$selQry="select * from tbl_category";
		$result=$con->query($selQry);
	    while($data=$result->fetch_assoc())
		{
	    ?>
        <option value = "<?php echo $data['category_id']?>">
		<?php echo $data['category_name'];?></option>
        <?php
		}
		?>
        </select>
  <tr>
  </tr>
  <tr>
    <td>Subcategory</td>
    <td><input name="txtname" type="text"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="btnsubmit" type="submit" value="Save"class="btn btn:hover"/>
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    <input name="btnreset" type="reset" value="Cancel" class="cancel-btn" />
    </td>
  </tr>
</table>
<br>
<br>
 <table width="200" border="1"align="center">
  <tr>
    <th>Slno</th>
    <th>Category</th>
    <th>Subcategory</th>
    <th>Action</th>
  </tr>
   <?php
  $selQry="select * from tbl_subcategory s inner join 
  tbl_category c on c.category_id=s.category_id" ;
  $result=$con->query($selQry);
  $i=0;
  while($data=$result->fetch_assoc())
  {
	  $i++;
  ?>
  <tr>
    <td><?php echo $i?></td>
    <td><?php echo $data["category_name"]?></td>
    <td><?php echo $data["subcategory_name"]?></td>
	<td><a href="Subcategory.php?delID=<?php echo $data['subcategory_id']?>"class="btn btn-danger">Delete</a></td>
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