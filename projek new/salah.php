<?php
// Optionally, you can include any PHP functionality here, such as session management
session_start();
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

    .main-content h1 {
      font-size: 36px;
      margin-bottom: 20px;
    }

    .main-content h2 {
      font-size: 30px;
      margin-bottom: 20px;
    }

    .code-block {
      background-color: #282048;
      padding: 20px;
      border-radius: 5px;
      color: #FFFFFF;
      margin: 20px 0;
      overflow: auto;
    }

    .button {
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      background-color: #5B47E0;
      color: #FFFFFF;
      cursor: pointer;
      transition: background-color 0.3s;
      margin-top: 20px;
    }

    .button:hover {
      background-color: #7261F1;
    }

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
      background-color: #d8d5e5;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      border-radius: 10px;
      color: #0c0c0c;
      text-align: center;
    }

    .modal-emoji {
      display: block;
      margin: 0 auto;
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-top: 10px;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: white;
      text-decoration: none;
      cursor: pointer;
    }

    img {
      max-width: 100px;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div>
        <h1>JagoeCoding</h1>
        <ul>
            <li><a href="dashboard.php"><img src="element-icon/dashboard.png" alt="Dashboard Icon">Dashboard</a></li>
            <li><a href="course.php"><img src="element-icon/course.png" alt="Course Icon">Course</a></li>
            <li><a href="leaderboard.php"><img src="element-icon/leaderboard.png" alt="Leaderboard Icon">Leaderboard</a></li>
            <li><a href="profile.php"><img src="element-icon/profil.png" alt="Profile Image">Profile</a></li>
        </ul>
    </div>
    <div class="settings">
        <ul>
            <li><a href="settings.php"><img src="element-icon/setting.png" alt="Settings Icon">Settings</a></li>
            <li><a href="help.php"><img src="element-icon/help.png" alt="Help Icon">Help</a></li>
            <li><a href="login.php"><img src="element-icon/logout.png" alt="Log Out Icon">Log Out</a></li>
        </ul>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h1>JagoCoding</h1>
    <h2>Tantangan: Pilih kode yang benar!</h2>
    <p>Sekarang, saatnya uji pemahamanmu! Kamu akan melihat beberapa pilihan kode untuk menampilkan namamu. Pilih kode yang paling benar:</p>

    <div class="code-block">
      <pre>print("Hello, World!")</pre>
    </div>

    <button class="button">Coba Lagi</button>

   <!-- Modal -->
   <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>Ops, coba lagi ya! Perhatikan tanda kutipnya.</p>
      <img src="element-icon/sedih.png" alt="Sad emoji" class="modal-emoji">
      <div class="button-group">
        <a href="esay_level.php"><button class="button">Kembali</button></a>
        <a href="bagian1.php"><button class="button">Coba Lagi</button></a>
      </div>
    </div>
  </div>
  
    <script>
      var modal = document.getElementById("myModal");
      window.onload = function() {
        modal.style.display = "block";
      };

      var span = document.getElementsByClassName("close")[0];
      span.onclick = function() {
        modal.style.display = "none";
      }

      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    </script>
  </div>
</body>
</html>
