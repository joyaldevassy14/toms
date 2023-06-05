<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 5px;
        }

        .form-container label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }

        .form-container input[type="text"],
        .form-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-container button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td {
            vertical-align: top;
        }

        .print-button {
            text-align: center;
            margin-top: 20px;
        }

        .print-button button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
    <script>
        function printDetails() {
            window.print();
        }
    </script>
</head>
<body>
    <h2>Vehicle Details</h2>
    <div class="form-container">
        <form method="POST">
            <label for="vehicleno">Enter Vehicle Number:</label>
            <input type="text" id="vehicleno" name="vehicleno" required>
            <button type="submit">Submit</button>
        </form>
    </div>
    <br>
    <br>
    <?php
    // Assuming you have already established a database connection
    // Replace the database connection details with your own

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form is submitted and vehicle number is provided
    if (isset($_POST["vehicleno"])) {
        // Sanitize the input to prevent SQL injection
        $vehicleno = mysqli_real_escape_string($conn, $_POST["vehicleno"]);

        // Prepare the SQL statement for fetching vehicle details from vechiclereg table
        $vehicleSql = "SELECT VECHICLENO, OWNERNAME, ADRESS, TYPE, MOB, EMAIL, MODEL, `DATE` FROM vechiclereg WHERE VECHICLENO = '$vehicleno'";

        // Execute the query to fetch vehicle details
        $vehicleResult = $conn->query($vehicleSql);

        // Check if any rows are returned
        if ($vehicleResult->num_rows > 0) {
            // Display the vehicle details in a table format
            echo "<table>";
            while ($row = $vehicleResult->fetch_assoc()) {
                echo "<tr><th>Vehicle Number</th><td>" . $row["VECHICLENO"] . "</td></tr>";
                echo "<tr><th>Owner Name</th><td>" . $row["OWNERNAME"] . "</td></tr>";
                echo "<tr><th>Address</th><td>" . $row["ADRESS"] . "</td></tr>";
                echo "<tr><th>Type</th><td>" . $row["TYPE"] . "</td></tr>";
                echo "<tr><th>Mobile Number</th><td>" . $row["MOB"] . "</td></tr>";
                echo "<tr><th>Email</th><td>" . $row["EMAIL"] . "</td></tr>";
                echo "<tr><th>Model</th><td>" . $row["MODEL"] . "</td></tr>";
                echo "<tr><th>Date</th><td>" . $row["DATE"] . "</td></tr>";
            }
            echo "</table>";

            // Fetching and displaying the details from the "accident" table
            $accidentSql = "SELECT ACDNO, PLACE, DATE, NAME, MOB, VERIFIED FROM accident WHERE VECHICLENO = '$vehicleno'";
            $accidentResult = $conn->query($accidentSql);
            echo"<br>";
            echo"<br>";
            if ($accidentResult->num_rows > 0) {
                echo "<h3 style='text-align: center;'>Accident Details</h3>";
                echo "<table>";
                echo "<tr><th>ACDNO</th><th>VECHICLENO</th><th>PLACE</th><th>DATE</th><th>NAME</th><th>MOB</th><th>VERIFIED</th></tr>";
                while ($row = $accidentResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ACDNO"] . "</td>";
                    echo "<td>" . $vehicleno . "</td>";
                    echo "<td>" . $row["PLACE"] . "</td>";
                    echo "<td>" . $row["DATE"] . "</td>";
                    echo "<td>" . $row["NAME"] . "</td>";
                    echo "<td>" . $row["MOB"] . "</td>";
                    echo "<td>" . $row["VERIFIED"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='text-align: center;'>No accident details found for the provided vehicle number.</p>";
            }

            // Fetching and displaying the details from the "challan" table
            $challanSql = "SELECT CMNO, CHNO, VECHICLENO, DRIVERNAME, CRIME, FINE, DATE, PLACE, PAID FROM challan WHERE VECHICLENO = '$vehicleno'";
            $challanResult = $conn->query($challanSql);
            echo"<br>";
            echo"<br>";
            if ($challanResult->num_rows > 0) {
                echo "<h3 style='text-align: center;'>Challan Details</h3>";
                echo "<table>";
                echo "<tr><th>CMNO</th><th>CHNO</th><th>VECHICLENO</th><th>DRIVERNAME</th><th>CRIME</th><th>FINE</th><th>DATE</th><th>PLACE</th><th>PAID</th></tr>";
                while ($row = $challanResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["CMNO"] . "</td>";
                    echo "<td>" . $row["CHNO"] . "</td>";
                    echo "<td>" . $vehicleno . "</td>";
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
                echo "<p style='text-align: center;'>No challan details found for the provided vehicle number.</p>";
            }
            echo"<br>";
            echo"<br>";
            // Print button
            echo '<div class="print-button">';
            echo '<button onclick="printDetails()">Print</button>';
            echo '</div>';
        } else {
            echo "<p style='text-align: center;'>No details found for the provided vehicle number.</p>";
        }
    }

    // Close the connection
    $conn->close();
    ?>
</body>
</html>
