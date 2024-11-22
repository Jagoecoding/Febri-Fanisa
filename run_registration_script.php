<?php
// Start the session (if needed)
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get the username from the session
$username = $_SESSION['username'];

// Define the path to the Python script
$pythonScript = 'D:/laragon/laragon/www/Jago-Coding-Face-Recognation-main/face_register.py';

// Command to run the Python script
// Pass the username as a parameter to the Python script
$command = "python $pythonScript $username";

// Execute the command
$output = shell_exec($command);

// Display the output from the Python script (for debugging purposes)
echo "<pre>$output</pre>";
?>
