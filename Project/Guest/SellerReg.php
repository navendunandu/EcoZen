<?php
 include("../Assets/Connection/Connection.php");
 ob_start();
include("Head.php");
 if(isset($_POST['btnsubmit']))
 {
    $password = $_POST['password'];
    $confirm=$_POST['txtconfirm'];
   

    if($password==$confirm)
    {
    $place = $_POST['sel_place'];
    $name = $_POST['txtname'];
    $gender = $_POST['rdgender'];
    $contact = $_POST['txtcontact'];
    $address = $_POST['txtarea_address'];
    $email = $_POST['txtemail'];
    $password = $_POST['txt_password'];
    $confirm = $_POST['txt_confirm'];
    $photo = $_FILES['file_proof']['name'];
    $tempphoto = $_FILES['file_proof']['tmp_name'];
    move_uploaded_file($tempphoto, '../Assets/Files/SellerReg/' . $photo);
    $Photo = $_FILES['file_image']['name'];
    $tempPhoto = $_FILES['file_image']['tmp_name'];
    move_uploaded_file($tempPhoto, '../Assets/Files/SellerReg/' . $Photo);

    $insQry = "INSERT INTO tbl_seller(seller_name, seller_gender, seller_contact, seller_email,seller_address, seller_password, seller_image, seller_proof, place_id) 
               VALUES ('$name', '$gender','$address', '$contact', '$email', '$password', '$photo', '$Photo', '$place')";
    
    if($con->query($insQry)) {
?>
        <script>
        alert("Inserted successfully");
        window.location = "SellerReg.php";
        </script>
<?php
    } else {
        echo "Error: " . $con->error;
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration</title>
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
    </style>
</head>
<body>

<div class="container">
    <div style="max-height:100px">
&nbsp;
    </div>
        <div class="form-container">
            <div class="form-title">Farmer Registration</div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        
                    <div class="form-group">
                            <label for="txtname">Name</label>
                            <input type="text" name="txtname" id="txtname" class="form-control" pattern="^[A-Z]+[a-zA-Z ]*$" title="First letter must be capital" required>
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
                            <input type="text" name="txtcontact" id="txtcontact" class="form-control" pattern="[7-9]{1}[0-9]{9}" title="Phone number must start with 7-9 and have 10 digits" required>
                        </div>

                        <div class="form-group">
                            <label for="txtarea_address">Address</label>
                            <textarea name="txtarea_address" id="txtarea_address" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="txtemail">Email</label>
                            <input type="email" name="txtemail" id="txtemail" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="txt_password">Password</label>
                            <input type="password" name="txt_password" id="txt_password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="txt_confirm">Confirm Password</label>
                            <input type="txt_password" name="txt_confirm" id="txt_confirm" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="file_proof">Proof Document</label>
                            <input type="file" name="file_proof" id="file_proof" class="form-control-file" required>
                        </div>

                        <div class="form-group">
                            <label for="file_image">Profile Photo</label>
                            <input type="file" name="file_image" id="file_image" class="form-control-file" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" name="btnsubmit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
        </div>
    </div>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
function getPlace(districtId) {
    $.ajax({
        url: "../Assets/AjaxPages/Ajaxplace.php?cid=" + districtId,
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