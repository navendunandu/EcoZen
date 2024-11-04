<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Complaints</title>
    <!-- Bootstrap CSS is included in Head.php -->
</head>

<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">My Complaints</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Sl. No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Product</th>
                <th>File</th>
                <th>Reply</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $userID = $_SESSION['uid'];
            $selQry = "SELECT * FROM tbl_complaint c 
                        INNER JOIN tbl_product p ON c.product_id = p.product_id 
                        WHERE user_id = " . $userID;
            $result = $con->query($selQry);
            $i = 0;

            while ($data = $result->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo htmlspecialchars($data['complaint_title']); ?></td>
                <td><?php echo htmlspecialchars($data['complaint_des']); ?></td>
                <td><?php echo htmlspecialchars($data['product_name']); ?></td>
                <td>
                    <img src="../Assets/Files/Userdocs/<?php echo htmlspecialchars($data['complaint_file']); ?>" width="100" height="100" alt="Complaint File">
                </td>
                <td><?php echo htmlspecialchars($data['complaint_reply']); ?></td>
                <td><?php echo htmlspecialchars($data['complaint_date']); ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
include("Foot.php");
ob_flush();
?> 
