<!DOCTYPE html>
<html>
<head>
    <title>Crime Table</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        input[type="submit"],
        input[name="verify"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            font-size: 14px;
        }

        input[type="submit"]:hover,
        input[name="verify"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
// Database connection parameters
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

// Check if the form is submitted
if (isset($_POST['verify'])) {
    $cmno = $_POST['cmno'];
    $fine = intval($_POST['fine']); // Convert to int

    // Update the value of "verified" for the given CMNO to "yes"
    $updateSql = "UPDATE CRIME SET verified = 'yes' WHERE CMNO = '$cmno'";
    if ($conn->query($updateSql) === TRUE) {
       // echo "Record updated successfully.";

        // Retrieve the data from the selected row
        $selectSql = "SELECT * FROM CRIME WHERE CMNO = '$cmno'";
        $result = $conn->query($selectSql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Prepare the data for insertion into the "CHALLAN" table
            $cmno = intval($row["CMNO"]); // Convert to int
            $vehicleno = $row["VECHICLENO"];
            $crime = $row["CRIMEDONE"];
            $date = $row["DATE"];
            $place = $row["PLACE"];
            $drivername = "UNKNOWN";

            // Insert the data into the "CHALLAN" table
            $insertSql = "INSERT INTO CHALLAN (CMNO, VECHICLENO, DRIVERNAME, CRIME, FINE, DATE, PLACE)
                          VALUES ($cmno, '$vehicleno', '$drivername', '$crime', $fine, '$date', '$place')";
            if ($conn->query($insertSql) === TRUE) {
                //echo "Record inserted successfully into CHALLAN table.";
            } else {
                echo "Error inserting record: " . $conn->error;
            }
        }
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// SQL query to retrieve data from the table where "verified" is "N"
$sql = "SELECT * FROM CRIME WHERE verified = 'N'";
$result = $conn->query($sql);

// Check if any data is returned
if ($result->num_rows > 0) {
    // Display the data in a table
    echo "<table>
            <tr>
                <th>CMNO</th>
                <th>VECHICLENO</th>
                <th>CRIMEDONE</th>
                <th>PLACE</th>
                <th>DATE</th>
                <th>PROOF</th>
                <th>NAME</th>
                <th>MOB</th>
                <th>VERIFIED</th>
                <th>ACTION</th>
            </tr>";

    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["CMNO"]."</td>
                <td>".$row["VECHICLENO"]."</td>
                <td>".$row["CRIMEDONE"]."</td>
                <td>".$row["PLACE"]."</td>
                <td>".$row["DATE"]."</td>
                <td>".$row["PROOF"]."</td>
                <td>".$row["NAME"]."</td>
                <td>".$row["MOB"]."</td>
                <td>".$row["VERIFIED"]."</td>
                <td>
                    <form method='post'>
                        <input type='hidden' name='cmno' value='".$row["CMNO"]."'>
                        <input type='number' name='fine' placeholder='FINE' required>
                        <input type='submit' name='verify' value='Verify'>
                    </form>
                </td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "No data found.";
}

// Close the connection
$conn->close();

?>
</body>
</html>
