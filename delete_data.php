<?php
// delete_data.php
include 'config.php'; // Include your database connection script

// Get the JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Validate input
if (!isset($_GET['section'])) {
    echo json_encode(["success" => false, "error" => "Section parameter is missing"]);
    exit();
}

if (!isset($data['id'])) {
    echo json_encode(["success" => false, "error" => "ID parameter is missing"]);
    exit();
}

$section = $_GET['section'];
$id = $data['id'];

$mysqli = db_connect(); // Call your db_connect() function to get a mysqli instance

// Check connection
if ($mysqli->connect_error) {
    echo json_encode(["success" => false, "error" => "Connection failed: " . $mysqli->connect_error]);
    exit();
}

// Sanitize inputs
$section = $mysqli->real_escape_string($section);
$id = $mysqli->real_escape_string($id);

// Construct the delete query
$query = "DELETE FROM $section WHERE id = $id";

// Execute the query
if ($mysqli->query($query) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $mysqli->error]);
}

$mysqli->close();
?>
