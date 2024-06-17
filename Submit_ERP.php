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

// Check which form was submitted
$form_type = $_POST['form_type'] ?? '';

switch ($form_type) {
    case 'medewerkers':
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO Medewerkers (naam, email, telefoonnummer) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sss", $naam, $telefoonnummer, $email);

        // Set parameters and execute with validation and sanitization
        $naam = htmlspecialchars(strip_tags(trim($_POST['naam'])));
        $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
        $telefoonnummer = htmlspecialchars(strip_tags(trim($_POST['telefoonnummer'])));

        if ($stmt->execute()) {
            echo "New record created successfully for medewerkers";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        break;

    case 'klanten':
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO Klanten (naam, telefoonnummer, email, opdracht, beschrijving) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sssss", $naam, $telefoonnummer, $email, $opdracht, $beschrijving);

        // Set parameters and execute with validation and sanitization
        $naam = htmlspecialchars(strip_tags(trim($_POST['name'])));
        $telefoonnummer = htmlspecialchars(strip_tags(trim($_POST['Telefoonnummer'])));
        $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
        $opdracht = htmlspecialchars(strip_tags(trim($_POST['opdracht'])));
        $beschrijving = htmlspecialchars(strip_tags(trim($_POST['description'])));

        if ($stmt->execute()) {
            echo "New record created successfully for klanten";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        break;

    case 'opdrachten':
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO Opdrachten (project, datum, beschrijving) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sss", $project, $datum, $beschrijving);

        // Set parameters and execute with validation and sanitization
        $project = htmlspecialchars(strip_tags(trim($_POST['project-name'])));
        $datum = htmlspecialchars(strip_tags(trim($_POST['project-date'])));
        $beschrijving = htmlspecialchars(strip_tags(trim($_POST['description'])));

        if ($stmt->execute()) {
            echo "New record created successfully for opdrachten";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        break;

    case 'werkzaamheden':
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO Werkzaamheden (Medewerker, werk, uren, datum, beschrijving) VALUES (?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sssss", $medewerker, $werk, $uren, $datum, $beschrijving);

        // Set parameters and execute with validation and sanitization
        $medewerker = htmlspecialchars(strip_tags(trim($_POST['work-id'])));
        $werk = htmlspecialchars(strip_tags(trim($_POST['work-name'])));
        $uren = htmlspecialchars(strip_tags(trim($_POST['work-hours'])));
        $datum = htmlspecialchars(strip_tags(trim($_POST['work-date'])));
        $beschrijving = htmlspecialchars(strip_tags(trim($_POST['description'])));

        if ($stmt->execute()) {
            echo "New record created successfully for werkzaamheden";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        break;

    default:
        echo "Invalid form submission.";
}

$conn->close();
?>
