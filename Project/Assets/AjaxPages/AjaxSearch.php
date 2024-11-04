<div class="container">
    <div class="row">
        <?php
		session_start();
        include("../Connection/Connection.php");
        // Query to fetch products
        $selQry = "select * from tbl_product p 
                   inner join tbl_subcategory s on p.subcategory_id = s.subcategory_id 
                   inner join tbl_category c on s.category_id = c.category_id inner join tbl_seller f on f.seller_id=p.seller_id where seller_status = 1";

        // Get filter inputs
        $cat = isset($_GET['cat']) ? $_GET['cat'] : "";
        $subcat = isset($_GET['subcat']) ? $_GET['subcat'] : "";
        $txt = isset($_GET['txt']) ? $_GET['txt'] : "";

        // Apply category and subcategory filters
        if ($subcat != "") {
            $selQry .= " and p.subcategory_id=" . $subcat;
        } elseif ($cat != "") {
            $selQry .= " and s.category_id=" . $cat;
        }

        // Apply product name search filter
        if ($txt != "") {
            $selQry .= " and p.product_name LIKE '%$txt%'";
        }
        // Execute the query
        $resultS = $con->query($selQry);

        // Loop through the products and display them
        while ($data = $resultS->fetch_assoc()) {

            // Get stock information
            $stockQry = "select sum(stock_qty) as stock from tbl_stock where product_id=" . $data['product_id'];
            $stockResult = $con->query($stockQry);
            $stockData = $stockResult->fetch_assoc();
            $stockQty = $stockData['stock'] ? $stockData['stock'] : 0;

            // Get cart quantity
            $cartQry = "select sum(cart_qty) as qty from tbl_cart where product_id=" . $data['product_id'];
            $cartResult = $con->query($cartQry);
            $cartData = $cartResult->fetch_assoc();
            $cartQty = $cartData['qty'] ? $cartData['qty'] : 0;

            // Remaining quantity after considering the cart
            $remQty = $stockQty - $cartQty;
        ?>
            <div class="col-md-3">
                <div class="card mb-4">
                    <!-- Product Image -->
                    <img src="../Assets/Files/Seller/<?php echo $data['product_image']; ?>" class="card-img-top" alt="Product Image" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <!-- Product Details -->
                        <h5 class="card-title"><?php echo $data['product_name']; ?></h5>
                        <p class="card-text">
                            <strong>Category:</strong> <?php echo $data['category_name']; ?><br>
                            <strong>Subcategory:</strong> <?php echo $data['subcategory_name']; ?><br>
                            <strong>Farmer:</strong> <?php echo $data['seller_name']; ?><br>
                            <strong>Details:</strong> <?php echo $data['product_details']; ?><br>
                            <strong>Available Stock:</strong> <?php echo $remQty > 0 ? $remQty : 'Out of Stock'; ?>
                        </p>
                        <!-- Display remaining quantity and stock status -->
						<?php
										
											
						$average_rating = 0;
						$total_review = 0;
						$five_star_review = 0;
						$four_star_review = 0;
						$three_star_review = 0;
						$two_star_review = 0;
						$one_star_review = 0;
						$total_rating_value = 0;
						$review_content = array();
					
						$query = "SELECT * FROM tbl_rating where seller_id = '".$data["seller_id"]."' ORDER BY rating_id  DESC";
					
						$result = $con->query($query);
					
						while($row = $result->fetch_assoc())
						{
							
					
							if($row["rating_value"] == '5')
							{
								$five_star_review++;
							}
					
							if($row["rating_value"] == '4')
							{
								$four_star_review++;
							}
					
							if($row["rating_value"] == '3')
							{
								$three_star_review++;
							}
					
							if($row["rating_value"] == '2')
							{
								$two_star_review++;
							}
					
							if($row["rating_value"] == '1')
							{
								$one_star_review++;
							}
					
							$total_review++;
					
							$total_rating_value = $total_rating_value + $row["rating_value"];
					
						}
						
						
						if($total_review==0 || $total_rating_value==0 )
						{
							$average_rating = 0 ; 			
						}
						else
						{
							$average_rating = $total_rating_value / $total_review;
						}
						
						?>
						<p align="center" style="color:#F96;font-size:20px">
					   <?php
					   if($average_rating==5 || $average_rating==4.5)
					   {
						   ?>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
						   <?php
					   }
					   if($average_rating==4 || $average_rating==3.5)
					   {
						   ?>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
						   <?php
					   }
					   if($average_rating==3 || $average_rating==2.5)
					   {
						   ?>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
						   <?php
					   }
					   if($average_rating==2 || $average_rating==1.5)
					   {
						   ?>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
						   <?php
					   }
					   if($average_rating==1)
					   {
						   ?>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
						   <?php
					   }
					   if($average_rating==0)
					   {
						   ?>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
							<i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
						   <?php
					   }
					   ?>
					   
					</p>
						<?php
					
						$output = array(
							'average_rating'	=>	number_format($average_rating, 1),
							'total_review'		=>	$total_review,
							'five_star_review'	=>	$five_star_review,
							'four_star_review'	=>	$four_star_review,
							'three_star_review'	=>	$three_star_review,
							'two_star_review'	=>	$two_star_review,
							'one_star_review'	=>	$one_star_review,
							'review_data'		=>	$review_content
						);
						if ($remQty > 0) { ?>
                            <p class="text-danger"><?php echo $remQty < 5 ? "Only ".$remQty." left" : ""; ?></p>
                            <a href="#" class="btn btn-primary" onclick="addCart('<?php echo $data['product_id']; ?>')">Add to Cart</a>
                        <?php } else { ?>
                            <p class="text-danger">Out of Stock</p>
                        <?php } ?>
                        <!-- Link to view more product details -->
                        <a href="Viewproduct.php?pid=<?php echo $data['product_id']; ?>" class="btn btn-link">View Product</a>
                    </div>
					
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
