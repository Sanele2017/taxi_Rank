<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Destinations and Fares - Taxi Rank Web App</title>
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
        
        .edit-btn,
        .delete-btn {
            padding: 8px 12px;
            margin-right: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            transition-duration: 0.4s;
        }

        .edit-btn:hover,
        .delete-btn:hover {
            background-color: #45a049;
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
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="add_taxi_rank.php">Add Taxi Rank</a></li>
                    <li><a href="view_taxi_rank.php">View/Search Taxi Ranks</a></li>
                    <li><a href="edit_taxi_rank.php">Edit Taxi Rank Information</a></li>
                    <li><a href="index.php">Logout</a></li>
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
                        <th>Action</th>
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
                        $sql = "SELECT fare_id, destination, fare FROM destination_fares WHERE taxi_rank_id = ?";
                        if ($stmt = $conn->prepare($sql)) {
                            $stmt->bind_param("i", $rank_id);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            // Fetch data and display it in table rows
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["destination"] . "</td>";
                                echo "<td>" . $row["fare"] . "</td>";
                                echo "<td>";
                                echo "<button class='edit-btn' data-id='" . $row["fare_id"] . "'>Edit</button>";
                                echo "<button class='delete-btn' data-id='" . $row["fare_id"] . "'>Delete</button>";
                                echo "</td>";
                                echo "</tr>";
                            }

                            // Close statement
                            $stmt->close();
                        } else {
                            echo "Error: " . $conn->error;
                        }
                    } else {
                        echo "<tr><td colspan='3'>No rank selected</td></tr>";
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
    <script>
        // Function to handle edit button click
        function handleEditButtonClick(id) {
            // Redirect to the edit page with the corresponding entry ID
            window.location.href = 'edit_destination_fare.php?id=' + fare_id;
        }

        // Function to handle delete button click
        function handleDeleteButtonClick(id) {
            // Confirm deletion with the user
            if (confirm('Are you sure you want to delete this entry?')) {
                // Send an AJAX request to delete the entry
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Refresh the page to reflect changes
                            window.location.reload();
                        } else {
                            // Handle error
                            console.error('Error:', xhr.responseText);
                        }
                    }
                };
                xhr.open('DELETE', 'delete_destination_fare.php?id=' + fare_id);
                xhr.send();
            }
        }

        // Attach event listeners to all edit buttons
        var editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                handleEditButtonClick(id);
            });
        });

        // Attach event listeners to all delete buttons
        var deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                handleDeleteButtonClick(id);
            });
        });
    </script>
</body>
</html>
