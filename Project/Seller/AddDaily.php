<?php
session_start();
include("Head.php");  // Assuming Head.php includes Bootstrap CSS and other necessary meta tags
include("../Assets/Connection/Connection.php");

if (isset($_POST['btnsubmit'])) {
    $sid = $_SESSION['sid'];
    $name = $_POST['txtname'];
    $amount = $_POST['txtamount'];

    $insQry = "insert into tbl_daily (daily_name, daily_amt, seller_id, daily_type, daily_datetime) 
               values ('$name','$amount','$sid', 'EXPENSE', curdate())";
    if ($con->query($insQry)) {
        ?>
        <script>
            alert("Inserted");
            window.location = "AddDaily.php";
        </script>
        <?php
    } else {
        echo "Error";
    }
}

if (isset($_GET["delID"])) {
    $delID = $_GET["delID"];
    $delQry = "delete from tbl_daily where seller_id = '$delID'";
    if ($con->query($delQry)) {
        ?>
        <script>
            alert("Deleted");
            window.location = "AddDaily.php";
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
    <title>Add Daily Expense</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Add Daily Expense</h1>

    <!-- Form to Add Expense -->
    <form method="POST" action="" class="mb-4">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="txtname" placeholder="Enter name" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="amount" class="col-sm-2 col-form-label">Amount:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="amount" name="txtamount" placeholder="Enter amount" required>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" name="btnsubmit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <!-- Expense List -->
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sid = $_SESSION['sid'];
        $selQry = "select * from tbl_daily where seller_id = '$sid'";
        $result = $con->query($selQry);
        $i = 0;
        while ($data = $result->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data['daily_name']; ?></td>
                <td><?php echo $data['daily_amt']; ?></td>
                <td><?php echo $data['daily_datetime']; ?></td>
                <td>
                    <a href="AddDaily.php?delID=<?php echo $data['seller_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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

</body>
</html>
