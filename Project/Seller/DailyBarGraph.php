<?php
session_start();
include("../Assets/Connection/Connection.php");
include("Head.php");
// Query to get the total income and expenses grouped by month
$qry = "
    SELECT 
        MONTH(daily_datetime) AS month, 
        SUM(CASE WHEN daily_type = 'INCOME' THEN daily_amt ELSE 0 END) AS total_income,
        SUM(CASE WHEN daily_type = 'EXPENSE' THEN daily_amt ELSE 0 END) AS total_expense
    FROM tbl_daily
    WHERE seller_id = ".$_SESSION['sid']." 
    GROUP BY MONTH(daily_datetime)
    ORDER BY MONTH(daily_datetime);
";

$result = $con->query($qry);

// Arrays to store data for chart
$months = [];
$income = [];
$expenses = [];

// Fetching the data
while ($data = $result->fetch_assoc()) {
    $months[] = date("F", mktime(0, 0, 0, $data['month'], 1)); // Convert month number to name
    $income[] = $data['total_income'];
    $expenses[] = $data['total_expense'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Income & Expense</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Monthly Income & Expense Report</h2>
        <canvas id="incomeExpenseChart"></canvas>
    </div>

    <script>
        // Prepare the data for Chart.js
        const labels = <?php echo json_encode($months); ?>;
        const incomeData = <?php echo json_encode($income); ?>;
        const expenseData = <?php echo json_encode($expenses); ?>;
        
        const data = {
            labels: labels,
            datasets: [
                {
                    label: 'Income',
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    data: incomeData
                },
                {
                    label: 'Expense',
                    backgroundColor: 'rgba(255, 99, 132, 0.7)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    data: expenseData
                }
            ]
        };

        // Chart configuration
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Amount'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Monthly Income and Expense Overview'
                    }
                }
            }
        };

        // Render the chart
        const incomeExpenseChart = new Chart(
            document.getElementById('incomeExpenseChart'),
            config
        );
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include("Foot.php");
?>
