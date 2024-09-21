<?php
include 'dbconnect.php';

// Retrieve department ID from URL parameter
$departmentId = $_GET['id'] ?? null;

// Check if department ID is valid
if ($departmentId) {
    // Fetch department data to verify it exists
    $sql = "SELECT * FROM department WHERE departmentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $departmentId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the department exists
    if ($result->num_rows > 0) {
        // Prepare the delete statement
        $sql = "DELETE FROM department WHERE departmentID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $departmentId);

        // Execute the deletion
        if ($stmt->execute()) {
            // Redirect back to the department page after successful deletion
            header("Location: department.php");
            exit();
        } else {
            echo "Error deleting department: " . $conn->error;
        }
    } else {
        echo "Department not found.";
    }
} else {
    echo "Invalid department ID.";
}

$conn->close();
?>

