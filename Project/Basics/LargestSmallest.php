<?php
 if(isset($_POST["btnSubmit"]))
   $Num1=$_POST["txtNum1"];
   $Num2=$_POST["txtNum2"];
   $Num3=$_POST["txtNum3"];
   if($Num1<$Num2)
   
	   $large=$Num2;
   else
	   $large=$Num1;
   
   if($large<$Num3)
   
	   $large=$Num3;
	   else
	   $large=$large;
   
   if($Num1<$Num2)
   
	   $small=$Num1;
	   else
	   $small=$Num2;
   
   if($small<$Num3)
   
	   $small=$small;
	   else
	   $small=$Num3;
   
?>
<html>
<body>
<form id="form1" name="form1" action="" method="POST">
<table width="227" height="153" border="1">
  <tr>
    <td width="71" height="32">Num1</td>
    <td width="140"><input name="txtNum1" type="text" /></td>
    
  </tr>
  <tr>
    <td>Num2</td>
    <td><input name="txtNum2" type="text" /></td>
    
  </tr>
  <tr>
    <td>Num3</td>
    <td><input name="txtNum3" type="text" /></td>
    
  </tr>
  <tr>
  <td><div align="center">
    <input name="btnSubmit" type="Submit"/>
  </div>
  <tr>
  <td>Large</td>
  <td><?php echo $large?></td>
  </tr>
  <tr>
  <td width="71">Small</td>
  <td width="140"><?php echo $small?></td>
  </tr>
</table>
</form>
</td>
</body>
</html>



      