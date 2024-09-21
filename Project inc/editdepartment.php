<html>
<head>
    <link rel="stylesheet" href="editdepartment.css"> </head>
    </head>
    <body>
    <?php
include 'dbconnect.php';

// Retrieve department ID from URL parameter
$departmentId = $_GET['id'];

// Fetch department data
$sql = "SELECT * FROM department WHERE departmentID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $departmentId);
$stmt->execute();
$result = $stmt->get_result();
$department = $result->fetch_assoc();

// Create edit form
if ($department) {
    echo "<h2>Edit Department</h2>";
    echo "<form method='post' action='editdepartment.php'>";
    echo "<input type='hidden' name='id' value='{$department['departmentID']}'>";
    echo "<label for='departmentName'>Department Name:</label><br>";
    echo "<input type='text' name='departmentName' value='{$department['departmentName']}' required><br>";
    echo "<label for='contactNumber'>Contact Number:</label><br>";
    echo "<input type='text' name='contactNumber' value='{$department['contactNumber']}' required><br><br>";
    echo "<input type='submit' value='Save Changes'>";
    echo "</form>";
} else {
    echo "Department not found.";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated values from form
    $departmentId = $_POST['id'];
    $departmentName = $_POST['departmentName'];
    $contactNumber = $_POST['contactNumber'];
    // ... other fields

    // Update database
    $sql = "UPDATE department SET departmentName = ?, contactNumber = ? WHERE departmentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $departmentName, $contactNumber, $departmentId);
    $stmt->execute();

    // Redirect or display updated data
    header("Location: department.php"); // Assuming a department.php page exists
}
?>
</body>
</html>
