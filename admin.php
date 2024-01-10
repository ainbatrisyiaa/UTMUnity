<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: green;
            color: white;
            padding: 10px;
            text-align: center;
        }

        nav {
            background-color: #f2f2f2;
            padding: 10px;
        }

        nav a {
            padding: 10px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        p{
            text-align: center;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>

    <nav>
        <a href="#">Events</a>
        <a href="admin_page.php">Donation</a>
        <a href="orgFeedback.php">Feedback</a>
        <!-- Add more navigation links as needed -->
    </nav>
    <p> Total Registered Users </p>
    <div>
        <canvas id="userChart" width="400" height="200"></canvas>
        
    </div>

    <p>Total Donations</p>
<div>
    <canvas id="donationChart" width="400" height="200"></canvas>
</div>

    <?php
        require_once "studentstaffdb.php";

        // Fetch data from the database
        $query = "SELECT category, COUNT(*) as total FROM google GROUP BY category";
        $result = mysqli_query($link, $query);

        // Process data for Chart.js
        $categories = [];
        $totals = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row['category'];
            $totals[] = $row['total'];
        }

        // Close the database connection
        mysqli_close($link);
    ?>

    <script>
        // Use Chart.js to create a pie chart
        var ctx = document.getElementById('userChart').getContext('2d');
        var userChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($categories); ?>,
                datasets: [{
                    data: <?php echo json_encode($totals); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>

<?php
require_once "userdetails.php";

// Fetch data from the database
$result = $conn->query("
    SELECT event_name, SUM(donate) as total_donation
    FROM UserDetails
    GROUP BY event_name
");

// Process data for Chart.js
$event_name = [];
$donate = [];
while ($row = $result->fetch_assoc()) {
    $event_name[] = $row['event_name'];
    $donate[] = $row['total_donation'];
}


// Close the database connection (if needed)
$conn->close();
?>

<script>
// Use Chart.js to create a bar chart for total donations
var ctxDonations = document.getElementById('donationChart').getContext('2d');
var donationChart = new Chart(ctxDonations, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($event_name); ?>,
        datasets: [{
            data: <?php echo json_encode($donate); ?>,
            backgroundColor: [
                'rgba(75, 192, 192, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                // Add more colors as needed
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                // Add more colors as needed
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        barPercentage: 0.5, // Adjust as needed
        categoryPercentage: 0.5 // Adjust as needed
    }
});
</script>



</body>
</html>
