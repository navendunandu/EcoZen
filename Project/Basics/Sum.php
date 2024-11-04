<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="" method="post">
<table width="235" border="1">
  <tr>
    <td width="59" for='Num1'>Num1</td>
    <td width="61">
    <input type="text" name="txtNum1" id="txtNum1"  />
    </td>
    <td width="38" for='Num2'>Num2</td>
    <td width="49">
     <input type="text" name="txtNum2" id="txtNum2" />
    </td>
  </tr>
  <tr>
    <td colspan="4"><div align="center">
      <input type="submit" name="submit"  value="Sum" />
    </div></td>
    </tr>
</table>
</form>

<?php
 if(isset($_POST['submit']))
 {
	 $Num1 = $_POST['txtNum1'];
	 $Num2 = $_POST['txtNum2'];
	 $result=$Num1+$Num2;
	 
echo "<p> The Sum of " . $Num1 . " and " . $Num2 . " is :" . $result . "</p>";
 
 }
 ?>

</body>
</html>