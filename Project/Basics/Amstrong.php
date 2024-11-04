<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
$d=0;

    if(isset($_POST['btnSubmit']))
	{
		$temp=0;
		$Num = $_POST['txtNum'];
		$len = strlen($Num);
		for($i=0; $i<=$len ;$i++)
		{
			$rem = intval($Num) % 10;
			$temp= $temp + $rem^3;
		}
	}
?>
<body>
<form action="" method="POST">
<table width="200" border="1">
  <tr>
    <td>Num</td>
    <td><input name="txtNum" type="text" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="btnSubmit" type="submit" /></td>
  </tr>
</table>
</form>
<?php
 if($Num==$temp)
 {
		 echo "Amstrong";
 }
	 else
	 {
	     echo "Not an amstrong";
	 }
?>

</body>
</html>