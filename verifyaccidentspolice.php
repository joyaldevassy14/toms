<!DOCTYPE html>
<html>
<head>
    <title>Accident Records</title>
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
            background-color: #4CAF50;
            color: white;
        }

        .verify-button {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .edit-button {
            background-color: #2196F3;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .verified {
            background-color: #ccc;
            color: #555;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center">Accident Records</h2>
    <table>
        <tr>
            <th>ACDNO</th>
            <th>VECHICLENO</th>
            <th>PLACE</th>
            <th>DATE</th>
            <th>PROOF</th>
            <th>NAME</th>
            <th>MOB</th>
            <th>VERIFIED</th>
            <th>Action</th>
        </tr>

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
            if (isset($_POST["acdno"]) && isset($_POST["verified"])) {
                $acdno = $_POST["acdno"];
                $verified = $_POST["verified"];

                // SQL query to update the "verified" value in the "accident" table
                $sql = "UPDATE accident SET VERIFIED = '$verified' WHERE ACDNO = '$acdno'";

                // Execute the query
                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully.";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
        }

        // SQL query to retrieve rows with verified value as 'N'
        $sql = "SELECT * FROM accident WHERE VERIFIED = 'N'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ACDNO"] . "</td>";
                echo "<td>" . $row["VECHICLENO"] . "</td>";
                echo "<td>" . $row["PLACE"] . "</td>";
                echo "<td>" . $row["DATE"] . "</td>";
                echo "<td>" . $row["PROOF"] . "</td>";
                echo "<td>" . $row["NAME"] . "</td>";
                echo "<td>" . $row["MOB"] . "</td>";
                echo "<td>" . $row["VERIFIED"] . "</td>";
                echo "<td>";
                echo "<form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
                echo "<input type='hidden' name='acdno' value='" . $row["ACDNO"] . "'>";
                echo "<input type='hidden' name='verified' value='YES'>";
                echo "<button class='verify-button' type='submit'>" . ($row["VERIFIED"] == "N" ? "VERIFY" : "VERIFIY") . "</button>";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<form method='post' action='edit.php'>";
                echo "<input type='hidden' name='acdno' value='" . $row["ACDNO"] . "'>";
                echo "<button class='edit-button' type='submit'>Edit</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No records found.</td></tr>";
        }

        // Close the connection
        $conn->close();
        ?>
    </table>
</body>
</html>
