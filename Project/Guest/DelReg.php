<br>
<br>
<br>

<?php
include("../Assets/Connection/Connection.php");

ob_start();
include("Head.php");
if (isset($_POST['btnsubmit'])) {

    $password = $_POST['password'];
    $confirm=$_POST['txtconfirm'];
   

    if($password==$confirm)
    {
    $place = $_POST['sel_place'];
    $name = $_POST['txtName'];
    $gender = $_POST['rdgender'];
    $contact = $_POST['txtcontact'];
    $email = $_POST['txtemail'];
    $photo = $_FILES['file_proof']['name'];
    $tempphoto = $_FILES['file_proof']['tmp_name'];
    move_uploaded_file($tempphoto, '../Assets/Files/SellerReg/' . $photo);
    $Photo = $_FILES['file_image']['name'];
    $tempPhoto = $_FILES['file_image']['tmp_name'];
    move_uploaded_file($tempPhoto, '../Assets/Files/SellerReg/' . $Photo);

    $insQry = "INSERT INTO tbl_del_agent(del_name, del_gender, del_contact, del_email, del_password, del_image, del_proof, place_id) 
               VALUES ('$name', '$gender', '$contact', '$email', '$password', '$photo', '$Photo', '$place')";

    if ($con->query($insQry)) {
        echo "<script>alert('Inserted'); window.location='DelReg.php';</script>";
    } else {
        echo "Error inserting data.";
    }
}
}
?
>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Agent Registration</title>
    <style>
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
    </style>
</head>
<body>
    <div style="max-height:100px">
&nbsp;
    </div>
    <div class="container">
        <div class="form-container">
            <div class="form-title">Delivery Agent Registration</div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtName">Name</label>
                    <input type="text" name="txtName" id="txtName" class="form-control" pattern="^[A-Z]+[a-zA-Z ]*$" required  title="First letter must be capital" />
                </div>

                <div class="form-group">
                    <label for="sel_district">District</label>
                    <select name="sel_district" id="sel_district" class="form-control" onchange="getPlace(this.value)" required>
                        <option value="">--- Select District ---</option>
                        <?php
                        $selQry = "SELECT * FROM tbl_district";
                        $result = $con->query($selQry);
                        while ($data = $result->fetch_assoc()) {
                            echo "<option value='{$data['district_id']}'>{$data['district_name']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sel_place">Place</label>
                    <select name="sel_place" id="sel_place" class="form-control" required>
                        <option value="">--- Select Place ---</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Gender</label><br>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="rdgender" value="Male" class="form-check-input" required>
                        <label class="form-check-label">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="rdgender" value="Female" class="form-check-input" required>
                        <label class="form-check-label">Female</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtcontact">Contact</label>
                    <input type="text" name="txtcontact" id="txtcontact" class="form-control" pattern="[7-9]{1}[0-9]{9}" title="Phone number starting with 7-9 and 10 digits" required>
                </div>

                <div class="form-group">
                    <label for="txtemail">Email</label>
                    <input type="email" name="txtemail" id="txtemail" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="txtconfirm">Confirm Password</label>
                    <input type="password" name="txtconfirm" id="txtconfirm" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="file_proof">Proof</label>
                    <input type="file" name="file_proof" id="file_proof" class="form-control-file" required>
                </div>

                <div class="form-group">
                    <label for="file_image">Profile</label>
                    <input type="file" name="file_image" id="file_image" class="form-control-file" required>
                </div>

                <div class="form-group text-center">
                    <button type="submit" name="btnsubmit" class="btn btn-primary btn-block">Submit</button>
                    <button type="reset" class="btn btn-secondary btn-block">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../Assets/JQ/jQuery.js"></script>
    <script>
    function getPlace(cid) {
        $.ajax({
            url: "../Assets/AjaxPages/Ajaxplace.php?cid=" + cid,
            success: function(result) {
                $("#sel_place").html(result);
            }
        });
    }
    </script>
</body>
</html>

<?php
include("Foot.php");
ob_flush();
?>