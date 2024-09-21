<?php
include 'dbconnect.php';

// Retrieve project ID from URL parameter
$projectId = $_GET['id'] ?? null;

// Check if project ID is valid
if ($projectId) {
    // Fetch project data to verify it exists
    $sql = "SELECT * FROM project WHERE projectID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the project exists
    if ($result->num_rows > 0) {
        // Prepare the delete statement
        $sql = "DELETE FROM project WHERE projectID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $projectId);

        // Execute the deletion
        if ($stmt->execute()) {
            // Redirect back to the project page after successful deletion
            header("Location: project.php");
            exit();
        } else {
            echo "Error deleting project: " . $conn->error;
        }
    } else {
        echo "Project not found.";
    }
} else {
    echo "Invalid project ID.";
}

$conn->close();
?>
