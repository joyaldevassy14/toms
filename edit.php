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
    // Get the ACDNO from the hidden field
    $acdno = $_POST["acdno"];

    // Retrieve the data for the selected row
    $sql = "SELECT * FROM accident WHERE ACDNO = '$acdno'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the row data
        $row = $result->fetch_assoc();

        // Display the form to edit the data
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Edit Data</title>
            <style>
                form {
                    max-width: 400px;
                    margin: 0 auto;
                }

                label {
                    display: block;
                    margin-bottom: 5px;
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
            <h2 style="text-align:center">Edit Data</h2>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="hidden" name="acdno" value="<?php echo $row["ACDNO"]; ?>">
                
                <label for="vechicleno">VECHICLENO:</label>
                <input type="text" name="vechicleno" value="<?php echo $row["VECHICLENO"]; ?>" required>
                
                <label for="place">PLACE:</label>
                <input type="text" name="place" value="<?php echo $row["PLACE"]; ?>" required>
                
                <label for="date">DATE:</label>
                <input type="date" name="date" value="<?php echo $row["DATE"]; ?>" required>
                
                <label for="proof">REPORT:</label>
                <input type="file" name="proof" value="<?php echo $row["PROOF"]; ?>" >
                
                <input type="submit" value="Update">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Invalid ACDNO.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $acdno = $_POST["acdno"];
    $vechicleno = $_POST["vechicleno"];
    $place = $_POST["place"];
    $date = $_POST["date"];
    $proof = $_POST["proof"];

    // SQL query to update the data in the "accident" table
    $sql = "UPDATE accident SET VECHICLENO = '$vechicleno', PLACE = '$place', DATE = '$date', PROOF = '$proof' WHERE ACDNO = '$acdno'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Data updated successfully.";
    } else {
        echo "Error updating data: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
