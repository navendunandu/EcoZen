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
    <title>Farmer List</title>
    <!-- Include Bootstrap CSS here if not using CDN -->
    <link href="../Assets/CSS/bootstrap.min.css" rel="stylesheet"> <!-- Adjust the path as necessary -->
</head>

<body>
<div class="container mt-5">
    <h3 class="text-center mb-4">Farmer List</h3>
    <form method="POST">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sl. No</th>
                    <th>Farmer Name</th>
                    <th>District</th>
                    <th>Place</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $selQry = "SELECT * FROM tbl_seller s 
                            INNER JOIN tbl_place p ON s.place_id = p.place_id 
                            INNER JOIN tbl_district d ON d.district_id = p.district_id"; 
                $result = $con->query($selQry);
                $i = 0;
                while ($data = $result->fetch_assoc()) {
                    $i++;
                ?>
                <tr> 
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['seller_name']; ?></td>
                    <td><?php echo $data['district_name']; ?></td>
                    <td><?php echo $data['place_name']; ?></td>
                    <td>
                        <a href="Viewproduct.php?sid=<?php echo $data['seller_id']; ?>" class="btn btn-info btn-sm">View Product</a>
                    </td>
                </tr>
                <?php
                }
                ?> 
            </tbody>
        </table>
    </form>
</div>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>