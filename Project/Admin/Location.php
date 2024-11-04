<?php
 include("../Assets/Connection/Connection.php");
 ob_start();
include("Head.php");
 if(isset($_POST["btnsubmit"]))
 {
	 $district=$_POST["selDistrict"];
	 $place=$_POST["selPlace"];
	 $location=$_POST["txtlocation"];
	 $insQry="insert into tbl_location(location_name,place_id)values('$location','$place')";
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
	$locationID=$_GET["delID"];
	$delQry="delete from tbl_location where location_id='$locationID'";
	if($con-> query($delQry))
	 {
    ?>
   <script>
   			alert("Deleted");
			window.location="Location.php";
   </script>
	 <?php
	 }
	 else
	    {
				 echo "error";
		}
	}
	?>
     
	  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<a href="AdminReg.php">Home</a>
<body>
<form action="" method="POST" name="form1">
<table width="200" border="1">
<tr>
   <td>District</td>
   <td>
      <select name="selDistrict" onChange="getPlace(this.value)">>
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
        </td>
 </tr>

   <tr>
    <td>Place</td>
    <td><select name="selPlace" id="selPlace">
    </select>
     </td>
  </tr>
  
  <tr>
    <td>Location</td>
    <td><input name="txtlocation" type="text" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="btnsubmit" type="submit" value="Submit" /></td>
  </tr>
</table>

<table>
<table width="200" border="1">
  <tr>
    <td>Slno</td>
    <td>District</td>
    <td>Place</td>
    <td>Location</td>
    <td>Action</td>
  </tr>
  <?php
  $selQry="select * from tbl_location l inner join 
  tbl_place p on l.place_id = p.place_id inner join tbl_district d on d.district_id = p.district_id";
  $result=$con->query($selQry);
  $i=0;
  while($data=$result->fetch_assoc())
  {
	  $i++;
  ?>
  <tr>
    <td><?php echo $i?></td>
    <td><?php echo $data["district_name"]?></td>
    <td><?php echo $data["place_name"]?></td>
    <td><?php echo $data["location_name"]?></td>
	<td><a href=Location.php?delID=<?php echo $data['location_id']?>>Delete</a></td>
  </tr>
  <?php
  }
  ?>
</table>
</form>
</body>
<script src ="../Assets/JQ/jQuery.js"></script>
<script>
function getPlace(cid){
   $.ajax({
	   url:"../Assets/AjaxPages/Ajaxplace.php?cid=" + cid,
	   success:function(result){
		   $("#selPlace").html(result);
	   }
   });
   }
   </script>
</html>
<?php
include("Foot.php");
ob_flush();
?>