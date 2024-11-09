<?php
// Include the database connection file
include('koneksi.php');

if (isset($_POST['register'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Validate password confirmation
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Hash the password for secure storage
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert user data into the database
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters to the prepared statement
            $stmt->bind_param("sss", $name, $email, $hashedPassword);

            // Execute the query
            if ($stmt->execute()) {
                echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<script>alert('Error preparing the query');</script>";
        }
    }
    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - Face Recognition</title>
  <style>
    /* General reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Arial', sans-serif;
    }

    body {
      background-color: #0F0A2C;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      overflow: hidden;
    }

    .container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 80%;
      max-width: 1000px;
    }

    /* Left Section - Title */
    .left-section {
      color: #FFFFFF;
      text-align: left;
    }

    .left-section h1 {
      font-size: 60px;
      font-weight: bold;
      line-height: 1.2;
    }

    .left-section h1 span {
      color: #928EFF;
    }

    .left-section img {
      margin-top: 20px;
      max-width: 300px;
    }

    /* Form Container */
    .form-container {
      background-color: #1F183E;
      padding: 40px 30px;
      border-radius: 15px;
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
      width: 400px;
    }

    .form-container h2 {
      color: #FFFFFF;
      text-align: center;
      font-size: 24px;
      margin-bottom: 5px;
    }

    .form-container p {
      color: #CCCCCC;
      text-align: center;
      font-size: 14px;
      margin-bottom: 25px;
    }

    .box-input {
      margin-bottom: 20px;
    }

    .box-input label {
      display: block;
      color: #FFFFFF;
      font-size: 14px;
      margin-bottom: 8px;
    }

    .box-input input {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 5px;
      background-color: #282048;
      color: #FFFFFF;
      font-size: 14px;
    }

    .box-input input::placeholder {
      color: #AAAAAA;
    }

    .form-container button {
      width: 100%;
      padding: 15px;
      border: none;
      border-radius: 20px;
      background-color: #5B47E0;
      color: #FFFFFF;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .form-container button:hover {
      background-color: #7261F1;
    }

    .login-link {
      text-align: center;
      margin-top: 15px;
      color: #9E9E9E;
      font-size: 13px;
    }

    .login-link a {
      color: #1E90FF;
      text-decoration: none;
    }

    .login-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Left section with the title -->
    <div class="left-section">
      <h1>CREATE<br><span>ACCOUNT</span></h1>
    </div>

    <!-- Form container -->
    <div class="form-container">
      <h2>Sign Up</h2>
      <p>Please Enter Your Details</p>
      <form action="" method="post">
        <div class="box-input">
          <label for="name">Name</label>
          <input type="text" name="name" placeholder="Enter your name" required>
        </div>
        <div class="box-input">
          <label for="email">Email</label>
          <input type="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="box-input">
          <label for="password">Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="box-input">
          <label for="confirm-password">Confirm Password</label>
          <input type="password" name="confirm-password" placeholder="Confirm your password" required>
        </div>
        <button type="submit" name="register">Sign Up</button>
        <div class="login-link">
          Already have an account? <a href="login.php">Log In</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
