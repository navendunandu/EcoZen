<?php
include("../Assets/Connection/Connection.php");
session_start();
$selQry = "select * from tbl_cart c 
inner join tbl_product p on c.product_id = p.product_id 
inner join tbl_booking b on c.booking_id = b.booking_id 
inner join tbl_seller s on s.seller_id=p.seller_id
inner join tbl_user u on u.user_id=b.user_id
WHERE cart_id = ".$_GET['cid'];
$result = $con->query($selQry);
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        #invoice {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f7f7f7;
            color: #333;
        }

        table td {
            color: #555;
        }

        .total-row td {
            font-weight: bold;
            background-color: #f7f7f7;
        }

        .customer-info, .seller-info {
            margin-bottom: 20px;
        }

        .info-header {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .info-section {
            width: 48%;
            display: inline-block;
            vertical-align: top;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
        }

        #logo {
            width: 100%;
            text-align: center;
            margin-bottom: 30px;
        }

        #logo img {
            max-width: 150px;
        }

        #download-btn {
            margin: 20px 0;
            text-align: center;
        }

        #download-btn button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #download-btn button:hover {
            background-color: #45a049;
        }
        .text-primary{
            color:#3CB815 !important
        }

        .text-secondary{
            color: #F65005 !important;
        }
    </style>
</head>
<body>
<button id="cmd" onClick="printDiv('content')" style="float:right;color:#FFF;background:#0C0;border:none;margin:20px;padding:10px;border-radius:10px" >Download Bill</button>
<div id="content">
    <div id="invoice">
        <!-- Logo Section -->
        <div id="logo">
        <h1 class="fw-bold text-primary m-0">E<span class="text-secondary">co</span>Zen</h1>
        </div>

        <h1>Product Invoice</h1>

        <div class="customer-info info-section">
            <div class="info-header">Customer Information:</div>
            <?php echo $data['user_name'] ?><br>
            <?php echo $data['user_address'] ?><br>
            <?php echo $data['user_contact'] ?>
        </div>

        <div class="seller-info info-section" style="float:right;">
            <div class="info-header">Seller Information:</div>
            <?php echo $data['seller_name'] ?><br>
            <?php echo $data['seller_address'] ?><br>
            <?php echo $data['seller_contact'] ?>
        </div>

        <div style="clear: both;"></div>

        <table>
            <thead>
                <tr>
                    <th>Sl. No</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><?php echo $data['product_name'] ?></td>
                    <td>&#8377; <?php echo number_format($data['product_price'], 2) ?></td>
                    <td><?php echo $data['cart_qty'] ?></td>
                    <td>&#8377; <?php echo number_format($data['cart_qty'] * $data['product_price'], 2) ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="4" style="text-align: right;">Grand Total:</td>
                    <td>&#8377; <?php echo number_format($data['cart_qty'] * $data['product_price'], 2) ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="footer">
            Thank you for shopping with us!<br>
            If you have any questions regarding this invoice, feel free to contact us.
        </div>
    </div>
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js'></script>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
</body>
</html>
