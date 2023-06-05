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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $vechicleno = $_POST["vechicleno"];
    $place = $_POST["place"];
    $date = $_POST["date"];
    $proof = $_POST["proof"];
    $name = "officer"; // Set default value
    $mob = "XXX"; // Set default value
    $verified = "YES"; // Set default value

    // SQL query to insert data into the "accident" table
    $sql = "INSERT INTO accident (VECHICLENO, PLACE, DATE, PROOF, NAME, MOB, VERIFIED)
            VALUES ('$vechicleno', '$place', '$date', '$proof', '$name', '$mob', '$verified')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f5f5f5;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center">REPORT ACCIDENT</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="vechicleno">VECHICLENO:</label>
        <input type="text" name="vechicleno" required>

        <label for="place">PLACE:</label>
        <input type="text" name="place" required>

        <label for="date">DATE:</label>
        <input type="date" name="date" required>

        <label for="proof">REPORT:</label>
        <input type="file" name="proof" required>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
