<?php
// Database connection
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "erp_system"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get section value from GET request
$section = $_GET['section'] ?? '';

switch ($section) {
    case 'medewerkers':
        $sql = "SELECT naam, telefoonnummer, email FROM Medewerkers";
        break;
    case 'klanten':
        $sql = "SELECT naam, telefoonnummer, email, opdracht, beschrijving FROM Klanten";
        break;
    case 'opdrachten':
        $sql = "SELECT project, datum, beschrijving FROM Opdrachten";
        break;
    case 'werkzaamheden':
        $sql = "SELECT medewerker, werk, uren, datum, beschrijving FROM werkzaamheden; 
                ";
        break;
    default:
        $sql = ""; // Invalid section
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(array()); // No results
}

$conn->close();
?>
