<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
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
    <h2 class="text-center mb-4">Complaints from Customers</h2>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Slno</th>
                        <th>Date</th>
                        <th>Title</th>
                        <th>User</th>
                        <th>Product</th>
                        <th>File</th>
                        <th>Description</th>
                        <th>Reply</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $_SESSION['sid'];
                    $selQry = "SELECT * FROM tbl_seller s 
                               INNER JOIN tbl_product p ON s.seller_id=p.seller_id 
                               INNER JOIN tbl_complaint c ON c.product_id=p.product_id 
                               INNER JOIN tbl_user n ON c.user_id=n.user_id 
                               WHERE s.seller_id=".$_SESSION['sid'];
                    $result = $con->query($selQry);
                    while ($row = $result->fetch_assoc()) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['complaint_date']; ?></td>
                        <td><?php echo $row['complaint_title']; ?></td>
                        <td><?php echo $row['user_name']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td>
                            <img src="../Assets/Files/User/Complaint/<?php echo $row['complaint_file']; ?>" class="img-thumbnail" width="100" height="100" alt="complaint file">
                        </td>
                        <td><?php echo $row['complaint_des']; ?></td>
                        <td>
                            <a href="Reply.php?cid=<?php echo $row['complaint_id']; ?>" class="btn btn-primary">Reply</a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </form>
</div>
</body>
</html>

<?php
include("Foot.php");
ob_flush();
?>
