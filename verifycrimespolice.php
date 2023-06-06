<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if (isset($_POST['verify'])) {
    $cmno = $_POST['cmno'];

    // Update VERIFIED attribute to 'YES' in CRIME table
    $updateSql = "UPDATE CRIME SET VERIFIED = 'YES' WHERE CMNO = '$cmno'";
    $conn->query($updateSql);

    // Redirect to the same page to refresh the data
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Retrieve data from CRIME table where verified attribute value is 'N'
$sql = "SELECT CMNO, VEHICLENO, CRIMEDONE, PLACE, DATE, PROOF, NAME, MOB, VERIFIED FROM CRIME WHERE VERIFIED = 'N'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crime Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table tr:hover {
            background-color: #f5f5f5;
        }

        form {
            display: inline;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 6px 12px;
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
    <table>
        <tr>
            <th>CMNO</th>
            <th>VEHICLENO</th>
            <th>CRIMEDONE</th>
            <th>PLACE</th>
            <th>DATE</th>
            <th>PROOF</th>
            <th>NAME</th>
            <th>MOB</th>
            <th>VERIFIED</th>
            <th>Verify</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cmno = $row['CMNO'];
                $vehicleno = $row['VEHICLENO'];
                $crimedone = $row['CRIMEDONE'];
                $place = $row['PLACE'];
                $date = $row['DATE'];
                $proof = $row['PROOF'];
                $name = $row['NAME'];
                $mob = $row['MOB'];
                $verified = $row['VERIFIED'];

                ?>

                <tr>
                    <td><?php echo $cmno; ?></td>
                    <td><?php echo $vehicleno; ?></td>
                    <td><?php echo $crimedone; ?></td>
                    <td><?php echo $place; ?></td>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $proof; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $mob; ?></td>
                    <td><?php echo $verified; ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="cmno" value="<?php echo $cmno; ?>">
                            <input type="submit" name="verify" value="Verify">
                        </form>
                    </td>
                </tr>

                <?php
            }
        } else {
            echo "No data found.";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
