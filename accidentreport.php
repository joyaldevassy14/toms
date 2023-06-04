<!DOCTYPE html>
<html>
    <head>
        <title>citizen</title>
  
    <link href="accident.css" rel="stylesheet">
    
    </head>
    <body>
     <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Variables to store form data
        $vehicleNo = $_POST['vehicleNo'];
        $place = $_POST['place'];
        $date = $_POST['date'];
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];

        // Validate required fields
        if (empty($vehicleNo) || empty($place) || empty($date) || empty($name) || empty($mobile)) {
            echo "All fields are required.";
        } else {
            // Database connection details
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

            // Upload file
            $targetDirectory = "proofs/";
            $targetFile = $targetDirectory . basename($_FILES["proof"]["name"]);
            move_uploaded_file($_FILES["proof"]["tmp_name"], $targetFile);
            $proof = $_FILES['proof']['name'];

            // Insert data into the "Accident" table
            $sql = "INSERT INTO Accident (VECHICLENO, PLACE, DATE, PROOF, NAME, MOB) VALUES ('$vehicleNo', '$place', '$date', '$proof', '$name', '$mobile')";

            if ($conn->query($sql) === true) {
                echo "Data inserted successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close the connection
            $conn->close();
        }
    }
    ?>

        <div id="outer">
            <div id="header">
                <a class ="indexa" href="https://www.facebook.com/mvd.socialmedia?__cft__[0]=AZVTKjWz0Vg53GhDzJpfd2NBQwDw0zVx45brLcB19pbZ3iWSkOsEP7xs9Zf_-grC1YZb2oq-wKz25SPNY930RL2_M4uuR63N6awkFHe82nN5kLrd_a5Zfs8hDP3-Y-p4YoOnwP9khe467sNAP0IWXdsUKPpwM-XjizvGuquqPIfevwOmYQ8Kt1h7OyLPCLBSuGroRnnrDQcBC1ZbhY7oLVyJ&__tn__=-UC%2CP-R">
                    <img id="logo" src="facebook.png"></a>
                
                <a class ="indexa" href="https://www.facebook.com/mvd.socialmedia?__cft__[0]=AZVTKjWz0Vg53GhDzJpfd2NBQwDw0zVx45brLcB19pbZ3iWSkOsEP7xs9Zf_-grC1YZb2oq-wKz25SPNY930RL2_M4uuR63N6awkFHe82nN5kLrd_a5Zfs8hDP3-Y-p4YoOnwP9khe467sNAP0IWXdsUKPpwM-XjizvGuquqPIfevwOmYQ8Kt1h7OyLPCLBSuGroRnnrDQcBC1ZbhY7oLVyJ&__tn__=-UC%2CP-R">
                    <img id="logo" src="instagram.png">
                </a>
                <a class ="indexa" href="https://www.facebook.com/mvd.socialmedia?__cft__[0]=AZVTKjWz0Vg53GhDzJpfd2NBQwDw0zVx45brLcB19pbZ3iWSkOsEP7xs9Zf_-grC1YZb2oq-wKz25SPNY930RL2_M4uuR63N6awkFHe82nN5kLrd_a5Zfs8hDP3-Y-p4YoOnwP9khe467sNAP0IWXdsUKPpwM-XjizvGuquqPIfevwOmYQ8Kt1h7OyLPCLBSuGroRnnrDQcBC1ZbhY7oLVyJ&__tn__=-UC%2CP-R">
                    <img id="logo" src="twitter.png">
                </a>
                <a class ="indexa" href="https://www.facebook.com/mvd.socialmedia?__cft__[0]=AZVTKjWz0Vg53GhDzJpfd2NBQwDw0zVx45brLcB19pbZ3iWSkOsEP7xs9Zf_-grC1YZb2oq-wKz25SPNY930RL2_M4uuR63N6awkFHe82nN5kLrd_a5Zfs8hDP3-Y-p4YoOnwP9khe467sNAP0IWXdsUKPpwM-XjizvGuquqPIfevwOmYQ8Kt1h7OyLPCLBSuGroRnnrDQcBC1ZbhY7oLVyJ&__tn__=-UC%2CP-R">
                    <img id="logo" src="youtube new.png">
                </a>
                <a class ="indexa" id="logout"href="home">Logout</a>
            </div>
            <div id="logo2">
                <img id="logotoms" src="download.webp">
                <h2 id="titletoms">Traffic Offence Managament System</h2>
            </div>
            <div id="title">
                <img id="road" src="road.webp">
                <h3 id="titlecitizen">Report Accident</h3>
            </div>


            <div id="b1">
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data" style="position:relative;left:10cm;top:1cm;font-size:x-large">
        <label for="vehicleNo">Vehicle No:</label>
        <input type="text" name="vehicleNo" id="vehicleNo" required><br><br>
        
        <label for="place">Place:</label>
        <input type="text" name="place" id="place" required><br><br>
        
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required><br><br>
        
        <label for="proof">Photo:</label>
        <input type="file" name="proof" id="proof" required><br><br>
        
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br><br>
        
        <label for="mobile">Mobile No:</label>
        <input type="text" name="mobile" id="mobile" required><br><br>
        
        <input type="submit" value="Submit" style="margin-left:2cm">
    </form>

            </div>
            <div id="footer">
                <div id="f1">
                    <iframe width="350" height="315" src="https://www.youtube.com/embed/p9gLMdPYELs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    <h2 class="about">ABOUT US</h2>
                    <hr>
                    <p class="para">The Motor Vehicles Department is regulated by the Government of Kerala in terms of policy formulation and its implementation.  The Department is administered by the Transport Commissioner who is the Head of Department.</p>

                </div>
                <div id="f2">
                    <h2 class="red">HELPDESK</h2>
                    <p class="para">Online Services<br>
                        0471-2328799 (10:15 AM - 05:00 PM)<br>
                        (Lunch break 01:15 P.M - 2:00 P.M)<br>
                        email: ssgcell.mvd@kerala.gov.in</p><br>

                    <h2 class="red">General Enquiry</h2>
                    <p class="para">Public Relation Officer):<br>
                        (10:15 AM - 05:00 PM) (Lunch break 01:15 P.M - 2:00 P.M)<br>>
                        Transport Commissionerate: 0471-2333317<br>
                        e-mail: tcoffice.mvd@kerala.gov.in</p><br>
                    <h2 class="red">RTO / JRTO Contact Numbers</h2><br>
                    <a href="https://mvd.kerala.gov.in/directory">https://mvd.kerala.gov.in/directory</a><br>
                    <h2 class="red">Grievenace</h2>
                    <p class="para">91 88 96 11 00 (10:15 AM - 05:00 PM)<br>
                        (Lunch break 01:15 P.M - 2:00 P.M)<br>
                        email: complaints.mvd.kerala.gov.in</p><br>


                </div>
                <div id="f3">
                    <h2 class="red">Helpdesk</h2>
                    <h2 class="red">Vahan:</h2>
                    <p class="para"> Vehicle Registration/Fitness/Tax/Permit/Fancy, Dealer<br>
                        helpdesk-vahan[at]gov[dot]in,<br>
                        +91-120-2459168    6:00 AM-10:00 PM<br>
                    
                    </p><br>
                    <h2 class="red">Sarathi:</h2>
                    <p class="para">Licence<br>
                        helpdesk-sarathi@gov.in<br>
                        +91-120-2459169    6:00 AM-10:00 PM</p><br>
                    <h2 class="red">eChallan</h2>
                    <p class="para">helpdesk-echallan@gov.in<br>
                        +91-120-2459171    6:00 AM-10:00 PM<br>
                        </p><br>
                    <h2 class="red">mParivahan</h2>
                    <p class="para">helpdesk-mparivahan.gov.in<br>
                        +91-120-2459171    6:00 AM-10:00 PM</p><br>
                </div>

        </div>
        
    </body>
</html>

