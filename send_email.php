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

// Retrieve unpaid challan data from the CHALLAN table with corresponding email addresses
$sql = "SELECT CHALLAN.*, VECHICLEREG.EMAIL
        FROM CHALLAN
        INNER JOIN VECHICLEREG ON CHALLAN.VECHICLENO = VECHICLEREG.VECHICLENO
        WHERE CHALLAN.PAID = 'N'";
$result = $conn->query($sql);

// Loop through the result and send email reminders
while ($row = $result->fetch_assoc()) {
    $to = $row["EMAIL"];
    $subject = "Challan Reminder";
    $message = "Dear vehicle owner,\n\nYou have an unpaid challan with the following details:\n\n";
    $message .= "Challan Number: " . $row["CHNO"] . "\n";
    $message .= "Vehicle Number: " . $row["VECHICLENO"] . "\n";
    $message .= "Driver Name: " . $row["DRIVERNAME"] . "\n";
    $message .= "Crime: " . $row["CRIME"] . "\n";
    $message .= "Fine: " . $row["FINE"] . "\n";
    $message .= "Date: " . $row["DATE"] . "\n";
    $message .= "Place: " . $row["PLACE"] . "\n\n";
    $message .= "Please pay the challan at the earliest.\n\n";
    $headers = "From: joyaldevassy14@gmail.com";

    // Send the email
    mail($to, $subject, $message, $headers);
}

// Close the database connection
$conn->close();
?>
