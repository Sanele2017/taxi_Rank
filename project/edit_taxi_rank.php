<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Taxi Rank - Taxi Rank Web App</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Taxi Rank Web App - Edit Taxi Rank</h1>
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

    <section class="edit-taxi-rank">
        <div class="container">
            <h2>Edit Taxi Rank</h2>
            <!-- Form for editing taxi rank details -->
            <form id="editTaxiRankForm" action="edit_taxi_rank.php" method="post">
                <div class="form-group">
                    <label for="rankName">Taxi Rank Name</label>
                    <input type="text" id="rankName" name="rankName" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="taxiAssociation">Taxi Association</label>
                    <input type="text" id="taxiAssociation" name="taxiAssociation" required>
                </div>
                <div class="form-group">
                    <label for="operatingHours">Operating Hours</label>
                    <input type="text" id="operatingHours" name="operatingHours" required>
                </div>
                <div class="form-group">
                    <!-- Destination and fare inputs -->
                    <table id="destinationsFares">
                        <thead>
                            <tr>
                                <th>Destination</th>
                                <th>Fare</th>
                            </tr>
                        </thead>
                        <tbody id="destinationsFaresBody">
                            <tr>
                                <td><input type="text" name="destination[]" required></td>
                                <td><input type="text" name="fare[]" required></td>
                            </tr>
                            <!-- Additional rows will be added dynamically using JavaScript -->
                        </tbody>
                    </table>
                    <button type="button" onclick="addDestinationRow()">Add Destination</button>
                </div>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Taxi Rank Web App. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript for adding destination rows -->
    <script>
        function addDestinationRow() {
            var tableBody = document.getElementById("destinationsFaresBody");
            var newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td><input type="text" name="destination[]" required></td>
                <td><input type="text" name="fare[]" required></td>
            `;
            tableBody.appendChild(newRow);
        }
    </script>

<?php
// Include database connection file
include_once "dbconn.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $rankName = $address = $taxiAssociation = $operatingHours = "";
    $destinationFares = [];

    // Validate and sanitize input
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $rankName = test_input($_POST["rankName"]);
    $address = test_input($_POST["address"]);
    $taxiAssociation = test_input($_POST["taxiAssociation"]);
    $operatingHours = test_input($_POST["operatingHours"]);

    // Fetch destinations and fares from form and sanitize
    $destinationInputs = $_POST['destination'];
    $fareInputs = $_POST['fare'];

    foreach ($destinationInputs as $index => $destination) {
        // Check if the destination field is not empty
        if (!empty($destination)) {
            $fare = test_input($fareInputs[$index]);
            if (!empty($fare)) {
                $destinationFares[] = [$destination, $fare];
            }
        }
    }

    
    $sql = "UPDATE taxi_ranks SET rank_name=?, tAddress=?, taxi_association=?, operating_hours=? WHERE rank_id=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssi", $rankName, $address, $taxiAssociation, $operatingHours, $taxiRankId);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Error in preparing SQL statement: " . $conn->error;
    }
    

    
    
    $sql2 = "UPDATE destination_fares SET destination=?, fare=? WHERE taxi_rank_id=? AND fare_id=?";
    if ($stmt2 = $conn->prepare($sql2)) {
        foreach ($destinationFares as $row) {
            $destination = $row[0];
            $fare = $row[1];
            $stmt2->bind_param("ssii", $destination, $fare, $taxiRankId, $destinationId);
            $stmt2->execute();
        }
        $stmt2->close();
    } else {
        echo "Error in preparing SQL statement: " . $conn->error;
    }
    

    // Redirect to success page or display success message
     header("location: edit_taxi_rank.php");
     exit();
}
?>

</body>
</html>
