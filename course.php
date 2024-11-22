<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "jagocoding";

// try {
//     // Membuat koneksi ke database menggunakan mysqli
//     $conn = new mysqli($servername, $username, $password, $dbname, 3306);

//     // Memeriksa apakah koneksi berhasil
//     if ($conn->connect_error) {
//         throw new Exception("Connection failed: " . $conn->connect_error);
//     }

//     // Menyiapkan query untuk mengambil data kursus
//     $sql = "SELECT course_id, course_name FROM courses";
//     $result = $conn->query($sql);

//     // Memastikan bahwa ada hasil
//     if ($result->num_rows > 0) {
//         // Menyimpan hasil ke dalam array $courses
//         $courses = [];
//         while ($row = $result->fetch_assoc()) {
//             $courses[] = $row;
//         }
//     } else {
//         $courses = []; // Jika tidak ada data, set $courses menjadi array kosong
//     }
// } catch (Exception $e) {
//     echo "Connection failed: " . $e->getMessage();
//     die();
// }
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
            overflow-y: auto;
        }

        .main-content h1 {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .main-content p {
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .card-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            background-color: #1F183E;
            border-radius: 10px;
            padding: 20px;
            width: 250px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            max-width: 100px;
            height: auto;
            margin-bottom: 15px;
        }

        .card h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #FFFFFF;
        }

        .card p {
            font-size: 14px;
            color: #C2C2C2;
            margin-bottom: 15px;
        }

        .button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #5B47E0;
            color: #FFFFFF;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #7261F1;
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
                    <a href="logout.php">
                        <img src="element-icon/logout.png" alt="Log Out Icon">
                        Log Out
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Tentukan langkahmu!</h1>
        <p>Mulai dari sini! Pilih antara PHP, Python, atau Java dan lihat bagaimana kamu bisa jadi programmer keren.</p>
        <div class="card-container">
            <!-- Python Card -->
            <div class="card">
                <img src="element-icon/python_logo.png" alt="Python Logo">
                <h3>Python</h3>
                <p>Serbaguna dan mudah dipelajari. Yuk, mulai coding!</p>
                <a href="tantangan.php"><button class="button">Mulai Course</button></a>
            </div>

            <!-- Java Card -->
            <div class="card">
                <img src="element-icon/java_logo.png" alt="Java Logo">
                <h3>Java</h3>
                <p>Kuasi Java dan buat aplikasi keren. Mulai sekarang!</p>
                <a href="tantangan.php"><button class="button">Mulai Course</button></a>
            </div>

            <!-- PHP Card -->
            <div class="card">
                <img src="element-icon/php_logo.png" alt="PHP Logo">
                <h3>PHP</h3>
                <p>Belajar PHP dan buat situs web dinamis. Yuk, mulai sekarang!</p>
                <a href="tantangan.php"><button class="button">Mulai Course</button></a>
            </div>
        </div>
    </div>
</body>

</html>
