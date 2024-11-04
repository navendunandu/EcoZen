<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
if(isset($_POST['btn_reply']))
{
	$reply=$_POST['txt_reply'];
    $insQry="UPDATE  tbl_complaint set complaint_reply='$reply' where    complaint_id=".$_GET['cid'];
if($con->query($insQry))
{
}
else
{
	 echo "error";
}
}
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .form-title {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-check-inline {
            margin-right: 15px;
        }
        .form-label{
          font-size: 1.5rem;
          font-weight: bold;
        }
    </style>
</head>

<body align="center">
<div class="form-container">
<form id="form1" name="form1" method="post" action="">
<div class="form-group">
<div>
 <label for ="txt_reply" class="form-control" >Reply</label>
  <div>
   <input type="text" name="txt_reply"/>
  </div>
</div>
<div>
<input type="submit" name="btn_reply" id="btn_reply" value="Reply" class="btn btn-primary"/>
</div>
</table>
</form>
</div>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>
