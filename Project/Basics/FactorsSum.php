<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
$sum=0;
if(isset($_POST["btnSubmit"]))
   {
	   $Number=$_POST["txtNumber"];
	   for($i=1 ; $i<=$Number ; $i++)
	   {
		if($Number%$i==0)
		{
			$sum=$sum + $i;
		}		
	   }
   }
?>
<body>
<form action="" method="POST">
<table width="300" border="4" bordercolor="#660000">
  <tr>
    <td>Number:</td>
    <td><input type="text" name="txtNumber" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="btnSubmit" type="submit"  /></td>
  </tr>
  <tr>
    <td>Sum:</td>
    <td><?php echo  $sum ?></td>
  </tr>
</table>
</form>
<?php
    echo "<br>";
    echo "the factors are: ";
   for($i=1;$i<=$Number;$i++)
   {
	   if($Number%$i==0)
	   {
	   echo "<br>";
	   echo $i;
	   }
   }
   echo "the sum is : $sum";
?>
</body>
</html>