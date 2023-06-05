<!DOCTYPE html>
<html>
<head>
    <title>Feedback Viewer</title>
    <style>
        h1 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>FEEDBACKS</h1>
    <?php
    // Assuming you have already established a database connection
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

    // Retrieve feedback data from the table
    $sql = "SELECT * FROM feedback";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>FID</th><th>Name</th><th>Email</th><th>Mobile</th><th>Subject</th><th>Message</th></tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["FID"] . "</td>";
            echo "<td>" . $row["NAME"] . "</td>";
            echo "<td>" . $row["EMAIL"] . "</td>";
            echo "<td>" . $row["MOB"] . "</td>";
            echo "<td>" . $row["SUBJECT"] . "</td>";
            echo "<td>" . $row["MESSAGE"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No feedbacks found.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
