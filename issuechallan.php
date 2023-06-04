<!DOCTYPE html>
<html>
<head>
    <title>Retrieve Data from CHALLAN Table</title>
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

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Retrieve Data from CHALLAN Table</h1>

    <?php
    $servername = "localhost"; // Replace with your server name
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "project"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve data from the CHALLAN table based on the inputted vehicle number
    if (isset($_POST['vehicleNumber'])) {
        $vehicleNumber = $_POST['vehicleNumber'];

        $sql = "SELECT * FROM CHALLAN WHERE VEHICLENO = '$vehicleNumber'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>CMNO</th><th>CHNO</th><th>VEHICLENO</th><th>DRIVERNAME</th><th>FINE</th><th>DATE</th><th>PLACE</th><th>PAID</th></tr>";

            // Output the retrieved data
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["CMNO"] . "</td>";
                echo "<td>" . $row["CHNO"] . "</td>";
                echo "<td>" . $row["VEHICLENO"] . "</td>";
                echo "<td>" . $row["DRIVERNAME"] . "</td>";
                echo "<td>" . $row["FINE"] . "</td>";
                echo "<td>" . $row["DATE"] . "</td>";
                echo "<td>" . $row["PLACE"] . "</td>";
                echo "<td>" . $row["PAID"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No records found for the given vehicle number.</p>";
        }
    }

    $conn->close();
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="vehicleNumber">Enter Vehicle Number:</label>
        <input type="text" name="vehicleNumber" id="vehicleNumber" required>
        <br>
        <input type="submit" value="Retrieve Data">
    </form>

</body>
</html>
