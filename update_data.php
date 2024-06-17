<?php
session_start();
include 'db_connect.php'; // Include the database connection script

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    echo json_encode(['success' => false, 'error' => 'User not authenticated']);
    exit();
}

// Assuming form_type and section are passed via URL or another method
$form_type = $_GET['section']; // Ensure you sanitize this input
$data = json_decode(file_get_contents('php://input'), true);

// Check if data is empty or not an array
if (empty($data) || !is_array($data)) {
    echo json_encode(['success' => false, 'error' => 'No data received']);
    exit();
}

// Validate and sanitize ID
$id = isset($data['id']) ? mysqli_real_escape_string($conn, $data['id']) : '';
unset($data['id']); // Remove the ID from the data array since it's not a column to be updated

// Generate SQL query dynamically based on form_type
switch ($form_type) {
    case 'medewerkers':
        $sql = "UPDATE medewerkers SET ";
        break;

    case 'klanten':
        $sql = "UPDATE klanten SET ";
        break;

    case 'opdrachten':
        $sql = "UPDATE opdrachten SET ";
        break;

    case 'werkzaamheden':
        $sql = "UPDATE werkzaamheden SET ";
        break;

    default:
        echo json_encode(['success' => false, 'error' => 'Invalid form type']);
        exit();
}

// Construct the SET part of the SQL query
$set = [];
foreach ($data as $key => $value) {
    $set[] = "$key = '" . mysqli_real_escape_string($conn, $value) . "'";
}

$sql .= implode(", ", $set);
$sql .= " WHERE id = '$id'";

// Execute the SQL query
if (mysqli_query($conn, $sql)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}

mysqli_close($conn);
?>
