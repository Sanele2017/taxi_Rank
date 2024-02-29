<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Taxi Rank Web App</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <div class="container">
        <h1><i class="fas fa-taxi"></i> Taxi Rank Web App - Admin Dashboard</h1>
            <nav>
                <ul>
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="index.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="sidebar">
    <div class="container">
        <h2><i class="fas fa-bars"></i>Sanele</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="add_taxi_rank.php"><i class="fas fa-plus-circle"></i> Add Taxi Rank</a></li>
            <li><a href="view_taxi_rank.php"><i class="fas fa-search"></i> View/Search Taxi Ranks</a></li>
            <li><a href="edit_taxi_rank.php"><i class="fas fa-edit"></i> Edit Taxi Rank Information</a></li>
            
        </ul>
    </div>
</section>
    <section class="admin-dashboard">
    <div class="container">
        <h2>Welcome, Admin!</h2>
        <div class="dashboard-content">
            <canvas id="pieChart" width="400" height="400"></canvas>
        </div>
    </div>
</section>


    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Taxi Rank Web App. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // PHP code to fetch data from database
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "sa_ranks";

        // Create connection
        $connection = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Query to get total number of taxi ranks
        $totalTaxiRanksQuery = "SELECT COUNT(*) AS total_taxi_ranks FROM taxi_ranks";
        $totalTaxiRanksResult = mysqli_query($connection, $totalTaxiRanksQuery);
        $row = mysqli_fetch_assoc($totalTaxiRanksResult);
        $totalTaxiRanks = $row['total_taxi_ranks'];

        // Query to get total number of destinations
        $totalDestinationsQuery = "SELECT COUNT(*) AS total_destinations FROM destination_fares";
        $totalDestinationsResult = mysqli_query($connection, $totalDestinationsQuery);
        $row = mysqli_fetch_assoc($totalDestinationsResult);
        $totalDestinations = $row['total_destinations'];
        ?>

        // Data for the pie chart
        var pieData = {
            labels: ["Total Taxi Ranks", "Total Destinations"],
            datasets: [{
                data: [<?php echo $totalTaxiRanks; ?>, <?php echo $totalDestinations; ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Configuration options for the pie chart
        var pieOptions = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Dashboard Statistics'
            }
        };

        // Get the context of the canvas element we want to select
        var ctx = document.getElementById("pieChart").getContext('2d');

        // Create the pie chart
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: pieData,
            options: pieOptions
        });
    </script>
</body>
</html>
