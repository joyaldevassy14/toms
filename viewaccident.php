<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve data from the "accident" table
$sql = "SELECT ACDNO, VECHICLENO, PLACE, DATE, PROOF, NAME, MOB, VERIFIED FROM accident";

// Execute the query
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Create a table and table header
    echo "<style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        tr:hover {
            background-color: #f5f5f5;
        }
        
        .heading {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
        }
    </style>";
    echo "<h2 class='heading'>ACCIDENT RECORD</h2>";
    echo "<table>";
    echo "<tr>";
    echo "<th>ACDNO</th>";
    echo "<th>VECHICLENO</th>";
    echo "<th>PLACE</th>";
    echo "<th>DATE</th>";
    echo "<th>PROOF</th>";
    echo "<th>NAME</th>";
    echo "<th>MOB</th>";
    echo "<th>VERIFIED</th>";
    echo "</tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ACDNO"] . "</td>";
        echo "<td>" . $row["VECHICLENO"] . "</td>";
        echo "<td>" . $row["PLACE"] . "</td>";
        echo "<td>" . $row["DATE"] . "</td>";
        echo "<td>" . $row["PROOF"] . "</td>";
        echo "<td>" . $row["NAME"] . "</td>";
        echo "<td>" . $row["MOB"] . "</td>";
        echo "<td>" . $row["VERIFIED"] . "</td>";
        echo "</tr>";
    }

    // Close the table
    echo "</table>";
} else {
    echo "No data found.";
}

// Close the connection
$conn->close();
?>
