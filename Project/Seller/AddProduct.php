<?php
session_start();
include("Head.php");  // Assuming Head.php includes Bootstrap CSS and other necessary meta tags
include("../Assets/Connection/Connection.php");

if (isset($_POST['btnsubmit'])) {
    $subcategory = $_POST['sel_subcat'];
    $sid = $_SESSION['sid'];
    $product = $_POST['txtname'];
    $price = $_POST['txtprice'];
    $details = $_POST['txtdetails'];
    $photo = $_FILES['file_photo']['name'];
    $tempphoto = $_FILES['file_photo']['tmp_name'];
    move_uploaded_file($tempphoto, '../Assets/Files/Seller/' . $photo);

    $insQry = "insert into tbl_product (product_name,product_price,product_details,subcategory_id,product_image,seller_id) 
               values ('$product','$price','$details','$subcategory','$photo','$sid')";
    if ($con->query($insQry)) {
        ?>
        <script>
            alert("Inserted");
            window.location = "AddProduct.php";
        </script>
        <?php
    } else {
        echo "Error";
    }
}

if (isset($_GET["delID"])) {
    $ProductID = $_GET["delID"];
    $delQry = "delete from tbl_product where product_id = '$ProductID'";
    if ($con->query($delQry)) {
        ?>
        <script>
            alert("Deleted");
            window.location = "AddProduct.php";
        </script>
        <?php
    } else {
        echo "Error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Product</title>
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Add Product</h1>

    <a href="Homepage.php" class="btn btn-secondary mb-4">Home Page</a>

    <!-- Form to Add Product -->
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="selCategory">Category</label>
            <select name="selCategory" id="selCategory" class="form-control" onChange="getSubcat(this.value)">
                <option value="">---Select---</option>
                <?php
                $selQry = "select * from tbl_category";
                $result = $con->query($selQry);
                while ($data = $result->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $data['category_id'] ?>"><?php echo $data['category_name']; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="sel_subcat">Subcategory</label>
            <select name="sel_subcat" id="sel_subcat" class="form-control">
                <!-- Subcategories will be loaded dynamically via AJAX -->
            </select>
        </div>

        <div class="form-group">
            <label for="txtname">Product Name</label>
            <input type="text" name="txtname" id="txtname" class="form-control" placeholder="Enter product name" required>
        </div>

        <div class="form-group">
            <label for="txtprice">Price</label>
            <input type="text" name="txtprice" id="txtprice" class="form-control" placeholder="Enter price" required>
        </div>

        <div class="form-group">
            <label for="txtdetails">Details</label>
            <textarea name="txtdetails" id="txtdetails" class="form-control" rows="5" placeholder="Enter product details"></textarea>
        </div>

        <div class="form-group">
            <label for="file_photo">Photo</label>
            <input type="file" name="file_photo" id="file_photo" class="form-control-file" required>
        </div>

        <button type="submit" name="btnsubmit" class="btn btn-primary">Submit</button>
        <button type="reset" name="btnreset" class="btn btn-secondary">Cancel</button>
    </form>

    <hr>

    <!-- Product List -->
    <h2 class="text-center mb-4">Product List</h2>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th>Sl.No</th>
            <th>Category</th>
            <th>Subcategory</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Details</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $selQry = "select * from tbl_product p  
                   inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id 
                   inner join tbl_category c on s.category_id=c.category_id 
                   where seller_id=" . $_SESSION['sid'];
        $result = $con->query($selQry);
        $i = 0;
        while ($data = $result->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data['category_name']; ?></td>
                <td><?php echo $data['subcategory_name']; ?></td>
                <td><?php echo $data['product_name']; ?></td>
                <td><?php echo $data['product_price']; ?></td>
                <td><?php echo $data['product_details']; ?></td>
                <td><img src="../Assets/Files/Seller/<?php echo $data['product_image']; ?>" width="50" height="50"></td>
                <td>
                    <a href="AddProduct.php?delID=<?php echo $data['product_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    <a href="Stock.php?pid=<?php echo $data['product_id']; ?>" class="btn btn-info btn-sm">Stock quantity</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<?php include("Foot.php"); ?> <!-- Include the footer -->

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function getSubcat(cid) {
        $.ajax({
            url: "../Assets/AjaxPages/Ajaxsubcat.php?cid=" + cid,
            success: function (result) {
                $("#sel_subcat").html(result);
            }
        });
    }
</script>

</body>
</html>
