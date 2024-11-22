<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JagoeCoding - Tantangan Kode</title>
    <style>
        /* Styles go here */
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
            height: 100vh;
            color: #FFFFFF;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #161030;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #FFFFFF;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar li {
            margin: 15px 0;
        }

        .sidebar li a {
            text-decoration: none;
            color: #C2C2C2;
            font-size: 16px;
            display: flex;
            align-items: center;
            padding: 8px 0;
            transition: color 0.3s;
        }

        .sidebar li a img {
            margin-right: 10px;
            width: 24px;
            height: 24px;
        }

        .sidebar li a:hover {
            color: #928EFF;
        }

        .sidebar .settings {
            margin-top: 20px;
            border-top: 1px solid #282048;
            padding-top: 15px;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 30px;
        }

        .main-content h2 {
            font-size: 30px;
            margin-bottom: 20px;
        }

        .code-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .code-block {
            background-color: #333;
            padding: 20px;
            border-radius: 5px;
            margin-right: 10px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .code-block:last-child {
            margin-right: 0;
        }

        .button {
            background-color: #f7fdf7;
            color: rgb(10, 10, 10);
            padding: 15px 32px;
            text-align: center;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0 0;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #5DBE5B;
        }

        .nav-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 250px;
        }

        .nav-button {
            width: 50px;
            height: 50px;
            border: none;
            background-color: #FFFFFF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .nav-button img {
            width: 20px;
            height: 20px;
        }

        .nav-button:hover {
            background-color: #E0E0E0;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <h1>JagoeCoding</h1>
            <ul>
                <li>
                    <a href="dashboard.php">
                        <img src="element-icon/dashboard.png" alt="Dashboard Icon">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="course.php">
                        <img src="element-icon/course.png" alt="Course Icon">
                        Course
                    </a>
                </li>
                <li>
                    <a href="leaderboard.php">
                        <img src="element-icon/leaderboard.png" alt="Leaderboard Icon">
                        Leaderboard
                    </a>
                </li>
                <li>
                    <a href="profil.php">
                        <img src="element-icon/profil.png" alt="Profile Icon">
                        Profile
                    </a>
                </li>
            </ul>
        </div>
        <div class="settings">
            <ul>
                <li>
                    <a href="settings.php">
                        <img src="element-icon/setting.png" alt="Settings Icon">
                        Settings
                    </a>
                </li>
                <li>
                    <a href="help.php">
                        <img src="element-icon/help.png" alt="Help Icon">
                        Help
                    </a>
                </li>
                <li>
                    <a href="login.php">
                        <img src="element-icon/logout.png" alt="Log Out Icon">
                        Log Out
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Tantangan: Pilih kode yang benar!</h2>
        <p>Sekarang, saatnya uji pemahamanmu! Kamu akan melihat beberapa pilihan kode untuk menampilkan namamu. Pilih
            kode yang paling benar:</p>

        <div class="code-container">
            <div class="code-block">
                <pre>
print(Hallo, "Jagoers!")
                </pre>
                <button class="button" onclick="window.location.href='benar.php'">Pilih kode ini</button>
            </div>

            <div class="code-block">
                <pre>
print("Hallo, Jagoers!")
                </pre>
                <button class="button" onclick="window.location.href='salah.php'">Pilih kode ini</button>
            </div>
        </div>

        <div class="nav-buttons">
            <button class="nav-button" id="back-button">
                <img src="element-icon/back.png" alt="Back">
            </button>
            <button class="nav-button" id="next-button">
                <img src="element-icon/next.png" alt="Next">
            </button>
        </div>
    </div>

    <script>
        document.getElementById('back-button').addEventListener('click', function() {
            window.location.href = 'chalange.php';
        });
    </script>
</body>

</html>