<?php
// Simulated user data (this could come from a database in a real application)
$user = [
    'name' => '',
    'email' => '',
    'username' => '',
    'phone' => '',
    'bio' => '',
    'profile_picture' => ''
];

// Handle form submissions (for example, updating user profile)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Here you can process form data and update the user details
    // For simplicity, let's assume you're just updating the data below:
    $user['name'] = $_POST['name'];
    $user['email'] = $_POST['email'];
    $user['username'] = $_POST['username'];
    $user['phone'] = $_POST['phone'];
    $user['bio'] = $_POST['bio'];

    // Handle profile picture upload logic here (this is a simple example)
    if (isset($_FILES['profile_picture'])) {
        // Example file upload logic
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], 'uploads/' . $_FILES['profile_picture']['name']);
        $user['profile_picture'] = 'uploads/' . $_FILES['profile_picture']['name'];
    }
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

    .form-group input,
    .form-group textarea {
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

    .button {
      padding: 10px 20px;
      border: none;
      border-radius: 15px;
      background-color: #5B47E0;
      color: #FFFFFF;
      cursor: pointer;
      transition: background-color 0.3s;
      margin-top: 10px;
      margin-left: 2px;
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
        <li><a href="dashboard.php"><img src="element-icon/dashboard.png" alt="Dashboard Icon"> Dashboard</a></li>
        <li><a href="course.php"><img src="element-icon/course.png" alt="Course Icon"> Course</a></li>
        <li><a href="leaderboard.php"><img src="element-icon/leaderboard.png" alt="Leaderboard Icon"> Leaderboard</a></li>
        <li><a href="profil.php"><img src="element-icon/profil.png" alt="Profile Icon"> Profile</a></li>
      </ul>
    </div>
    <div class="settings">
      <ul>
        <li><a href="settings.php"><img src="element-icon/setting.png" alt="Settings Icon"> Settings</a></li>
        <li><a href="help.php"><img src="element-icon/help.png" alt="Help Icon"> Help</a></li>
        <li><a href="login.php"><img src="element-icon/logout.png" alt="Log Out Icon"> Log Out</a></li>
      </ul>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <h2>Edit Profile</h2>
    <form method="POST" enctype="multipart/form-data">
      <div class="settings-container">
        <div class="section">
          <h3>Profile Information</h3>
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
          </div>
          <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
          </div>
          <div class="form-group">
            <label>Bio</label>
            <textarea name="bio"><?php echo htmlspecialchars($user['bio']); ?></textarea>
          </div>
        </div>
        <div class="section">
          <h3>Profile Picture</h3>
          <div class="form-group">
            <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%; margin-bottom: 15px;">
            <input type="file" name="profile_picture">
            <button type="submit" class="button">Upload new photo</button>
          </div>
        </div>
      </div>

      <div class="button-group">
        <button type="submit" class="button">Simpan</button>
        <button type="reset" class="button">Batal</button>
        <button type="button" class="button" onclick="confirm('Are you sure you want to delete your account?')">Hapus akun</button>
      </div>
    </form>
  </div>
</body>
</html>
