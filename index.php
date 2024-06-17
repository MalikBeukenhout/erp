<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP systeem</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    

    <style>
        /* Additional styles can be placed here for better presentation */
        #section-selector {
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header>
        <h1>Registratie</h1>
    </header>
    <nav id="sidebar" class="sidebar">
        <ul>
            <li><a href="#" onclick="showSection('home')"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="#" onclick="showSection('registreerMedewerkers')"><i class="fas fa-users"></i> Medewerkers</a></li>
            <li><a href="#" onclick="showSection('registreerKlanten')"><i class="fas fa-user-friends"></i> Klanten</a></li>
            <li><a href="#" onclick="showSection('registreerOpdrachten')"><i class="fas fa-tasks"></i> Opdrachten</a></li>
            <li><a href="#" onclick="showSection('registreerWerkzaamheden')"><i class="fas fa-wrench"></i> Werkzaamheden</a></li>
            <li><a href="#" onclick="showSection('overview')"><i class="fas fa-chart-bar"></i> Overzichten</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>

        </ul>
    </nav>

    <main>
        <section id="home" class="hidden">
        </section>
        <section id="registreerMedewerkers" class="hidden">
            <h2>Medewerkers</h2>
            <form id="hours-form-medewerkers" action="Submit_ERP.php" method="post">
                <input type="hidden" name="form_type" value="medewerkers">
                <label for="name">Naam</label>
                <input type="text" id="naam" name="naam" required>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
                <label for="Number">Telefoonnummer:</label>
                <input type="telefoonnummer" id="Number" name="telefoonnummer" required>
                <button type="submit">Opslaan</button>
            </form>
        </section>

        <section id="registreerKlanten" class="hidden">
            <h2>Klanten</h2>
            <form id="hours-form-klanten" action="Submit_ERP.php" method="post">
                <input type="hidden" name="form_type" value="klanten">
                <label for="expense-name">Naam</label>
                <input type="text" id="expense-name" name="name" required>
                <label for="Number">Telefoonnummer:</label>
                <input type="tel" id="Number" name="Telefoonnummer" required>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
                <label for="opdracht">Opdracht</label>
                <input type="text" id="opdracht" name="opdracht" required>
                <label for="expense-description">Beschrijving:</label>
                <textarea id="expense-description" name="description" style="resize: none;"></textarea>
                <button type="submit">Opslaan</button>
            </form>
        </section>

        <section id="registreerOpdrachten" class="hidden">
            <h2>Opdrachten</h2>
            <form id="hours-form-opdrachten" action="Submit_ERP.php" method="post">
                <input type="hidden" name="form_type" value="opdrachten">
                <label for="project-name">Opdracht</label>
                <input type="text" id="project-name" name="project-name" required>
                <label for="project-date">Datum:</label>
                <input type="date" id="project-date" name="project-date" required>
                <label for="project-description">Beschrijving:</label>
                <textarea id="project-description" name="description" style="resize: none;"></textarea>
                <button type="submit">Opslaan</button>
            </form>
        </section>

        <section id="registreerWerkzaamheden" class="hidden">
            <h2>Werkzaamheden</h2>
            <form id="hours-form-werkzaamheden" action="Submit_ERP.php" method="post">
                <input type="hidden" name="form_type" value="werkzaamheden">
                <label for="work-id">Medewerker</label>
                <input type="text" id="work-id" name="work-id" required>
                <label for="work-name">Werk</label>
                <input type="text" id="work-name" name="work-name" required>
                <label for="work-hours">uren</label>
                <input type="text" id="work-hours" name="work-hours" required>
                <label for="work-date">Datum:</label>
                <input type="date" id="work-date" name="work-date" required>
                <label for="work-description">Beschrijving:</label>
                <textarea id="work-description" name="description" style="resize: none;"></textarea>
                <button type="submit">Opslaan</button>
            </form>
        </section>

        <section id="overview" class="hidden">
        <h2>Overzicht</h2>
    <div>
        <label for="section-select">Selecteer sectie:</label>
        <select id="section-select" onchange="updateTable()">
            <option value="medewerkers">Medewerkers</option>
            <option value="klanten">Klanten</option>
            <option value="opdrachten">Opdrachten</option>
            <option value="werkzaamheden">Werkzaamheden</option>
        </select>
    </div>
    <div>
        <label for="search-bar">Zoek:</label>
        <input type="text" id="search-bar" onkeyup="searchTable()" placeholder="Zoek in de tabel...">
    </div>
    <table id="data-table">
        <thead>
            <tr id="table-header-medewerkers" style="display: none;">
                <th>Naam</th>
                <th>Telefoonnummer</th>
                <th>Email</th>
                
            </tr>
            <tr id="table-header-klanten" style="display: none;">
                <th>Naam</th>
                <th>Telefoonnummer</th>
                <th>Email</th>
                <th>Opdracht</th>
                <th>Beschrijving</th>
                
            </tr>
            <tr id="table-header-opdrachten" style="display: none;">
                <th>Opdracht</th>
                <th>Datum</th>
                <th>Beschrijving</th>
                
            </tr>
            <tr id="table-header-werkzaamheden" style="display: none;">
                <th>Medewerker</th>
                <th>Werk</th>
                <th>Uren</th>
                <th>Datum</th>
                <th>Beschrijving</th>
                
            </tr>
        </thead>
        <tbody id="overview-table-body">
            <!-- tabellen -->
        </tbody>
    </table>


    <script>
    document.addEventListener("DOMContentLoaded", function() {
        showSection('overview'); // Show the overview section by default
    });

    function updateTable() {
        var selectBox = document.getElementById("section-select");
        var selectedValue = selectBox.value;
        var tableHeaderMedewerkers = document.getElementById("table-header-medewerkers");
        var tableHeaderKlanten = document.getElementById("table-header-klanten");
        var tableHeaderOpdrachten = document.getElementById("table-header-opdrachten");
        var tableHeaderWerkzaamheden = document.getElementById("table-header-werkzaamheden");

        // Hide all table headers initially
        tableHeaderMedewerkers.style.display = "none";
        tableHeaderKlanten.style.display = "none";
        tableHeaderOpdrachten.style.display = "none";
        tableHeaderWerkzaamheden.style.display = "none";

        // Show the correct table header based on the selected section
        switch (selectedValue) {
            case 'medewerkers':
                tableHeaderMedewerkers.style.display = "table-row";
                // Fetch data for Medewerkers section
                fetch(`fetch_data.php?section=medewerkers`)
                    .then(response => response.json())
                    .then(data => {
                        populateTable(data, ["naam", "telefoonnummer", "email"]);
                    })
                    .catch(error => console.error('Error fetching Medewerkers data:', error));
                break;

            case 'klanten':
                tableHeaderKlanten.style.display = "table-row";
                // Fetch data for Klanten section
                fetch(`fetch_data.php?section=klanten`)
                    .then(response => response.json())
                    .then(data => {
                        populateTable(data, ["naam", "telefoonnummer", "email", "opdracht", "beschrijving"]);
                    })
                    .catch(error => console.error('Error fetching Klanten data:', error));
                break;

            case 'opdrachten':
                tableHeaderOpdrachten.style.display = "table-row";
                // Fetch data for Opdrachten section
                fetch(`fetch_data.php?section=opdrachten`)
                    .then(response => response.json())
                    .then(data => {
                        populateTable(data, ["project", "datum", "beschrijving"]);
                    })
                    .catch(error => console.error('Error fetching Opdrachten data:', error));
                break;

            case 'werkzaamheden':
                tableHeaderWerkzaamheden.style.display = "table-row";
                fetch(`fetch_data.php?section=werkzaamheden`)
                    .then(response => response.json())
                    .then(data => {
                        populateTable(data, ["medewerker", "werk", "uren", "datum", "beschrijving"]);
                    })
                    .catch(error => console.error('Error fetching Werkzaamheden data:', error));
                break;

            default:
                console.error('Invalid section selected');
        }
    }

    function populateTable(data, headers) {
        const tableBody = document.getElementById("overview-table-body");
        const tableHead = document.getElementById("overview-table-head");
        tableBody.innerHTML = ''; // Clear existing table rows

        // Populate the table with fetched data
        data.forEach((row, index) => {
            const tr = document.createElement('tr');
            headers.forEach(header => {
                const td = document.createElement('td');
                td.textContent = row[header];
                tr.appendChild(td);
            });

            tableBody.appendChild(tr);
        });

        // Show the table head (headers) after populating the table body
        tableHead.style.display = "table-row";
    }

    function searchTable() {
        var input = document.getElementById("search-bar");
        var filter = input.value.toLowerCase();
        var table = document.getElementById("data-table");
        var tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (var i = 1; i < tr.length; i++) { // start from 1 to skip table header
            var tdList = tr[i].getElementsByTagName("td");
            var rowContainsFilterText = false;
            for (var j = 0; j < tdList.length; j++) {
                if (tdList[j]) {
                    if (tdList[j].textContent.toLowerCase().indexOf(filter) > -1) {
                        rowContainsFilterText = true;
                        break;
                    }
                }
            }
            if (rowContainsFilterText) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }

    // Function to show the selected section and hide others
    function showSection(sectionId) {
        var sections = document.getElementsByTagName("section");
        for (var i = 0; i < sections.length; i++) {
            sections[i].classList.add("hidden");
        }
        document.getElementById(sectionId).classList.remove("hidden");

        // If the selected section is overview, update the table
        if (sectionId === 'overview') {
            updateTable();
        }
    }
</script>

</body>
</html>