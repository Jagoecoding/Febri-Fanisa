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
  <title><?php echo "JagoeCoding - Settings"; ?></title>
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

    .settings-container {
      display: flex;
      justify-content: space-between;
      background: radial-gradient(circle at top left, #2A215A, #0F0A2C);
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
    }

    .section {
      background-color: #1F183E;
      border-radius: 10px;
      padding: 20px;
      width: 45%;
    }

    .section h3 {
      font-size: 20px;
      margin-bottom: 20px;
      color: #FFFFFF;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      color: #FFFFFF;
      font-size: 14px;
      margin-bottom: 8px;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #282048;
      color: #FFFFFF;
      font-size: 14px;
    }

    .button-group {
      display: flex;
      justify-content: flex-end;
      margin-top: 20px;
    }

    .checkbox-group {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .checkbox-group input {
      margin-right: 10px;
    }

    .checkbox-group label {
      color: #C2C2C2;
    }

    .code-block {
      background-color: #e0e0e0;
      padding: 20px;
      border-radius: 5px;
      color: black;
      margin: 50px 0;
    }

    /* New CSS for spacing */
    .step-title {
      margin-top: 30px;
      margin-bottom: 15px;
      font-size: 18px;
      font-weight: bold;
      background-color: #5B47E0;
      color: #FFFFFF;
      border-radius: 10px;
      display: inline-block;
      text-align: center;
    }

    .step-description {
      margin-bottom: 20px;
    }

    h3 {
      margin-bottom: 20px;
      background-color: #5B47E0;
      color: #FFFFFF;
      padding: 10px;
      border-radius: 5px;
    }

    /* Styles for navigation buttons */
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
  <?php
  $title = "JagoeCoding";
  $stepTitle = "Langkah 1: Menampilkan \"Hello, World!\"";
  $stepDescription = "Setiap perjalanan coding dimulai dari sini! Di Python, kamu hanya perlu satu baris kode untuk menampilkan teks di layar.";
  ?>

  <!-- Sidebar -->
  <div class="sidebar">
    <div>
      <h1><?php echo $title; ?></h1>
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
            <img src="element-icon/profil.png" alt="Profile Image">
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
    <h2>Selamat datang di langkah pertama coding-mu!</h2>
    <p>Di sini, kamu akan memulai perjalanan seru dengan Python. Siap buat program pertamamu?<br>
      Yuk, kita mulai dari dasar dan lihat seberapa jauh kamu bisa melangkah!</p>

    <h3 class="step-title"><?php echo $stepTitle; ?></h3>
    <p class="step-description"><?php echo $stepDescription; ?></p>

    <div class="code-block">
      <pre><?php echo "print(\"Hello, World!\")"; ?></pre>
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
      window.location.href = 'esay_level.php';
    });
    document.getElementById('next-button').addEventListener('click', function() {
      window.location.href = 'bagian1.php';
    });
  </script>
</body>

</html>