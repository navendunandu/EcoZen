<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	 $_
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
     $Total=0;
     $Grade="";
     $Per=0;
    
 if(isset($_POST["btnSubmit"]))
 {
	 $Gender=$_POST["rdGender"];
	 $Dept=$_POST["sclDept"];
	 $Mark1=$_POST["txtm1"];
	 $Mark2=$_POST["txtm2"];
	 $Mark3=$_POST["txtm3"];
	 $Total =intval($Mark1) + intval($Mark2) + intval($Mark3);
	 
	 if($Gender=="Female")
	  $Name = "Mrs . ". $_POST["txtfname"]." ".$_POST["txtlname"];
	 else
	 $Name = "Mr . ". $_POST["txtfname"]." ".$_POST["txtlname"];
	 
	 if($Total>=260)
	    $Grade="A+";
     else if($Total>=200)
		$Grade="A";
	 else if($Total>=150)
	    $Grade="B+";
	 else if($Total>=110)
	    $Grade="B";
	 else
		$Grade="Failed";
		
	$Per=(($Total/300)*100);
 }
?>
<body align ="center">
<form action="" method="POST">
<table width="500" height="500" border="4" bordercolor="#0000FF" align="center">
  <tr>
    <td width="80">First Name</td>
    <td width="104"><input name="txtfname" type="text" /></td>
  </tr>
  <tr>
    <td>Last Name</td>
    <td><input name="txtlname" type="text" /></td>
  </tr>
  <tr>
    <td>Gender</td>
    <td><input name="rdGender" type="radio" value="Male" />
    Male
      <input name="rdGender" type="radio" value="Female"/>
      Female</td>
   </tr>
  <tr>
    <td height="30">Dept</td>
    <td><select name="sclDept">
    <option>---select---</option>
    <option>BCA</option>
    <option>Bsc computer science</option>
    <option>MCA</option>
    </select></td>
  </tr>
  
  <tr>
    <td>Mark1</td>
    <td><input name="txtm1" type="text"/></td>
  </tr>
  
  <tr>
    <td>Mark2</td>
    <td><input name="txtm2" type="text"/></td>
  </tr>
  
  <tr>
    <td>Mark3</td>
    <td><input name="txtm3" type="text"/></td>
  </tr>
  
  <tr>
  <td>Total</td>
  <td><?php echo $Total ?></td>
  </tr>
  
  <tr>
  <td>Grade</td>
  <td><?php echo $Grade  ?></td>
  </tr>
  
  <tr>
  <td>Percentage</td>
  <td><?php echo $Per."%" ?></td>
  </tr>
  
  
  <tr>
    <td colspan="2"><div align="center">
      <input name="btnSubmit" type="Submit" />
    </div></td>
   </tr>
   
   <tr>
   <td colspan="2"><div align="center">
     <input name="btnCancel" type="reset" value="Cancel"/>
   </div></td>
  </tr>
</table>
</form>
<?php
     echo "<br>"."<br>";
     echo "Name: ".$Name ."<br>";
	 echo "Gender: ".$Gender."<br>";
     echo "Department ".$Dept."<br>";
	 echo "Mark1: ".$Mark1."<br>";
	 echo "Mark2: ".$Mark2."<br>";
     echo "Mark3: ".$Mark3."<br>";
	 echo "Total: ".$Total."<br>";
	 echo "Grade: ".$Grade."<br>";
	 echo "Percentage: ".$Per."%"."<br>";
?>
</body>
</html>
