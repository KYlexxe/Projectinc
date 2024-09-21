<html>
    <head>
    <link rel="stylesheet" href="editproject.css"> </head>
    </head>
    <body>
    <?php
include 'dbconnect.php';
// Retrieve project ID from URL parameter
$projectId = $_GET['id'];

// Fetch project data
$sql = "SELECT * FROM project WHERE projectID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $projectId);
$stmt->execute();
$result = $stmt->get_result();
$project = $result->fetch_assoc();

// Create edit form
if ($project) {
    echo "<h2>Edit Project</h2>";
    echo "<form method='post' action='editproject.php'>";
    echo "<input type='hidden' name='id' value='{$project['projectID']}'>";
    echo "<label for='projectName'>Project Name:</label><br>";
    echo "<input type='text' name='projectName' value='{$project['projectName']}'><br>";
    echo "<label for='startDate'>Start Date:</label><br>";
    echo "<input type='date' name='startDate' value='{$project['startDate']}'><br>";
    echo "<label for='endDate'>End Date:</label><br>";
    echo "<input type='date' name='endDate' value='{$project['endDate']}'><br><br>";
    echo "<input type='submit' value='Save Changes'>";
    echo "</form>";
} else {
    echo "Project not found.";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated values from form
    $projectId = $_POST['id'];
    $projectName = $_POST['projectName'];
    // ... other fields

    // Update database
    $sql = "UPDATE project SET projectName = ? WHERE projectID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $projectName, $projectId);
    $stmt->execute();

    // Redirect or display updated data
    header("Location: project.php"); // Assuming a projects.php page exists
}
?>
</body>
</html>