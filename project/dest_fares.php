<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Destinations and Fares - Taxi Rank Web App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
       body {
    font-family: 'Comic Sans MS', cursive, sans-serif;
    background-color: #fceabb;
    color: #333;
    line-height: 1.6;
}

header {
    background-color: #ffb347;
    color: #fff;
    padding: 5px 0;
}


        .container {
            width: 80%;
            margin: auto;
        }

        header h1 {
    font-size: 36px;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

nav ul {
    list-style-type: none;
}

nav ul li {
    display: inline;
    margin-right: 20px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
}

nav ul li a:hover {
    color: #ffd700;
}

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #333;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
<header>
        <div class="container">
            <h1>Taxi Rank Web App - Admin Dashboard</h1>
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

    <section class="view-taxi-destinations-fares">
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <th>Destination</th>
                        <th>Fare in Rands</th>
                       
                    </tr>
                </thead>
                <tbody>
                <?php
                    // Include database connection file
                    include_once "dbconn.php";

                    // Check if rank_id is set in the URL
                    if (isset($_GET["rank_id"]) && !empty($_GET["rank_id"])) {
                        $rank_id = $_GET["rank_id"];

                        // Prepare SQL statement to retrieve destinations and fares for the specified rank_id
                        $sql = "SELECT destination, fare FROM destination_fares WHERE taxi_rank_id = ?";
                        if ($stmt = $conn->prepare($sql)) {
                            $stmt->bind_param("i", $rank_id);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            // Fetch data and display it in table rows
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["destination"] . "</td>";
                                echo "<td>" . $row["fare"] . "</td>";
                                echo "</tr>";
                            }

                            // Close statement
                            $stmt->close();
                        } else {
                            echo "Error: " . $conn->error;
                        }
                    } else {
                        echo "<tr><td colspan='2'>No rank selected</td></tr>";
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