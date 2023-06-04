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

        // Prepare the SQL statement
        $sql = "SELECT VECHICLENO, OWNERNAME, ADRESS, TYPE, MOB, EMAIL, MODEL, `DATE` FROM vechiclereg WHERE VECHICLENO = '$vehicleno'";

        // Execute the query
        $result = $conn->query($sql);

        // Check if any rows are returned
        if ($result->num_rows > 0) {
            // Display the details in a vertical table format
            echo "<table>";
            while ($row = $result->fetch_assoc()) {
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

            // Print button
            echo '<div class="print-button">';
            echo '<button onclick="printDetails()">Print</button>';
            echo '</div>';
        } else {
            echo "No details found for the provided vehicle number.";
        }
    }

    // Close the connection
    $conn->close();
    ?>
</body>
</html>
