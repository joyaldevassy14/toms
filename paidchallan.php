<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve only the paid data from the CHALLAN table
$sql = "SELECT * FROM CHALLAN WHERE PAID = 'Yes'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Paid Challan Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #ddd;
        }
        table th, table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h2>Paid Challan Data</h2>
    <?php
    // Check if there are any paid rows returned
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>CMNO</th>";
        echo "<th>CHNO</th>";
        echo "<th>Vehicle Number</th>";
        echo "<th>Driver Name</th>";
        echo "<th>Crime</th>";
        echo "<th>Fine</th>";
        echo "<th>Date</th>";
        echo "<th>Place</th>";
        echo "<th>Paid</th>";
        echo "</tr>";

        // Output the paid data for each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["CMNO"] . "</td>";
            echo "<td>" . $row["CHNO"] . "</td>";
            echo "<td>" . $row["VECHICLENO"] . "</td>";
            echo "<td>" . $row["DRIVERNAME"] . "</td>";
            echo "<td>" . $row["CRIME"] . "</td>";
            echo "<td>" . $row["FINE"] . "</td>";
            echo "<td>" . $row["DATE"] . "</td>";
            echo "<td>" . $row["PLACE"] . "</td>";
            echo "<td>" . $row["PAID"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No paid data found in the CHALLAN table.";
    }
    ?>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
