<?php
session_start();
include('koneksi.php');

// Proses login menggunakan email/username dan password
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_username = $_POST['email_or_username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, email, username, password FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email_or_username, $email_or_username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $email, $username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Password salah');</script>";
        }
    } else {
        echo "<script>alert('Email atau username tidak ditemukan');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Face Recognition</title>
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

        /* Form Container - Left Side */
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

        .alternate-login {
            text-align: center;
            margin-bottom: 15px;
        }

        .alternate-login button {
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
            border: none;
            border-radius: 20px;
            background-color: #5B47E0;
            color: #FFFFFF;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .alternate-login button:hover {
            background-color: #7261F1;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #FFFFFF;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #282048;
            color: #FFFFFF;
            font-size: 14px;
        }

        .form-group input::placeholder {
            color: #AAAAAA;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            color: #FFFFFF;
            font-size: 14px;
        }

        .checkbox-group input {
            margin-right: 10px;
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
            color: #0056b3;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Right Section - Title */
        .right-section {
            color: #FFFFFF;
            text-align: right;
        }

        .right-section h1 {
            font-size: 60px;
            font-weight: bold;
            line-height: 1.2;
        }

        .right-section h1 span {
            color: #928EFF;
        }

        .right-section img {
            margin-top: 20px;
            max-width: 300px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Log In</h2>
            <p>Please Enter Your Details</p>
            <div class="alternate-login">
                <form action="google-login.php" method="post">
                    <button type="submit">Log In With Google</button>
                </form>
                <form action="capture_and_authenticate.py" method="post">
                    <button type="button" id="face-login-button">Log In With Face Recognition</button>
                </form>
            </div>
            <p>Or</p>
            <script>
                document.getElementById('face-login-button').addEventListener('click', function() {
                    alert("Please position yourself in front of the camera...");

                    // Create a video element to access the webcam
                    let video = document.createElement('video');
                    let canvas = document.createElement('canvas');
                    let ctx = canvas.getContext('2d');

                    // Access the webcam and stream the video
                    navigator.mediaDevices.getUserMedia({
                            video: true
                        })
                        .then(function(stream) {
                            video.srcObject = stream;
                            video.play();
                            video.onloadedmetadata = function() {
                                // Once the video is ready, start capturing the image
                                setTimeout(function() {
                                    captureImage(video);
                                }, 1000); // Wait for 1 second before capturing image
                            };
                        })
                        .catch(function(error) {
                            console.error("Error accessing webcam:", error);
                            alert('Unable to access webcam.');
                        });

                    function captureImage(videoElement) {
                        // Capture image from the video stream
                        canvas.width = videoElement.videoWidth;
                        canvas.height = videoElement.videoHeight;
                        ctx.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

                        // Convert image to Base64
                        let base64Image = canvas.toDataURL('image/jpeg').split(',')[1]; // Extract base64 string

                        // Send the captured image to Flask for authentication
                        fetch('http://127.0.0.1:5000/authenticate', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    image1: base64Image, // Send captured face as 'image1'
                                    image2: 'referensi.jpg' // Replace this with actual reference image data
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'sukses') {
                                    alert("Login Successful!");
                                    window.location.href = 'dashboard.php'; // Redirect to the dashboard
                                } else {
                                    alert("Login Failed: " + data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Error during face recognition login.');
                            });
                    }
                });
            </script>

            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="email_or_username">Username / Email</label>
                    <input type="text" id="email_or_username" name="email_or_username" placeholder="Enter your username or email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="remember-me" name="remember">
                    <label for="remember-me">Remember me for 30 days</label>
                </div>
                <button type="submit">Log In</button>
            </form>

            <div class="login-link">
                Don’t have an account? <a href="register.php">Sign Up</a>
            </div>
        </div>

        <div class="right-section">
            <h1>WELCOME<br><span>BACK</span></h1>
        </div>
    </div>
</body>

</html>