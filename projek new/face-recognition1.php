<?php
// Start the session (optional, to manage user sessions)
session_start();

// Optional: You can check if the user is authenticated or not before showing the page
// if (!isset($_SESSION['user'])) {
//     header('Location: login.php');
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Face Verification</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: radial-gradient(circle at top left, #1c1c3c, #000);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
            position: relative;
        }

        .verification-container {
            background: #1e1e3f;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(255, 255, 255, 0.1), 0 0 15px rgba(106, 90, 205, 0.5);
            text-align: center;
            width: 300px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
        }

        /* Style for decorative icons */
        .top-left-icon,
        .bottom-right-icon {
            position: absolute;
            width: 40px;
            height: 40px;
        }

        .top-left-icon {
            top: -20px;
            left: -20px;
        }

        .bottom-right-icon {
            bottom: -20px;
            right: -20px;
        }

        .verification-container h2 {
            margin-bottom: 20px;
            font-size: 1.5em;
            color: #e0e0ff;
        }

        .verification-container img.face-icon {
            margin-bottom: 20px;
            width: 80px;
            height: auto;
        }

        .verification-container p {
            margin-bottom: 30px;
            color: #bbb;
            font-size: 0.9em;
        }

        .verification-container button {
            width: 120px;
            padding: 10px;
            margin: 5px;
            border: none;
            border-radius: 20px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.3s;
        }

        .proceed-btn {
            background: #6a5acd;
            color: white;
        }

        .proceed-btn:hover {
            background: #5a4abc;
        }

        .skip-btn {
            background: #444;
            color: white;
        }

        .skip-btn:hover {
            background: #333;
        }
    </style>
    <script>
        function proceedToDashboard() {
            window.location.href = 'settings.php'; // Redirect to settings page (PHP)
        }

        function skipToRegister() {
            window.location.href = 'register.php'; // Redirect to registration page (PHP)
        }
    </script>
</head>

<body>
    <div class="verification-container">
        <h2>Register Your Face for Future Logins</h2>

        <!-- Dynamically display user profile image -->
        <img src="<?php echo isset($_SESSION['user_image']) ? $_SESSION['user_image'] : 'image/profil.png'; ?>" alt="Face Icon" class="face-icon">

        <p>Please position your face within the frame to complete registration.</p>

        <!-- Proceed button with PHP redirection -->
        <button class="proceed-btn" onclick="proceedToDashboard()">Proceed</button>

        <!-- Skip button to go to the registration page -->
        <button class="skip-btn" onclick="skipToRegister()">Skip</button>
    </div>
</body>

</html>
