  <?php
      ob_start();
      include("Head.php");
      include("../Assets/Connection/Connection.php");
      ?>
  
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Product-Wise Sales Report</title>
  </head>
  <body>
    <style>
        td{
            color: black !important ;
        }
    </style>
  <div class="container mt-5">
    <center><h1><u>Seller Sales Report</u></h1></center>
    
    <form name="frm_prod" method="POST" action="" class="mt-4">
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="txt_start" class="form-label">Start Date</label>
                <input type="date" class="form-control" name="txt_start" id="txt_start" required />
            </div>
            <div class="col-md-3">
                <label for="txt_end" class="form-label">End Date</label>
                <input type="date" class="form-control" name="txt_end" id="txt_end" required />
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn btn-primary" />
            </div>
        </div>
    </form>

    <?php

    if (isset($_POST['btn_submit'])) {
        $start = $_POST['txt_start'];
        $end = $_POST['txt_end'];
        $selqry = "SELECT * FROM tbl_booking b
              inner join tbl_cart c on c.booking_id=b.booking_id 
              INNER JOIN tbl_product p on p.product_id=c.product_id 
             inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id
						 inner join tbl_category t on s.category_id=t.category_id
                         inner join tbl_user sl on sl.user_id=b.user_id
              where p.seller_id=".$_GET['sid']." and
              b.booking_date BETWEEN '$start' and '$end'";
        $result = $con->query($selqry);
        $i = 0;
    ?>

<div id="content">
    <table class="table table-bordered mt-4" align="center">
        <thead class="table-dark">
            <tr>
                <th scope="col">Sno</th>
                <th scope="col">Category</th>
                <th scope="col">Subcategory</th>
                <th scope="col">Name</th>
                <th scope="col">User</th>
                <th scope="col">Date</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data = $result->fetch_assoc()) {
                $i++;
            ?>
            <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $data['category_name']; ?></td>
                <td><?php echo $data['subcategory_name']; ?></td> 
                <td><?php echo $data['product_name']; ?></td>
                <td><?php echo $data['user_name']; ?></td>
                <td><?php echo $data['booking_date']; ?></td>
                <td><?php echo $data['cart_qty']; ?></td>        
                <td><?php echo $data['booking_amount']; ?></td>
                <td><img src="../Assets/Files/Seller/<?php echo $data['product_image']; ?>" width="100" height="100" class="img-fluid"></td>
            </tr>
            <?php
            }
            ?>
            <button id="cmd" onClick="printDiv('content')" style="float:right;color:#FFF;background:#0C0;border:none;margin:20px;padding:10px;border-radius:10px" >Print</button>

</div>
  </body>
  <!-- Print as PDF -->
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
        </tbody>
    </table>
        </div>

    <?php
    }
    ?>

</div>
  </body>
  </html>
  <?php
  include("Foot.php");
  ob_flush();
  ?>