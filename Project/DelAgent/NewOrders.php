<?php
session_start();
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");

if (isset($_GET["bid"])) {
    $bid = $_GET['bid'];
    $did = $_SESSION['did'];
    
    // Update cart status, booking delivery agent, and agent availability
    $uQry = "UPDATE tbl_cart SET cart_status=3 WHERE booking_id = ?";
    $uQry2 = "UPDATE tbl_booking SET del_id = ? WHERE booking_id = ?";
    $uQry1 = "UPDATE tbl_del_agent SET del_availability = 0 WHERE del_id = ?";

    // Prepare and execute SQL queries
    $stmt1 = $con->prepare($uQry);
    $stmt1->bind_param("i", $bid);
    
    $stmt2 = $con->prepare($uQry2);
    $stmt2->bind_param("ii", $did, $bid);
    
    $stmt3 = $con->prepare($uQry1);
    $stmt3->bind_param("i", $did);

    if ($stmt1->execute() && $stmt2->execute() && $stmt3->execute()) {
        ?>
        <script>
            alert("Updated successfully.");
            window.location = "Homepage.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Failed to update.");
            window.location = "Homepage.php";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Booking</title>
    <!-- Include Bootstrap for better styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">New Orders</h2>
    <div class="table-responsive">
        <form method="POST" action="">
            <?php
$selqry = "SELECT * FROM tbl_booking b 
                       INNER JOIN tbl_user u ON b.user_id = u.user_id
                       INNER JOIN tbl_cart c ON c.booking_id = b.booking_id
                       INNER JOIN tbl_product p ON p.product_id = c.product_id
                       INNER JOIN tbl_seller s ON s.seller_id = p.seller_id
                       WHERE cart_status = 2 GROUP BY c.booking_id
                       ORDER BY c.booking_id DESC";
            $result = $con->query($selqry);

            while ($data = $result->fetch_assoc()) { ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th colspan="6" class="text-center bg-primary text-white">Customer Name: <?php echo $data['user_name']; ?></th>
                        </tr>
                        <tr>
                            <th>Sno</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Seller</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $bselqry = "SELECT * FROM tbl_cart c
                                    INNER JOIN tbl_product p ON c.product_id = p.product_id
                                    INNER JOIN tbl_seller s ON s.seller_id = p.seller_id
                                    WHERE c.booking_id = " . $data['booking_id'];
                        $bresult = $con->query($bselqry);

                        $i = 0;
                        while ($bdata = $bresult->fetch_assoc()) {
                            $i++;
                            $total_price = $bdata['cart_qty'] * $bdata['product_price']; ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $bdata["product_name"]; ?></td>
                                <td><?php echo $bdata['cart_qty']; ?></td>
                                <td><?php echo $bdata["product_price"]; ?></td>
                                <td><?php echo $total_price; ?></td>
                                <td><?php echo $bdata["seller_name"]; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end">Total Amount:</td>
                            <td colspan="2"><?php echo $data['booking_amount']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-center">
                                <a href="NewOrders.php?bid=<?php echo $data['booking_id']; ?>" class="btn btn-success">Accept Order</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <br>
            <?php } ?>
        </form>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>
