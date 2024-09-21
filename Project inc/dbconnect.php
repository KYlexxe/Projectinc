<?php
$servername = "localhost"; // Replace with your hostname if necessary
$username = "root";
$password = "";
$dbname = "project inc";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>