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
    <title>Product Search</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            margin-top: 20px;
        }
        .search-btn {
            background-color: #007bff;
            color: white;
        }
        .search-btn:hover {
            background-color: #0056b3;
        }
        .my-cart {
            margin-bottom: 20px;
        }
        #result {
            margin-top: 20px;
        }
           /* Default snackbar styles */
#snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 17px;
}

/* Snackbar animation for showing */
#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

/* Green background for successful addition */
.snackbar-green {
  background-color: green;
}

/* Yellow background for already added */
.snackbar-yellow {
  background-color: yellow;
  color: black; /* Ensure text is visible on yellow */
}

/* Red background for failure */
.snackbar-red {
  background-color: red;
}

/* Fade in and fade out animations */
@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}

    </style>
</head>
<body onload="getSearch()">
    <div class="container">
        

        <div class="card">
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="selcategory" class="form-label">Category</label>
                        <select class="form-select" name="selcategory" id="selcategory" onchange="getSubcat(this.value)">
                            <option value="">---Select---</option>
                            <?php
                            $selQry="select * from tbl_category";
                            $result=$con->query($selQry);
                            while($data=$result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $data['category_id']?>">
                                <?php echo $data['category_name'];?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sel_subcat" class="form-label">Subcategory</label>
                        <select class="form-select" name="sel_subcat" id="sel_subcat"></select>
                    </div>

                    <div class="mb-3">
                        <label for="txtname" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="txtname" id="txtname" />
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn search-btn" onclick="getSearch()">Search</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="result" class="row"></div>
    </div>
    <div class="snackbar" id="snackbar">Something went wrong!!!</div>
    <script src ="../Assets/JQ/jQuery.js"></script>
    <script>
        function getSubcat(cid) {
            $.ajax({
                url: "../Assets/AjaxPages/Ajaxsubcat.php?cid=" + cid,
                success: function(result) {
                    $("#sel_subcat").html(result);
                }
            });
        }

        function getSearch() {
            var cat = document.getElementById("selcategory").value;
            var subcat = document.getElementById("sel_subcat").value;
            var txt = document.getElementById("txtname").value;
            console.log("Category:" + cat);
            console.log("Subcategory:" + subcat);
            console.log("Product name:" + txt);
            $.ajax({
                url: "../Assets/AjaxPages/AjaxSearch.php?cat=" + cat + "&subcat=" + subcat + "&txt=" + txt,
                success: function(result) {
                    $("#result").html(result);
                }
            });
        }

        function addCart(fid) {
    var x = document.getElementById("snackbar");
    
    $.ajax({
        url: "../Assets/AjaxPages/AjaxAddCart.php?fid=" + fid,
        success: function(result) {
            // Remove all background color classes before applying a new one
            x.classList.remove("snackbar-green", "snackbar-yellow", "snackbar-red");

            // Update background color and message based on the result
            if(result == "Added to Cart") {
                x.innerHTML = '<i class="fas fa-check" aria-hidden="true"></i>&nbsp;Added to Cart';
                x.classList.add("snackbar-green");
            }
            else if(result == "Already Added to Cart") {
                x.innerHTML = '<i class="fas fa-exclamation" aria-hidden="true"></i>&nbsp;Already Added to Cart';
                x.classList.add("snackbar-yellow");
            }
            else {
                x.innerHTML = '<i class="fas fa-ban" aria-hidden="true"></i>&nbsp;Failed Adding to Cart';
                x.classList.add("snackbar-red");
            }

            // Show the snackbar with the show class
            x.classList.add("show");
            
            // Hide the snackbar after 3 seconds
            setTimeout(function(){ 
                x.classList.remove("show"); 
            }, 3000);
        }
    });
}

    </script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>
