<!DOCTYPE html>
<html>
<head>
    <title>Crime Details</title>
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
            background-color: #f2f2f2;
        }
        
        .highlight {
            background-color: yellow;
        }
    </style>
    <script>
        function searchTable() {
            var input = document.getElementById("searchInput").value;
            var table = document.getElementById("crimeTable");
            var rows = table.getElementsByTagName("tr");

            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName("td");
                var found = false;
                
                for (var j = 0; j < cells.length; j++) {
                    if (cells[j].innerHTML.indexOf(input) > -1) {
                        found = true;
                        break;
                    }
                }

                if (found) {
                    rows[i].classList.add("highlight");
                } else {
                    rows[i].classList.remove("highlight");
                }
            }
        }
    </script>
</head>
<body>
    <h1 style="text-align:center">CRIME RECORDS</h1>
    <input type="text" id="searchInput" placeholder="Enter CMNO">
    <button onclick="searchTable()">Search</button>
    <br><br>

    <?php
    // Assuming you have a database connection already established
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

    // Fetching data from the "CRIME" table
    $sql = "SELECT * FROM CRIME";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table id='crimeTable'>";
        echo "<tr><th>CMNO</th><th>VEHICLENO</th><th>CRIMEDONE</th><th>PLACE</th><th>DATE</th><th>PROOF</th><th>NAME</th><th>MOB</th><th>VERIFIED</th></tr>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["CMNO"]."</td>";
            echo "<td>".$row["VEHICLENO"]."</td>";
            echo "<td>".$row["CRIMEDONE"]."</td>";
            echo "<td>".$row["PLACE"]."</td>";
            echo "<td>".$row["DATE"]."</td>";
            echo "<td>".$row["PROOF"]."</td>";
            echo "<td>".$row["NAME"]."</td>";
            echo "<td>".$row["MOB"]."</td>";
            echo "<td>".$row["VERIFIED"]."</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No results found";
    }

    $conn->close();
    ?>
</body>
</html>
