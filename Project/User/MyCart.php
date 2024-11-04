<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
$selQry = "select MAX(booking_id) as id from tbl_booking where booking_status='0' and user_id=".$_SESSION['uid'];
$res = $con->query($selQry);
if ($data1 = $res->fetch_assoc()) {
    $bid = $data1['id'];
}

if (isset($_POST['btnsubmit'])) {
    $checkout = $_POST['txt_total'];
    $upQry = "update tbl_booking set booking_status='1', booking_amount = ".$checkout." WHERE booking_id=".$bid;
    if ($con->query($upQry)) {
        $upDQry = "update tbl_cart set cart_status='1' WHERE booking_id = ".$bid;
        if ($con->query($upDQry)) {
            ?>
            <script>
                window.location = "ChooseMethod.php";
            </script>
            <?php
        } else {
            echo "error";
        }
    }
}

if (isset($_GET["delID"])) {
    $cartID = $_GET["delID"];
    $delQry = "delete from tbl_cart where cart_id = '$cartID'";
    if ($con->query($delQry)) {
        ?>
        <script>
            alert("Deleted");
            window.location="MyCart.php";
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
    <title>My Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">My Cart</h1>
        <form method="POST" action="">
            <?php
            if (!isset($bid)) {
                echo "<h3 class='text-center text-danger'>No items in the cart</h3>";
            } else {
                ?>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Sl No</th>
                            <th>Item</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $selqry = "select * from tbl_cart c inner join tbl_product p on c.product_id = p.product_id WHERE booking_id = ".$bid;
                    $result = $con->query($selqry);
                    $i = 0;
                    $checkout = 0;
                    while ($data = $result->fetch_assoc()) {
                        $total_price = $data['cart_qty'] * $data['product_price'];
                        $checkout += $total_price;
                        $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><img src="../Assets/Files/Seller/<?php echo $data['product_image']; ?>" class="img-thumbnail" width="100" height="100"></td>
                            <td><?php echo $data["product_name"]; ?></td>
                            <td><input type="number" class="form-control" onchange="update(this.value, '<?php echo $data['cart_id']; ?>')" value="<?php echo $data['cart_qty']; ?>" /></td>
                            <td><?php echo $data["product_price"]; ?></td>
                            <td><a href="MyCart.php?delID=<?php echo $data['cart_id']; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                            <td><?php echo $total_price; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td colspan="6" class="text-right"><strong>Total Price:</strong></td>
                        <td><input type="text" name="txt_total" class="form-control" value="<?php echo $checkout; ?>" readonly style="border: none; background: white;"/></td>
                    </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <button type="submit" name="btnsubmit" class="btn btn-success">Checkout</button>
                </div>
                <?php
            }
            ?>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function update(qty, cid) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxUpdate.php?cid=" + cid + "&qty=" + qty,
                success: function(result) {
                    console.log(result);
                    window.location = "MyCart.php";
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