<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Assuming you have already established a database connection
        // Replace the database connection details with your own

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "project";

        // Data to be inserted
        $vehicleno = $_POST["vehicleno"];
        $ownername = $_POST["ownername"];
        $address = $_POST["address"];
        $type = $_POST["type"];
        $mob = $_POST["mob"];
        $email = $_POST["email"];
        $model = $_POST["model"];

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement
        $sql = "INSERT INTO vechiclereg (VECHICLENO, OWNERNAME, ADRESS, TYPE, MOB, EMAIL, MODEL)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind the parameters
        $stmt->bind_param("sssssss", $vehicleno, $ownername, $address, $type, $mob, $email, $model);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Data inserted successfully!";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        // Close the statement and the connection
        $stmt->close();
        $conn->close();
    }
    ?>

    <h2>Vehicle Registration Form</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="vehicleno">Vehicle Number:</label>
        <input type="text" name="vehicleno" id="vehicleno" required>

        <label for="ownername">Owner Name:</label>
        <input type="text" name="ownername" id="ownername" required>

        <label for="address">Address:</label>
        <textarea name="address" id="address" rows="4" required></textarea>

        <label for="type">Type:</label>
        <select name="type" id="type" required>
            <option value="LMV">LMV</option>
            <option value="HMV">HMV</option>
        </select>

        <label for="mob">Mobile Number:</label>
        <input type="text" name="mob" id="mob" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="model">Model:</label>
        <input type="text" name="model" id="model" required>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
