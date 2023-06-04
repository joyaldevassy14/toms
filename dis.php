<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Registration</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <label for="search">Enter Vehicle Number:</label>
        <input type="text" name="search" id="search">
        <input type="submit" value="Search">
    </form>

    <?php
    // Check if the form is submitted
    if (isset($_POST['search'])) {
        // Retrieve the entered vehicle number
        $search = $_POST['search'];

        // Database connection
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'project';

        $conn = new mysqli($host, $username, $password, $database);

        // Check for connection errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the query
        $sql = "SELECT VECHICLENO, OWNERNAME, ADRESS, MOB, MODEL FROM vechiclereg WHERE VECHICLENO = '$search'";
        $result = $conn->query($sql);

        // Check if any rows are returned
        if ($result->num_rows > 0) {
            // Display the data
            echo "<h2><CENTER>Vehicle  Details:</CENTER></h2>";
            echo "<table>";
            echo "<tr><th>Vehicle Number</th><th>Owner Name</th><th>Address</th><th>Mobile</th><th>Model</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['VECHICLENO']."</td>";
                echo "<td>".$row['OWNERNAME']."</td>";
                echo "<td>".$row['ADRESS']."</td>";
                echo "<td>".$row['MOB']."</td>";
                echo "<td>".$row['MODEL']."</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No records found for the entered vehicle number.";
        }

        // Close the database connection
        $conn->close();
    }
    ?>
</body>
</html>
