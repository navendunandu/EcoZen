<option value="">select location </option>
<?php
include("../Connection/Connection.php");
$selQry="select*from tbl_location where place_id=".$_GET['lid'];
$result=$con->query($selQry);
   while($data=$result->fetch_assoc())
   {
	   ?>
	   <option value="<?php echo $data['location_id']?>"><?php echo $data['location_name'];?></option>
   <?php
   }
   ?>
  
  
 