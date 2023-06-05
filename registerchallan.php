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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $vehicleNo = $_POST["vehicleNo"];
    $driverName = $_POST["driverName"];
    $crime = $_POST["crime"];
    $fine = 0;

    // Determine the fine based on the selected crime option
    switch ($crime) {
        case "No helmet":
            $fine = 500;
            break;
        case "No seatbelt":
            $fine = 250;
            break;
        case "Number Plate Modification":
        case "Rash driving":
        case "No indicator":
            $fine = 300;
            break;
        case "Drunk and driving":
            $fine = 1000;
            break;
        case "Overspeeding":
            $fine = 2000;
            break;
    }

    $place = $_POST["place"];

    // Prepare and execute the SQL statement to insert data into the database
    $sql = "INSERT INTO CHALLAN (VECHICLENO, DRIVERNAME, CRIME, FINE, PLACE)
            VALUES ('$vehicleNo', '$driverName', '$crime', $fine, '$place')";

    if ($conn->query($sql) === true) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>REGISTER CHALLAN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center; /* Center align the heading */
            margin-bottom: 20px;
        }
        form {
            width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Add Challan Data</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="vehicleNo">Vehicle Number:</label>
        <input type="text" name="vehicleNo" required><br>

        <label for="driverName">Driver Name:</label>
        <input type="text" name="driverName" required><br>

        <label for="crime">Crime:</label>
        <select name="crime">
            <option value="No helmet">No helmet</option>
            <option value="No seatbelt">No seatbelt</option>
            <option value="Number Plate Modification">Number Plate Modification</option>
            <option value="No indicator">No indicator</option>
            <option value="Rash driving">Rash driving</option>
            <option value="Drunk and driving">Drunk and driving</option>
            <option value="Overspeeding">Overspeeding</option>
        </select><br>

        <label for="place">Place:</label>
        <input type="text" name="place" required><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
