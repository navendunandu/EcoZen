<?php
session_start();
include("../Connection/Connection.php");
$qty=$_GET['qty'];
$cartID=$_GET['cid'];
$bid=$_GeT['booking_id'];
if($qty<=0)
{
	$delQry="delete from tbl_cart where cart_id = ".$cartID;
	if($con->query($delQry))
	{
		 echo "Deleted";
	}
	else
	{
		echo "Failed";
	}
	
}
else
{
$upQry = "update tbl_cart set cart_qty ='$qty' where cart_id=".$cartID;

  if($con->query($upQry))
  {
	echo "updated";
  }
  else
	{
		echo "Failed";
	}
	
  
}

?>