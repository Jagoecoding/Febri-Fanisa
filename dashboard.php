<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Define $isLoggedIn based on session status
$isLoggedIn = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JagoeCoding - Settings</title>
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
            min-height: 100vh;
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
            /* Space between image and text */
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

        header h1 {
            font-size: 30px;
            margin-bottom: 10px;
        }

        header p {
            margin-bottom: 30px;
        }

        .progress-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .progress-circle {
            position: relative;
            width: 150px;
            height: 150px;
            background-color: #28285a;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .progress-value {
            font-size: 24px;
            font-weight: bold;
        }

        .progress-info {
            flex: 2;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 30px;
            padding-left: 1000px;
            position: relative;
            top: -130px;
        }

        .info-icon {
            width: 30px;
            height: 30px;
            margin-bottom: 5px;
        }

        .info-box {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }

        .info-icon {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .info-text {
            margin-top: 10px;
        }

        .info-box span {
            display: block;
            color: #666;
            font-size: 14px;
        }

        .course-section .course {
            display: flex;
            justify-content: space-between;
            background-color: #28285a;
            padding: 20px;
            margin-bottom: 50px;
            border-radius: 10px;
        }

        .course-info {
            display: flex;
            align-items: center;
        }

        .course-info img {
            width: 40px;
            height: 40px;
            margin-right: 20px;
        }

        .course-progress button {
            background-color: #28285a;
            color: #FFFFFF;
            border: 1px solid #6c63ff;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .course-progress button:hover {
            background-color: #6c63ff;
        }

        .new-course {
            display: block;
            margin: 20px auto;
            background-color: #6c63ff;
            color: rgb(255, 255, 255);
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .new-course:hover {
            background-color: #8f85ff;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <h1>JagoeCoding</h1>
            <ul>
                <!-- Dashboard with Image -->
                <li>
                    <a href="dashboard.php">
                        <img src="element-icon/dashboard.png" alt="Dashboard Icon">
                        Dashboard
                    </a>
                </li>
                <!-- Course with Image -->
                <li>
                    <a href="course.php">
                        <img src="element-icon/course.png" alt="Course Icon">
                        Course
                    </a>
                </li>
                <!-- Leaderboard with Image -->
                <li>
                    <a href="leaderboard.php">
                        <img src="element-icon/leaderboard.png" alt="Leaderboard Icon">
                        Leaderboard
                    </a>
                </li>
                <!-- Profile with Image -->
                <li>
                    <a href="profil.php">
                        <img src="element-icon/profil.png" alt="Profile Image">
                        Profile
                    </a>
                </li>
            </ul>
        </div>
        <div class="settings">
            <ul>
                <!-- Settings with Image -->
                <li>
                    <a href="settings.php">
                        <img src="element-icon/setting.png" alt="Settings Icon">
                        Settings
                    </a>
                </li>
                <!-- Help with Image -->
                <li>
                    <a href="help.php">
                        <img src="element-icon/help.png" alt="Help Icon">
                        Help
                    </a>
                </li>
                <!-- Log Out with Image -->
                <li>
                    <a href="Logout.php">
                        <img src="element-icon/logout.png" alt="Log Out Icon">
                        Log Out
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <style>
        .progress-section {
            display: flex;
            /* Mengatur elemen dalam baris */
            align-items: center;
            /* Menyelaraskan elemen secara vertikal */
        }

        .progress-container {
            display: flex;
            /* Mengatur elemen dalam baris */
            align-items: center;
            /* Menyelaraskan elemen secara vertikal */
            gap: 15px;
            /* Jarak antara lingkaran dan teks */
        }

        .progress-circle {
            display: flex;
            /* Menggunakan flexbox untuk lingkaran */
            justify-content: center;
            /* Menyelaraskan nilai ke tengah */
            align-items: center;
            /* Menyelaraskan vertikal */
            width: 150px;
            height: 150px;
            background-color: #28285a;
            border-radius: 50%;
            margin-right: 10px;
            /* Jarak antara lingkaran dan teks */
        }

        .circle {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .progress-value {
            font-size: 24px;
            /* Ukuran font untuk nilai progress */
            color: #FFFFFF;
            font-weight: bold;
        }

        .progress-text {
            color: #FFFFFF;
            /* Warna teks */
        }

        .progress-text h2 {
            font-size: 24px;
            /* Ukuran font untuk judul */
            margin: 0;
            /* Menghilangkan margin default */
        }

        .progress-text span {
            font-weight: bold;
            /* Membuat angka lebih tebal */
        }

        .progress-text p {
            margin-top: 5px;
            /* Jarak antara judul dan deskripsi */
            font-size: 16px;
            /* Ukuran font untuk deskripsi */
            color: #C2C2C2;
            /* Warna deskripsi */
        }

        .progress-section {
            display: flex;
            justify-content: course-info;
            /* Align items closer */
            gap: 20px;
            /* Reduce the gap between the circle and the course section */
            margin-bottom: 2px;
            /* Adjust this to reduce space if necessary */
        }
    </style>
    <!-- Main Content -->
    <main class="main-content">
        <header>
            <h1>Welcome <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p>Halo!! Yuk, lanjutkan perjalanan pendidikannya!</p>
        </header>

        <section class="progress-section">
            <div class="progress-container">
                <div class="progress-circle">
                    <div class="circle">
                        <div class="progress-value">65%</div>
                    </div>
                </div>
                <div class="progress-text">
                    <h2>Progres kamu <span>65%</span></h2>
                    <p>Ayo semangat lagi menuju jagoan sejati!</p>
                </div>
            </div>
        </section>

        <div class="progress-info">
            <div class="info-box">
                <img src="element-icon/test.png" alt="Test Done" class="info-icon">
                <div class="info-text">
                    <span>42</span>
                    <span>Test sudah dilakukan</span>
                </div>
            </div>
            <div class="info-box">
                <img src="element-icon/lead-dashboard.png" alt="Rank" class="info-icon">
                <div class="info-text">
                    <span>11</span>
                    <span>Peringkat kamu hari ini</span>
                </div>
            </div>
        </div>

        <section class="course-section">
            <div class="course">
                <div class="course-info">
                    <img src="element-icon/python_logo.png" alt="Python Course">
                    <p>Python Course</p>
                    <span>Mt. Easy</span>
                </div>
                <div class="course-progress">
                    <span>35%</span>
                    <button onclick="window.location.href='course.php'">Lanjutkan course ></button>
                </div>
            </div>
            <div class="course">
                <div class="course-info">
                    <img src="element-icon/php_logo.png" alt="PHP Course">
                    <p>PHP Course</p>
                    <span>Mt. Easy</span>
                </div>
                <div class="course-progress">
                    <span>20%</span>
                    <button onclick="window.location.href='course.php'">Lanjutkan course ></button>
                </div>
            </div>
        </section>

        <button class="new-course" onclick="window.location.href='newcourse.php'">Tambah course</button>
    </main>
</body>

</html>