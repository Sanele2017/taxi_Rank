<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View/Search Taxi Ranks - Taxi Rank Web App</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Taxi Rank Web App - View/Search Taxi Ranks</h1>
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

    <section class="view-search-taxi-ranks">
        <div class="container">
            <h2>Find your Destiantion</h2>
            <form id="searchTaxiRanksForm" action="#" method="get">
                <input type="text" id="searchInput" name="searchInput" placeholder="Search for a taxi rank">
                <button type="submit">Search</button>
            </form>
            <table id="taxiRanksTable">
                <thead>
                    <tr>
                        <th>Taxi Rank Name</th>
                        <th>Address</th>
                        <th>Operating Hours</th>
                        <th>Taxi Association</th>
                    </tr>
                </thead>
                <tbody id="taxiRanksBody">
                    <!-- Taxi ranks data will be dynamically added here -->
                    <?php
                    // Include database connection file
                    include_once "dbconn.php";

                    // Define search keyword variable
                    $searchKeyword = "";

                    // Check if search input is set
                    if (isset($_GET["searchInput"]) && !empty($_GET["searchInput"])) {
                        $searchKeyword = $_GET["searchInput"];

                        // Prepare SQL statement to retrieve taxi ranks based on search keyword
                        $sql = "SELECT * FROM taxi_ranks WHERE rank_name LIKE '%$searchKeyword%' OR tAddress LIKE '%$searchKeyword%' OR operating_hours LIKE '%$searchKeyword%' OR taxi_association LIKE '%$searchKeyword%'";
                    } else {
                        // Prepare SQL statement to retrieve all taxi ranks
                        $sql = "SELECT * FROM taxi_ranks";
                    }

                    // Execute SQL query
                    $result = $conn->query($sql);

                    // Fetch data and display it in table rows
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><a href='d_f.php?rank_id=" . $row["rank_id"] . "'>" . $row["rank_name"] . "</a></td>";
                            echo "<td>" . $row["tAddress"] . "</td>";
                            echo "<td>" . $row["operating_hours"] . "</td>";
                            echo "<td>" . $row["taxi_association"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No taxi ranks found</td></tr>";
                    }

                    // Close database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Taxi Rank Web App. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
