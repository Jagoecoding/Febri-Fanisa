<?php
session_start();
require 'koneksi.php';

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data pengaturan dari database
$query = "SELECT challenge_update, complete_level, new_milestone, programming_tip, profile_update 
          FROM user_settings 
          WHERE user_id = ?";

if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($challenge_update, $complete_level, $new_milestone, $programming_tip, $profile_update);

    // Jika tidak ada data ditemukan, buat entri baru
    if (!$stmt->fetch()) {
        echo "Tidak ada data ditemukan untuk user_id: $user_id. Membuat data default...";

        $challenge_update = $complete_level = $new_milestone = $programming_tip = $profile_update = 0;

        // Buat data default di tabel
        $insert_query = "INSERT INTO user_settings 
                        (user_id, challenge_update, complete_level, new_milestone, programming_tip, profile_update) 
                        VALUES (?, ?, ?, ?, ?, ?)";

        if ($insert_stmt = $conn->prepare($insert_query)) {
            $insert_stmt->bind_param("iiiiii", $user_id, $challenge_update, $complete_level, $new_milestone, $programming_tip, $profile_update);
            if ($insert_stmt->execute()) {
                echo "Data default berhasil dibuat untuk user_id: $user_id.";
            } else {
                die("Gagal membuat data default: " . $insert_stmt->error);
            }
            $insert_stmt->close();
        } else {
            die("Error mempersiapkan query insert: " . $conn->error);
        }
    }
    $stmt->close();
} else {
    die("Error saat mempersiapkan query select: " . $conn->error);
}

// Pesan notifikasi
$notification_message = isset($_SESSION['notification_message']) ? $_SESSION['notification_message'] : null;
unset($_SESSION['notification_message']);

// Execute Python script for face recognition setup (if applicable)
if (isset($_POST['setup-face-recognition'])) {
    $pythonScriptPath = '/path/to/your/python/script.py'; // Change to your actual script path
    $user_name = $_SESSION['user_name']; // Get the user name from the session
    $output = shell_exec("python3 $pythonScriptPath '$user_name'");
    $_SESSION['notification_message'] = "Face Recognition setup has been completed!"; // Optional: set a notification message for the user
    header("Location: settings.php"); // Redirect back to the settings page
    exit;
}
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
      flex-direction: column;
      align-items: flex-start;
      margin-top: 20px;
    }

    .button {
      padding: 10px 20px;
      border: none;
      border-radius: 20px;
      background-color: #5B47E0;
      color: #FFFFFF;
      cursor: pointer;
      transition: background-color 0.3s;
      margin-bottom: 10px;
      text-align: center;
      font-size: 14px;
      width: 100%;
    }

    .button:hover {
      background-color: #7261F1;
    }

    .setup-button {
      background-color: #007BFF;
    }

    .setup-button:hover {
      background-color: #0056b3;
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

    .inactive-button {
      display: flex;
      align-items: center;
      margin-top: 10px;
    }

    .inactive-button button {
      padding: 10px 20px;
      border: none;
      border-radius: 20px;
      background-color: #FFFFFF;
      color: #000000;
      cursor: pointer;
      margin-right: 10px;
      transition: background-color 0.3s;
    }

    .inactive-button button:hover {
      background-color: #D9D9D9;
    }

    .inactive-label {
      color: #C2C2C2;
    }
  </style>
  <script>
    // Tampilkan notifikasi jika ada pesan
    window.onload = function() {
      const message = "<?php echo $notification_message; ?>";
      if (message) {
        alert(message);
      }
    };
  </script>
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
        <li><a href="profil.php"><img src="element-icon/profil.png" alt="Profile Icon">Profile</a></li>
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
    <h2>Settings</h2>
    <div class="settings-container">
      <!-- Security Section -->
      <div class="section">
        <h3>Security</h3>
        <form action="process_security.php" method="POST">
          <div class="form-group">
            <label for="current-password">Current Password</label>
            <input type="password" id="current-password" name="current-password" placeholder="Enter current password">
          </div>
          <div class="form-group">
            <label for="new-password">New Password</label>
            <input type="password" id="new-password" name="new-password" placeholder="Enter new password">
          </div>
          <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm new password">
          </div>
          <div class="form-group">
            <label for="face-recognition">Enable Face Recognition</label>
            <div class="inactive-button">
              <button type="button">Inactive</button>
            </div>
          </div>
          <div class="button-group">
            <button type="button" class="button setup-button" onclick="window.location.href='face-recognition1.php'">Set Up Now</button>
            <button type="submit" class="button">Save Changes</button>
          </div>
        </form>
      </div>

      <!-- Notification Section -->
      <div class="section">
        <h3>Notification</h3>
        <form action="process_nontifikasi.php" method="POST">
          <div>
            <input type="checkbox" id="challenge-update" name="challenge-update"
              <?php echo $challenge_update == 1 ? 'checked' : ''; ?>>
            <label for="challenge-update">I want to know when a new challenge is available.</label>
          </div>
          <div>
            <input type="checkbox" id="complete-level" name="complete-level"
              <?php echo $complete_level == 1 ? 'checked' : ''; ?>>
            <label for="complete-level">I want to know when I complete a level.</label>
          </div>
          <div>
            <input type="checkbox" id="new-milestone" name="new-milestone"
              <?php echo $new_milestone == 1 ? 'checked' : ''; ?>>
            <label for="new-milestone">I want to know when my rank is updated.</label>
          </div>
          <div>
            <input type="checkbox" id="programming-tip" name="programming-tip"
              <?php echo $programming_tip == 1 ? 'checked' : ''; ?>>
            <label for="programming-tip">I want to know about new programming tips & tricks.</label>
          </div>
          <div>
            <input type="checkbox" id="profile-update" name="profile-update"
              <?php echo $profile_update == 1 ? 'checked' : ''; ?>>
            <label for="profile-update">I want to know when there is an update on my profile.</label>
          </div>
          <div>
            <button type="submit" class="button">Save Changes</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</body>

</html>