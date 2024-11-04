<?php
include("../Assets/Connection/Connection.php");
session_start();
$ID = $_GET['pid'];
$selqry = "SELECT * FROM tbl_product p 
            INNER JOIN tbl_subcategory s ON p.subcategory_id = s.subcategory_id 
            INNER JOIN tbl_category c ON s.category_id = c.category_id 
            WHERE p.product_id = " . $ID;
$result = $con->query($selqry);
$data = $result->fetch_assoc();
ob_start();
include("Head.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <!-- Bootstrap CSS is included in Head.php -->
</head>

<body>
<div class="container mt-5">
    <a href="Search.php" class="btn btn-secondary mb-3">Back</a>
    
    <div class="card">
        <img src="../Assets/Files/Seller/<?php echo $data['product_image'];?>" class="card-img-top" alt="<?php echo $data['product_name']; ?>" />
        <div class="card-body">
            <h5 class="card-title"><?php echo $data['product_name']; ?></h5>
            <p class="card-text"><strong>Category:</strong> <?php echo $data['category_name']; ?></p>
            <p class="card-text"><strong>Subcategory:</strong> <?php echo $data['subcategory_name']; ?></p>
            <p class="card-text"><strong>Price:</strong> $<?php echo number_format($data['product_price'], 2); ?></p>
            <p class="card-text"><strong>Details:</strong> <?php echo $data['product_details']; ?></p>
        </div>
    </div>
</div>

</body>
</html>

<?php
include("Foot.php");
ob_flush();
?>
