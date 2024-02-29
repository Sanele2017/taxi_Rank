<?php
// Include database connection file
include_once "dbconn.php";

// Check if ID parameter is provided in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Get the ID parameter from the URL
    $id = $_GET['id'];

    // Prepare SQL statement to delete the entry with the provided ID
    $sql = "DELETE FROM destination_fares WHERE id = ?";
    if($stmt = $conn->prepare($sql)) {
        // Bind the ID parameter to the prepared statement
        $stmt->bind_param("i", $id);

        // Execute the statement
        if($stmt->execute()) {
            // Deletion successful
            echo "Entry deleted successfully.";
        } else {
            // Error executing the statement
            echo "Error: Unable to delete the entry.";
        }
        // Close the statement
        $stmt->close();
    } else {
        // Error preparing the statement
        echo "Error: Unable to prepare the deletion statement.";
    }
} else {
    // ID parameter not provided
    echo "Error: No ID provided for deletion.";
}

// Close database connection
$conn->close();
?>
