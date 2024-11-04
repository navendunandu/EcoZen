<?php
session_start();
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");

if(isset($_GET["bid"])) {
    $uQry = "UPDATE tbl_cart SET cart_status=".$_GET['st']." WHERE booking_id=".$_GET['bid'];
    if($con->query($uQry)) {
        if($_GET['st'] == 5) {
            $uQry = "UPDATE tbl_del_agent SET del_availability=1 WHERE del_id =".$_SESSION['did'];
            $con->query($uQry);
        }
        echo "<script>alert('Updated'); window.location='OnGoingOrders.php';</script>";
    } else {
        echo "<script>alert('Failed'); window.location='OnGoingOrders.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Booking</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Ongoing Orders</h2>

    <?php
    $selqry = "SELECT * FROM tbl_booking b 
               INNER JOIN tbl_user u ON b.user_id=u.user_id 
               INNER JOIN tbl_cart c ON c.booking_id=b.booking_id 
               INNER JOIN tbl_product p ON p.product_id=c.product_id 
               WHERE cart_status >= 3 AND b.del_id=".$_SESSION['did']." 
               GROUP BY b.booking_id DESC";
    $result = $con->query($selqry);

    while($data = $result->fetch_assoc()) {
    ?>

    <div class="card mb-4">
        <div class="card-header">
            <strong>Customer Name: </strong><?php echo $data['user_name']; ?>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Sno</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $bselqry = "SELECT * FROM tbl_cart c 
                            INNER JOIN tbl_product p ON c.product_id=p.product_id
                            WHERE c.booking_id=".$data['booking_id'];
                $bresult = $con->query($bselqry);

                $i = 0;
                while($bdata = $bresult->fetch_assoc()) {
                    $i++;
                    $total_price = $bdata['cart_qty'] * $bdata['product_price'];
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $bdata["product_name"]; ?></td>
                        <td><?php echo $bdata['cart_qty']; ?></td>
                        <td><?php echo $bdata["product_price"]; ?></td>
                        <td><?php echo $total_price; ?></td>
                        <td><img src="../Assets/Files/Seller/<?php echo $bdata['product_image']; ?>" width="100" height="100"></td>
                        <td>
                            <?php
                            if($bdata['cart_status'] == 4) {
                                echo "Shipped";
                            } elseif($bdata['cart_status'] == 5) {
                                echo "Delivered";
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-between">
                <span><strong>Total Amount: </strong><?php echo $data['booking_amount']; ?></span>

                <?php if($data['cart_status'] == 3) { ?>
                    <a href="OnGoingOrders.php?st=4&bid=<?php echo $data['booking_id']; ?>" class="btn btn-warning">Out for Delivery</a>
                <?php } elseif($data['cart_status'] == 4) { ?>
                    <a href="OnGoingOrders.php?st=5&bid=<?php echo $data['booking_id']; ?>" class="btn btn-success">Delivery Complete</a>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php } ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>
