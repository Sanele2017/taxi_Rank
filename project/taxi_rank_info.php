<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Rank Information - Taxi Rank Web App</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Taxi Rank Web App - Taxi Rank Information</h1>
            <nav>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="add_taxi_rank.php">Add Taxi Rank</a></li>
                    <li><a href="view_taxi_rank.php">View/Search Taxi Ranks</a></li>
                    <li><a href="edit_taxi_rank.php">Edit Taxi Rank Information</a></li>
                    <li><a href="index.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="taxi-rank-info">
        <div class="container">
            <h2>Taxi Rank Information</h2>
            <div id="rankInfo">
                <table id="rankInfoTable">
                    <thead>
                        <tr>
                            <th>Taxi Rank Name</th>
                            <th>Address</th>
                            <th>Operating Hou</th>
                            <th>destinations</th>
                        </tr>
                    </thead>
                    <tbody id="taxiRanksBody">
                        <!-- Example taxi rank data will be dynamically added here -->
                        <tr>
                            <td><a href="taxi_rank_info.php?rank_id=1" class="rank-link">Taxi Rank 1</a></td>
                            <td>Address 1</td>
                            <td>9am - 5pm</td>
                            <td>iPTA</td>
                        </tr>
                        <tr>
                            <td><a href="taxi_rank_info.php?rank_id=2" class="rank-link">Taxi Rank 2</a></td>
                            <td>Address 2</td>
                            <td>10am - 6pm</td>
                            <td>Mid</td>
                        </tr>
                        <!-- Add more example data if needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Taxi Rank Web App. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/taxi_rank_info.js"></script>
</body>
</html>
