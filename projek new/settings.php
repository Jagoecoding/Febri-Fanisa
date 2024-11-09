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
            <button type="button" class="button setup-button" onclick="window.location.href='face-recognition.php'">Set Up Now</button>
            <button type="submit" class="button">Save Changes</button>
          </div>
        </form>
      </div>

      <!-- Notification Section -->
      <div class="section">
        <h3>Notification</h3>
        <form action="process_notification.php" method="POST">
          <div class="checkbox-group">
            <input type="checkbox" id="challenge-update" name="challenge-update">
            <label for="challenge-update">I want to know when a new challenge is available.</label>
          </div>
          <div class="checkbox-group">
            <input type="checkbox" id="complete-level" name="complete-level">
            <label for="complete-level">I want to know when I complete a level.</label>
          </div>
          <div class="checkbox-group">
            <input type="checkbox" id="new-milestone" name="new-milestone">
            <label for="new-milestone">I want to know when my rank is updated.</label>
          </div>
          <div class="checkbox-group">
            <input type="checkbox" id="programming-tip" name="programming-tip">
            <label for="programming-tip">I want to know about new programming tips & tricks.</label>
          </div>
          <div class="checkbox-group">
            <input type="checkbox" id="profile-update" name="profile-update">
            <label for="profile-update">I want to know when there is an update on my profile.</label>
          </div>
          <div class="button-group">
            <button type="submit" class="button">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
