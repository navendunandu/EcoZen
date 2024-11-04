<?php

session_start();
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");

if (isset($_GET["ID"])) {
    $uQry = "update tbl_cart set cart_status=" . $_GET['st'] . " where cart_ID=" . $_GET['ID'];
    if ($con->query($uQry)) {
        ?>
        <script>
            alert("Updated");
            window.location = "Bookings.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Failed");
            window.location = "Bookings.php";
        </script>
        <?php
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Booking</title>
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">User Bookings</h1>

    <form method="POST" action="">
        <?php

        $selqry = "select * from tbl_booking b 
                   inner join tbl_user u on b.user_id = u.user_id 
                   INNER JOIN tbl_cart c on c.booking_id = b.booking_id 
                   INNER JOIN tbl_product p on p.product_id = c.product_id 
                   where cart_status >= '1' and p.seller_id = " . $_SESSION['sid'] . " group by b.booking_id DESC";
        $result = $con->query($selqry);

        while ($data = $result->fetch_assoc()) {
            ?>
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">
                        Customer Name: <?php echo $data['user_name']; ?>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>Sno</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Photo</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $bselqry = "select * from tbl_cart c 
                                    inner join tbl_product p on c.product_id = p.product_id
                                    inner join tbl_booking b on c.booking_id = b.booking_id
                                    where c.booking_id = " . $data['booking_id'];
                        $bresult = $con->query($bselqry);

                        $i = 0;
                        $total_price = 0;

                        while ($bdata = $bresult->fetch_assoc()) {
                            $i++;
                            $total_price = $bdata['cart_qty'] * $bdata['product_price'];
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $bdata["product_name"]; ?></td>
                                <td><?php echo $bdata['cart_qty']; ?></td>
                                <td><?php echo $bdata["product_price"]; ?></td>
                                <td><?php echo $total_price; ?></td>
                                <td><img src="../Assets/Files/Seller/<?php echo $bdata['product_image']; ?>"
                                         class="img-thumbnail" width="100" height="100"></td>
                                <td>
                                    <?php
                                    if ($bdata['cart_status'] == 1) {
                                        echo "<span class='badge text-secondary'>New Order</span>";
                                    } else if ($bdata['cart_status'] == 2) {
                                        echo "<span class='badge text-primary'>Item Packed</span>";
                                    } else if ($bdata['cart_status'] == 3) {
                                        echo "<span class='badge text-info'>Assigned to Delivery Agent</span>";
                                    } else if ($bdata['cart_status'] == 4) {
                                        echo "<span class='badge text-warning'>Out for Delivery</span>";
                                    } else if ($bdata['cart_status'] == 5) {
                                        echo "<span class='badge text-success'>Delivered</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($bdata['cart_status'] == 1) {
                                        ?>
                                        <a href="Bookings.php?ID=<?php echo $bdata['cart_id']; ?>&st=2"
                                           class="btn btn-sm btn-success">Pack Item</a>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <strong>Total Amount:</strong> <?php echo $data['booking_amount']; ?>
                </div>
            </div>
            <?php
        }
        ?>
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
