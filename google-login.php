<?php
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Users";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email found, verify password
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Password matches, login success
            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            // Password doesn't match
            echo "Invalid password.";
        }
    } else {
        // Email not found
        echo "No account found with that email.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
