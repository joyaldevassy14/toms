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

// Fetch data from the "CRIME" table where VERIFIED='N'
$sql = "SELECT * FROM CRIME WHERE VERIFIED='N'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crime Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .verify-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h2>Crime Data</h2>
    <table>
        <tr>
            <th>CMNO</th>
            <th>VEHICLENO</th>
            <th>CRIMEDONE</th>
            <th>PLACE</th>
            <th>DATE</th>
            <th>PROOF</th>
            <th>NAME</th>
            <th>MOB</th>
            <th>VERIFIED</th>
            <th>Verify</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["CMNO"] . "</td>";
                echo "<td>" . $row["VEHICLENO"] . "</td>";
                echo "<td>" . $row["CRIMEDONE"] . "</td>";
                echo "<td>" . $row["PLACE"] . "</td>";
                echo "<td>" . $row["DATE"] . "</td>";
                echo "<td>" . $row["PROOF"] . "</td>";
                echo "<td>" . $row["NAME"] . "</td>";
                echo "<td>" . $row["MOB"] . "</td>";
                echo "<td>" . $row["VERIFIED"] . "</td>";
                echo "<td>
                        <form method='post' action='" . $_SERVER["PHP_SELF"] . "'>
                            <input type='hidden' name='cmno' value='" . $row["CMNO"] . "'>
                            <input type='submit' name='verify' value='Verify' class='verify-btn'>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No records found.</td></tr>";
        }

        // Close the connection
        $conn->close();
        ?>
    </table>
</body>
</html>
