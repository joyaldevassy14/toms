<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
        }

        .center {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    // Database connection details
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "project";


    // Establish a connection to the database
    $connection = mysqli_connect($host, $username, $password, $database);

    // Check if the connection was successful
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Initialize variables
    $vehicleNumber = "";
    $sumFine = 0;

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the vehicle number from the user
        $vehicleNumber = $_POST['vehicleNumber'];

        // Retrieve the data from the CHALLAN table
        $query = "SELECT * FROM CHALLAN WHERE VECHICLENO = '$vehicleNumber' AND PAID = 'N'";
        $result = mysqli_query($connection, $query);

        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            // Calculate the sum of the 'FINE' attribute
            while ($row = mysqli_fetch_assoc($result)) {
                $sumFine += $row['FINE'];
            }
        } else {
            echo "No data found for the provided vehicle number.";
        }
    }

    // Handle payment
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['payButton'])) {
        // Update the PAID attribute to 'YES' for all the rows with the provided vehicle number
        $updateQuery = "UPDATE CHALLAN SET PAID = 'YES' WHERE VECHICLENO = '$vehicleNumber' AND PAID = 'N'";
        $updateResult = mysqli_query($connection, $updateQuery);

        if ($updateResult) {
            
            // Redirect to a new page after successful payment
            header("Location: indexpay.html");
            exit;
        } else {
            echo "Payment failed. Please try again.";
        }
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="vehicleNumber">Vehicle Number:</label>
        <input type="text" id="vehicleNumber" name="vehicleNumber" value="<?php echo $vehicleNumber; ?>">
        <button type="submit">Search</button>
    </form>
    <br><br>

    <?php if ($sumFine > 0): ?>
        <table>
            <tr>
                <th>CHNO</th>
                <th>VECHICLENO</th>
                <th>DRIVERNAME</th>
                <th>CRIME</th>
                <th>FINE</th>
                <th>DATE</th>
                <th>PLACE</th>
                <th>PAID</th>
            </tr>

            <?php
            // Output the data rows
            mysqli_data_seek($result, 0); // Reset the result pointer to the beginning
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['CHNO']."</td>";
                echo "<td>".$row['VECHICLENO']."</td>";
                echo "<td>".$row['DRIVERNAME']."</td>";
                echo "<td>".$row['CRIME']."</td>";
                echo "<td>".$row['FINE']."</td>";
                echo "<td>".$row['DATE']."</td>";
                echo "<td>".$row['PLACE']."</td>";
                echo "<td>".$row['PAID']."</td>";
                echo "</tr>";
            }
            ?>

        </table>
            <br><br>
        <div class="center">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="vehicleNumber" value="<?php echo $vehicleNumber; ?>">
                <button type="submit" name="payButton" formtarget="_blank">Pay <?php echo $sumFine; ?></button>
            </form>
        </div>
    <?php endif; ?>

    <?php
    // Close the database connection
    mysqli_close($connection);
    ?>
</body>
</html>
