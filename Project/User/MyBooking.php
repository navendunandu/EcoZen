<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
if (isset($_GET["delID"])) {
    $cartID = $_GET["delID"];
    $delQry = "delete from tbl_cart where cart_id = '$cartID'";
    if ($con->query($delQry)) {
        ?>
        <script>
            alert("CANCELLED");
            window.location = "MyCart.php";
        </script>
        <?php
    } else {
        echo "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Bookings</title>
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">My Bookings</h1>
    <form action="" method="POST">
        <table class="table table-bordered table-striped table-hover mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>Sl No</th>
                    <th>Photo</th>
                    <th>Product</th>
                    <th>Seller</th>
                    <th>Amount</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $userId = $_SESSION['uid'];
            $selQry = "select * from tbl_cart c 
                        inner join tbl_product p on c.product_id = p.product_id 
                        inner join tbl_booking b on c.booking_id = b.booking_id 
                        inner join tbl_seller s on s.seller_id=p.seller_id
                        WHERE booking_status = '2' and user_id = ".$userId;
            $result = $con->query($selQry);
            $i = 0;
            $total = 0;
            while ($data = $result->fetch_assoc()) {
                $i++;
                $total = $data["cart_qty"] * $data["product_price"];
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><img src="../Assets/Files/Seller/<?php echo $data['product_image']; ?>" class="img-thumbnail" width="100" height="100"></td>
                    <td><?php echo $data["product_name"]; ?></td>
                    <td><?php echo $data["seller_name"]; ?></td>
                    <td><?php echo $data["product_price"]; ?></td>
                    <td><?php echo $data["cart_qty"]; ?></td>
                    <td><?php echo $total; ?></td>
                    <td>
                        <?php
                        if ($data['cart_status'] == 1) {
                            echo "<span class='badge text-success'>Confirmed</span>";
                        } else if ($data['cart_status'] == 2) {
                            echo "<span class='badge text-primary'>Item Packed</span>";
                        } else if ($data['cart_status'] == 3) {
                            echo "<span class='badge text-info'>Assigned to Delivery Agent</span>";
                        } else if ($data['cart_status'] == 4) {
                            echo "<span class='badge text-warning'>Out for Delivery</span>";
                        } else if ($data['cart_status'] == 5) {
                            echo "<span class='badge text-primary'>Delivery Completed</span>";
                        }
                        ?>
                    </td>
                    <td>
                        <a href="MyBooking.php?delID=<?php echo $data['cart_id']; ?>" class="btn btn-danger btn-sm mb-2">Cancel</a>
                        <a href="PostComplaint.php?pid=<?php echo $data['product_id']; ?>" class="btn btn-warning btn-sm mb-2">Complaint</a>
                        <a href="Rating.php?pid=<?php echo $data['seller_id']; ?>" class="btn btn-info btn-sm">Rating</a>
                        <a href="Bill.php?cid=<?php echo $data['cart_id']; ?>" class="btn btn-primary btn-sm">View Bill</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>