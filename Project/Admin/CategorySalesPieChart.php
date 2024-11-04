<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");

$xValues = [];
$yValues = [];

// Fetch category names
$selX = "SELECT * FROM tbl_category";
$resX = $con->query($selX);
while ($dataX = $resX->fetch_assoc()) {
    $xValues[] = $dataX['category_name'];

    // Fetch count of items in cart per category
   $selY = "SELECT COUNT(*) as count 
             FROM tbl_cart c 
             INNER JOIN tbl_product p ON p.product_id = c.product_id 
             INNER JOIN tbl_subcategory s ON s.subcategory_id = p.subcategory_id
             WHERE s.category_id= " . $dataX['category_id'] . " 
             AND cart_status BETWEEN 0 AND 5";
    $resY = $con->query($selY);
    $dataY = $resY->fetch_assoc();
    $yValues[] = $dataY['count'];
}

// Encode PHP arrays to JSON for use in JavaScript
$xValuesJson = json_encode($xValues);
$yValuesJson = json_encode($yValues);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Adjust canvas size */
        #myPieChart {
            max-width: 600px;
            max-height: 600px;
        }
        .chart-box{
            display: flex;
            align-items: center;
            flex-direction:column;
        }
    </style>
</head>

<body>
    <div class="chart-box">
    <h1>Pie Chart of Items in Cart by Category</h1>
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
        $selX = "SELECT * FROM tbl_category";
        $resX = $con->query($selX);
        while ($dataX = $resX->fetch_assoc()) {
        $xValues[] = $dataX['category_name'];

    // Fetch count of items in cart per category
        $selY = "SELECT COUNT(*) as count, b.booking_date
             FROM tbl_cart c 
             INNER JOIN tbl_product p ON p.product_id = c.product_id 
             INNER JOIN tbl_subcategory s ON s.subcategory_id = p.subcategory_id
             INNER JOIN tbl_booking b on b.booking_id=c.booking_id
             WHERE s.category_id= " . $dataX['category_id'] . " AND
             b.booking_date BETWEEN '$start' and '$end'
             AND cart_status BETWEEN 0 AND 5";
        $resY = $con->query($selY);
        $dataY = $resY->fetch_assoc();
        $yValues[] = $dataY['count'];
}

// Encode PHP arrays to JSON for use in JavaScript
$xValuesJson = json_encode($xValues);
$yValuesJson = json_encode($yValues);
        
    ?>
    <canvas id="myPieChart" width="400" height="400"></canvas>
    <?php
    }
    ?>
    </div>
    <script>
        // Define the function to generate pastel colors
        function generatePastelBrightColorPalettes(numColors) {
    const fillColors = [];
    const borderColors = [];
    const colorStep = 360 / numColors;
    for (let i = 0; i < numColors; i++) {
        const hue = Math.round(i * colorStep);

        // Generate pastel RGB values for bright colors
        const saturation = 50 + Math.random() * 30; // Adjust the saturation range
        const lightness = 65 + Math.random() * 30;  // Adjust the lightness for pastel effect

        // Corrected template literals for hsla()
        const fillColor = `hsla(${hue}, ${saturation}%, ${lightness}%, 0.65)`; // 0.65 alpha value for fill
        const borderColor = `hsla(${hue}, ${saturation}%, ${lightness}%, 1)`;  // 1 alpha value for border

        fillColors.push(fillColor);
        borderColors.push(borderColor);
    }
    return { fillColors, borderColors };
}


        // Retrieve JSON-encoded data from PHP
        const xValues = <?php echo $xValuesJson; ?>;
        const yValues = <?php echo $yValuesJson; ?>;

        // Generate colors for the pie chart
        const { fillColors, borderColors } = generatePastelBrightColorPalettes(xValues.length);
        
        // Create the pie chart
        const ctx = document.getElementById('myPieChart').getContext('2d');
        const myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: xValues, // Categories
                datasets: [{
                    data: yValues, // Counts
                    backgroundColor: fillColors, // Generated colors
                    borderColor: borderColors,  // Generated colors
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>