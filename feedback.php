<!DOCTYPE html>
<html>
    <head>
        <title>
            feedback
        </title>
    </head>
    <link href="citizenscript.css" rel="stylesheet">
    <body>
        <?php
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the table
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $mob = $_POST["mob"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];

        $sql = "INSERT INTO Feedback (NAME, EMAIL, MOB, SUBJECT, MESSAGE)
                VALUES ('$name', '$email', '$mob', '$subject', '$message')";

        if ($conn->query($sql) === true) {
            echo "Thank You for the feedback";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
    ?>

        <div id ="fouter">
            <div id="finner">
                <form id="fform"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <table id="ftable">
                        <tr>
                            <td>
                                <label class="lab"> Name :     </label>
                            </td>
                            <td><input class="txt1" type="text" name="name" required></td>
                        </tr>
                        <tr>
                            <td><label class="lab">Email :</label></td>
                            <td> <input class="txt1"type="e-mail" name="email" required></td>
                        </tr>
                        <tr>
                            <td><label class="lab">Mob No :</label></td>
                            <td> <input class="txt1" type="phone" name="mob" required></td>
                        </tr>
                        <tr>
                            <td><label class="lab">Subject :</label></td>
                            <td> <input class="txt1" type="text" name="subject" required></td>
                        </tr>
                        <tr>
                            <td><label class="lab">Message :</label></td>
                            <td><textarea id="ffft1" name="message" rows="8"cols="40" required>Enter the message here</textarea></td>
                        </tr>
                    </table>
                    <br>
                    <input id="fsub" type="submit">
                </form>
            </div>
        </div>
    </body>
</html>