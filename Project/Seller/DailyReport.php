<?php
session_start();
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");
$qry="SELECT * FROM tbl_daily WHERE seller_id=".$_SESSION['sid'];
if(isset($_POST['btn_search'])){
    $start=$_POST['txt_start'];
    $end=$_POST['txt_end'];
    $type=$_POST['rad_type'];
    if($type=="ALL"){
        $qry="SELECT * FROM tbl_daily WHERE seller_id=".$_SESSION['sid']." and daily_datetime BETWEEN '$start' and '$end'";
    }
    else{
        $qry="SELECT * FROM tbl_daily WHERE seller_id=".$_SESSION['sid']." and daily_type='$type' and daily_datetime BETWEEN '$start' and '$end'";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container mt-5">
        <h2 class="text-center mb-4">Daily Income & Expense Statement</h2>
        <form action="" method="post" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input type="date" name="txt_start" id="txt_start" class="form-control" placeholder="Select Start Date">
                </div>
                <div class="col-md-4">
                    <input type="date" name="txt_end" id="txt_end" class="form-control" placeholder="Select End Date">
                </div>
                <div class="col-md-4 text-center">
                    <label class="form-check-label me-3">All</label>
                    <input type="radio" name="rad_type" value="ALL" class="form-check-input me-3">
                    <label class="form-check-label me-3">Expense</label>
                    <input type="radio" name="rad_type" value="EXPENSE" class="form-check-input me-3">
                    <label class="form-check-label me-3">Income</label>
                    <input type="radio" name="rad_type" value="INCOME" class="form-check-input">
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary" name="btn_search">Search</button>
            </div>
        </form>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Daily</th>
                    <th>Type</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $con->query($qry);
                $i = 0;
                while($data = $result->fetch_assoc()) {
                    $i++;
                    // Apply background color based on the daily type
                    $bg_class = $data['daily_type'] == 'INCOME' ? 'table-success' : 'table-danger';
                ?>
                <tr class="<?php echo $bg_class; ?>">
                    <td><?php echo $i; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($data['daily_datetime'])); ?></td>
                    <td><?php echo $data['daily_name']; ?></td>
                    <td><?php echo $data['daily_type']; ?></td>
                    <td><?php echo $data['daily_amt']; ?></td>
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