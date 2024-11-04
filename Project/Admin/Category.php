<?php
 include("../Assets/Connection/Connection.php");
 ob_start();
include("Head.php");
 $category='';
 $aid=0;
 if(isset($_POST['btnSubmit']))
 {
	 $aid = $_POST['txtaid'];
	 $category = $_POST['txtcategory'];
	 
	 if($aid!=0)
	 {
	     $upQry = "UPDATE tbl_category SET
	      category_name ='$category' where category_id='$aid'";
	       if($con->query($upQry))
	         {
		    ?>
             <script>
		         alert("updated");
		         window.location = "Category.php";
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
	 $insQry="INSERT INTO tbl_category(category_name) values ('$category')";	 
	 if($con->query($insQry))
	 {
     ?>
     <script>
	 alert("Inserted");
	 window.location="Category.php";
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
   $categoryID = $_GET["delID"];
   $delQry = "DELETE from tbl_category WHERE category_id = $categoryID";
   if($con->query($delQry))
   {
?>
  <script>
  alert("Deleted");
  window.location = "Category.php";
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
	 $selQry = "select * from tbl_category where category_id='$aid'";
	 $result = $con->query($selQry);
	 $data = $result->fetch_assoc();
	 $category = $data['category_name'];
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
<a href="AdminReg.php" class="btn btn:hover">Home</a>

<body>
  <h2 align ="center">Categories of products</h2>
<form id="form1" name="form1"action="" method="POST">
<table width="200" border="1"align ="center">
  <tr>
    <td>Category:</td>
    <td><label for="txtcategory"></label>
   <input type="hidden" name="txtaid" id="txtaid" value="<?php echo $aid;?>"/>
   <input type="text" name="txtcategory" id="txtcategory" value="<?php echo $category;?>"/></td>
  </tr>
  
  
  <tr>
    <td colspan="2" align="center"><input name="btnSubmit" type="submit" class="btn btn-success"/></td>
  </tr>
</table>
<br>
<br>

<table width="200" border="1" align ="center">
   <tr>
    <th>Slno</th>
    <th>Category</th>
    <th>Action</th>
   </tr>
	 
     <?php
  $selQry = "select * from tbl_category";
  $result = $con->query($selQry);
  $i=0;
  while($data = $result->fetch_assoc())
  {
	  $i++;
  ?>
  <tr>
  <td><?php echo $i ?></td>
  <td><?php echo $data['category_name'];?></td>
  <td><a href="category.php?delID=<?php echo $data['category_id'];?>"class="btn btn-danger">Delete</a>
  <a href="category.php?eID=<?php echo $data['category_id'];?>"class="btn btn-success">Edit</a>
  </td>
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