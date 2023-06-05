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

// Retrieve unpaid challan data from the CHALLAN table
$sql = "SELECT CHALLAN.*, VECHICLEREG.EMAIL
        FROM CHALLAN
        INNER JOIN VECHICLEREG ON CHALLAN.VECHICLENO = VECHICLEREG.VECHICLENO
        WHERE CHALLAN.PAID = 'N'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Unpaid Challan Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #ddd;
        }
        table th, table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f5f5f5;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
        }
        .message p {
            margin: 0;
            font-weight: bold;
        }
        .button-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .button-container button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h2>Unpaid Challan Data</h2>
    <div class="button-container">
        <button onclick="sendEmails()">REMIND ALL</button>
    </div>

    <?php
    // Check if there are any unpaid rows returned
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>CMNO</th>";
        echo "<th>CHNO</th>";
        echo "<th>Vehicle Number</th>";
        echo "<th>Driver Name</th>";
        echo "<th>Crime</th>";
        echo "<th>Fine</th>";
        echo "<th>Date</th>";
        echo "<th>Place</th>";
        echo "<th>Paid</th>";
        echo "</tr>";

        // Output the unpaid data for each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["CMNO"] . "</td>";
            echo "<td>" . $row["CHNO"] . "</td>";
            echo "<td>" . $row["VECHICLENO"] . "</td>";
            echo "<td>" . $row["DRIVERNAME"] . "</td>";
            echo "<td>" . $row["CRIME"] . "</td>";
            echo "<td>" . $row["FINE"] . "</td>";
            echo "<td>" . $row["DATE"] . "</td>";
            echo "<td>" . $row["PLACE"] . "</td>";
            echo "<td>" . $row["PAID"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";

        echo '<div class="message">';
        echo '<p>Please pay the challan.</p>';
        echo '</div>';
    } else {
        echo '<div class="message">';
        echo '<p>No unpaid data found in the CHALLAN table.</p>';
        echo '</div>';
    }
    ?>

    <script>
        function sendEmails() {
            // AJAX request to send email reminders
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "send_email.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert("Email reminders sent successfully.");
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
