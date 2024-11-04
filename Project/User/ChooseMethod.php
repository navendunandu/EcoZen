<?php
include("../Assets/Connection/Connection.php");

if (isset($_POST['btn_submit'])) {
    $value = $_POST['payment'];
    if($value == 'gpay')
   {
	echo $selQry="select MAX(booking_id)as id from tbl_booking";
	$res = $con->query($selQry);
	$data = $res->fetch_assoc();
	$bid = $data['id'];	
	

		$upQry="update tbl_booking set booking_status='2' ,booking_date = curdate() WHERE booking_id=".$bid;
		if($con->query($upQry))
		{
			$selQry="SELECT * FROM tbl_cart c inner join tbl_booking b ON c.booking_id=b.booking_id inner JOIN tbl_product p ON            c.product_id=p.product_id ";
			$res=$con->query($selQry);
			while($data=$res->fetch_assoc()){
			$cart_qty=$data["cart_qty"];
		    $product_price=$data["product_price"];
			$total= $cart_qty * $product_price;
			$income= $total*(90/100);
			
			$insQry="insert into tbl_daily(daily_name,daily_type,daily_amt,daily_datetime,seller_id)
			values('".$data['product_name']."','INCOME','$income',curdate(),'".$data['seller_id']."')";
			$con->query($insQry);}
			?>
			<script>
			window.location = "Success.html";
			</script>
            <?php
		}
    
   }

   if($value == 'phonepe')
   {
	echo $selQry="select MAX(booking_id)as id from tbl_booking";
	$res = $con->query($selQry);
	$data = $res->fetch_assoc();
	$bid = $data['id'];	
	

		$upQry="update tbl_booking set booking_status='2' ,booking_date = curdate() WHERE booking_id=".$bid;
		if($con->query($upQry))
		{
			$selQry="SELECT * FROM tbl_cart c inner join tbl_booking b ON c.booking_id=b.booking_id inner JOIN tbl_product p ON            c.product_id=p.product_id ";
			$res=$con->query($selQry);
			while($data=$res->fetch_assoc()){
			$cart_qty=$data["cart_qty"];
		    $product_price=$data["product_price"];
			$total= $cart_qty * $product_price;
			$income= $total*(90/100);
			
			$insQry="insert into tbl_daily(daily_name,daily_type,daily_amt,daily_datetime,seller_id)
			values('".$data['product_name']."','INCOME','$income',curdate(),'".$data['seller_id']."')";
			$con->query($insQry);}
			?>
			<script>
			window.location = "Success.html";
			</script>
            <?php
		}
    
   }
   if($value == 'paytm')
   {
	echo $selQry="select MAX(booking_id)as id from tbl_booking";
	$res = $con->query($selQry);
	$data = $res->fetch_assoc();
	$bid = $data['id'];	
	

		$upQry="update tbl_booking set booking_status='2' ,booking_date = curdate() WHERE booking_id=".$bid;
		if($con->query($upQry))
		{
			$selQry="SELECT * FROM tbl_cart c inner join tbl_booking b ON c.booking_id=b.booking_id inner JOIN tbl_product p ON            c.product_id=p.product_id ";
			$res=$con->query($selQry);
			while($data=$res->fetch_assoc()){
			$cart_qty=$data["cart_qty"];
		    $product_price=$data["product_price"];
			$total= $cart_qty * $product_price;
			$income= $total*(90/100);
			
			$insQry="insert into tbl_daily(daily_name,daily_type,daily_amt,daily_datetime,seller_id)
			values('".$data['product_name']."','INCOME','$income',curdate(),'".$data['seller_id']."')";
			$con->query($insQry);}
			?>
			<script>
			window.location = "Success.html";
			</script>
            <?php
		}
    
   }
   
   if($value == 'netbanking')
   {
    ?>
	
			<script>
			window.location = "PaymentGateway.php";
			</script>
            <?php
		}


        if($value == 'card')
        {
         ?>
         
                 <script>
                 window.location = "PaymentGateway.php";
                 </script>
                 <?php
             }
    
   
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Payment Method</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .payment-option {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-radius: 8px;
            background-color: #f8f9fa;
            margin-bottom: 15px;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .payment-option:hover {
            background-color: #e9ecef;
        }

        .payment-option i {
            font-size: 24px;
        }

        .payment-option input {
            margin-left: 10px;
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<form method="post">
    <div class="container">
        <h2>Select Payment Method</h2>

        <!-- Google Pay Option -->
        <div class="payment-option">
            <div>
                <i class="fab fa-google-pay"></i>
                <span class="ms-2">Google Pay</span>
            </div>
            <input type="radio" name="payment" value="gpay">
        </div>

        <!-- PhonePe Option -->
        <div class="payment-option">
            <div>
                <i class="fas fa-mobile-alt"></i>
                <span class="ms-2">PhonePe</span>
            </div>
            <input type="radio" name="payment" value="phonepe">
        </div>

        <!-- Paytm Option -->
        <div class="payment-option">
            <div>
                <i class="fas fa-wallet"></i>
                <span class="ms-2">Paytm</span>
            </div>
            <input type="radio" name="payment" value="paytm">
        </div>

        <!-- Credit/Debit Card Option -->
        <div class="payment-option">
            <div>
                <i class="fas fa-credit-card"></i>
                <span class="ms-2">Credit/Debit Card</span>
            </div>
            <input type="radio" name="payment" value="card">
        </div>

        <!-- Net Banking Option -->
        <div class="payment-option">
            <div>
                <i class="fas fa-university"></i>
                <span class="ms-2">Net Banking</span>
            </div>
            <input type="radio" name="payment" value="netbanking">
        </div>

        <!-- Proceed Button -->
        <button type="submit" name="btn_submit">Proceed to Pay</button>
    </div>
    </form>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
