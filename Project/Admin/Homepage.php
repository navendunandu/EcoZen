<?php
ob_start();
include("Head.php");
include("../Assets/Connection/Connection.php");
?>
<div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Hi, welcome back!</h4>
            <p class="mb-0">Your business dashboard template</p>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">

    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="stat-widget-one card-body">
                <div class="stat-icon d-inline-block">
                    <i class="ti-money text-success border-success"></i>
                </div>
                <div class="stat-content d-inline-block">
                    <div class="stat-text">Sales</div>
                    <div class="stat-digit">
                        <?php
                        $sales="select sum(booking_amount) as total from tbl_booking";
                        $res=$con->query($sales);
                        $data=$res->fetch_assoc();
                        echo $data['total'];
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="stat-widget-one card-body">
                <div class="stat-icon d-inline-block">
                    <i class="ti-user text-primary border-primary"></i>
                </div>
                <div class="stat-content d-inline-block">
                    <div class="stat-text">Customer</div>
                    <div class="stat-digit">
                        <?php
                        $sales="select count(*) as total from tbl_user";
                        $res=$con->query($sales);
                        $data=$res->fetch_assoc();
                        echo $data['total'];
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="stat-widget-one card-body">
                <div class="stat-icon d-inline-block">
                    <i class="ti-layout-grid2 text-pink border-pink"></i>
                </div>
                <div class="stat-content d-inline-block">
                    <div class="stat-text">Sellers</div>
                    <div class="stat-digit">
                        <?php
                        $sales="select count(*) as total from tbl_seller";
                        $res=$con->query($sales);
                        $data=$res->fetch_assoc();
                        echo $data['total'];
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="stat-widget-one card-body">
                <div class="stat-icon d-inline-block">
                    <i class="ti-link text-danger border-danger"></i>
                </div>
                <div class="stat-content d-inline-block">
                    <div class="stat-text">Products</div>
                    <div class="stat-digit">
                        <?php
                        $sales="select count(*) as total from tbl_product";
                        $res=$con->query($sales);
                        $data=$res->fetch_assoc();
                        echo $data['total'];
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="text-center mb-4">Recent Bookings</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Username</th>
                        <th>Seller Name</th>
                        <th>Booking Date</th>
                        <th>Booking Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;
                    $query = "SELECT 
                    p.product_name, 
                    u.user_name, 
                    sl.seller_name, 
                    b.booking_date, 
                    c.cart_status 
                  FROM 
                    tbl_booking b
                  INNER JOIN tbl_cart c ON c.booking_id = b.booking_id
                  INNER JOIN tbl_product p ON p.product_id = c.product_id
                  INNER JOIN tbl_user u ON u.user_id = b.user_id
                  INNER JOIN tbl_seller sl ON sl.seller_id = p.seller_id
                  ORDER BY b.booking_date DESC
                  LIMIT 5";
        
        // Execute the query
        $result = $con->query($query);
                    // Fetch each row and display the data
                    while($row = $result->fetch_assoc()) {
                        $i++;
                        echo "<tr>";
                        echo "<td>" . $i. "</td>";
                        echo "<td>" . $row['product_name'] . "</td>";
                        echo "<td>" . $row['user_name'] . "</td>";
                        echo "<td>" . $row['seller_name'] . "</td>";
                        echo "<td>" . $row['booking_date'] . "</td>";
                        
                        // Handle booking status
                        echo "<td>";
                        switch($row['cart_status']) {
                            case 1:
                                echo "New order assigned";
                                break;
                            case 2:
                                echo "Item packed";
                                break;
                            case 3:
                                echo "Assigned product to delivery agent";
                                break;
                            case 4:
                                echo "Out for delivery";
                                break;
                            case 5:
                                echo "Delivered";
                                break;
                            default:
                                echo "Unknown status";
                                break;
                        }
                        echo "</td>";

                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
<?php
                include("Foot.php");
                ob_flush();
                ?>