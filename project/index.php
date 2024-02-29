<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Rank Web App</title>
    <link rel="stylesheet" href="css/styles.css">
    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Taxi Rank Web App</h1>
            <nav>
                <ul>
                    <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
                    <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                    <li><a href="contact.php"><i class="fas fa-address-book"></i> Contacts</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="view-search-taxi-ranks">
        <div class="container">
            <h2>View/Search Taxi Ranks</h2>
            <form id="searchTaxiRanksForm" action="#" method="get">
                <input type="text" id="searchInput" name="searchInput" placeholder="Search for a taxi rank">
                <button type="submit"><i class="fas fa-search"></i> Search</button>
            </form>
            <table id="taxiRanksTable">
                <thead>
                    <tr>
                        <th><i class="fas fa-building"></i> Taxi Rank Name</th>
                        <th><i class="fas fa-map-marker-alt"></i> Address</th>
                        <th><i class="fas fa-clock"></i> Operating Hours</th>
                        <th><i class="fas fa-car"></i> Taxi Association</th>
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
                            echo "<td><a href='dest_fares.php?rank_id=" . $row["rank_id"] . "'><i class='fas fa-taxi'></i> " . $row["rank_name"] . "</a></td>";
                            echo "<td><i class='fas fa-map-marker-alt'></i> " . $row["tAddress"] . "</td>";
                            echo "<td><i class='fas fa-clock'></i> " . $row["operating_hours"] . "</td>";
                            echo "<td><i class='fas fa-car'></i> " . $row["taxi_association"] . "</td>";
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
