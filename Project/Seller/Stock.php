<?php
session_start();
include("../Assets/Connection/Connection.php");
include("Head.php");
if (isset($_POST['btnsubmit'])) {
    $stock = $_POST['txtstock'];
    $ProductID = $_GET["pid"];

    $insQry = "INSERT INTO tbl_stock (stock_qty, stock_date, product_id) VALUES ('$stock', CURDATE(), '$ProductID')";
    if ($con->query($insQry)) {
        echo "<script>alert('Stock inserted'); window.location='Stock.php?pid=$ProductID';</script>";
    } else {
        echo "Error: " . $con->error;
    }
}

if (isset($_GET["delID"])) {
    $stockID = $_GET["delID"];
    $delQry = "DELETE FROM tbl_stock WHERE stock_id = '$stockID'";
    if ($con->query($delQry)) {
        echo "<script>alert('Stock deleted'); window.location='Stock.php?pid=" . $_GET['pid'] . "';</script>";
    } else {
        echo "Error: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>


<!-- Container -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <!-- Form for Adding Stock -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Add Stock
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="txtstock" class="form-label">Stock Quantity</label>
                            <input type="number" name="txtstock" class="form-control" id="txtstock" placeholder="Enter stock quantity" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="btnsubmit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Stock Table -->
    <div class="row mt-5">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    Stock List
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Date</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $selQry = "SELECT * FROM tbl_stock WHERE product_id=" . $_GET['pid'];
                        $result = $con->query($selQry);
                        $i = 0;
                        while ($data = $result->fetch_assoc()) {
                            $i++;
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $data['stock_date']; ?></td>
                                <td><?php echo $data['stock_qty']; ?></td>
                                <td>
                                    <a href="Stock.php?delID=<?php echo $data['stock_id']; ?>&pid=<?php echo $data['product_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>