<!DOCTYPE html>
<html>
<head>
  <title>User Registration & Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 20px;
    }

    h2 {
      text-align: center;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 8px;
      border-radius: 3px;
      border: 1px solid #ccc;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .message {
      margin-top: 20px;
      text-align: center;
    }

    .message.error {
      color: red;
    }

    .message.success {
      color: green;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>User Registration & Login</h2>

    <?php
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $action = $_POST["action"];

      if ($action === "register") {
        $regName = $_POST["reg-name"];
        $regEmpId = $_POST["reg-emp-id"];
        $regUsername = $_POST["reg-username"];
        $regPassword = $_POST["reg-password"];

        // Additional validation and sanitation can be added here

        // Insert user data into the 'USER' table
        $sql = "INSERT INTO USER (EMPID, NAME, USERNAME, PASSWORD) VALUES ('$regEmpId', '$regName', '$regUsername', '$regPassword')";

        if ($conn->query($sql) === true) {
          // Registration successful
          echo "<p class='message success'>Registration successful!</p>";
        } else {
          // Registration failed
          echo "<p class='message error'>Registration failed: " . $conn->error . "</p>";
        }
      } elseif ($action === "login") {
        $loginUsername = $_POST["login-username"];
        $loginPassword = $_POST["login-password"];

        // Retrieve the user from the 'USER' table
        $sql = "SELECT * FROM USER WHERE USERNAME='$loginUsername' AND PASSWORD='$loginPassword'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
          // Successful login
          echo "<p class='message success'>Login successful!</p>";

          // Redirect to another webpage
          header("Location:indexpolice.html");
          exit();
        } else {
          // Invalid credentials
          echo "<p class='message error'>Invalid username or password</p>";
        }
      }
    }

    // Close the database connection
    $conn->close();
    ?>

    <div class="form-group">
      <h3>Registration</h3>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="action" value="register">
        
        <label for="reg-name">Name:</label>
        <input type="text" id="reg-name" name="reg-name" required>
        
        <label for="reg-emp-id">Employee ID:</label>
        <input type="text" id="reg-emp-id" name="reg-emp-id" required>
        
        <label for="reg-username">Username:</label>
        <input type="text" id="reg-username" name="reg-username" required>
        
        <label for="reg-password">Password:</label>
        <input type="password" id="reg-password" name="reg-password" required>
        
        <input type="submit" value="Register">
      </form>
    </div>

    <div class="form-group">
      <h3>Login</h3>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="action" value="login">
        
        <label for="login-username">Username:</label>
        <input type="text" id="login-username" name="login-username" required>
        
        <label for="login-password">Password:</label>
        <input type="password" id="login-password" name="login-password" required>
        
        <input type="submit" value="Login">
      </form>
    </div>
  </div>
</body>
</html>
