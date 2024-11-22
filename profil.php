<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}
include 'koneksi.php';

$user_id = $_SESSION['user_id'];

// Check and add columns if they do not exist
$requiredColumns = ['name', 'phone', 'bio', 'profile_picture'];
foreach ($requiredColumns as $column) {
  $checkColumn = $conn->query("SHOW COLUMNS FROM `users` LIKE '$column'");
  if ($checkColumn->num_rows == 0) {
    $alterTable = "ALTER TABLE `users` ADD `$column` " . ($column === 'phone' ? "VARCHAR(15)" : ($column === 'bio' ? "TEXT" : "VARCHAR(255)"));
    $conn->query($alterTable);
  }
}

// Retrieve user profile data from the database
$sql = "SELECT username, email, name, phone, bio, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Account Deletion Logic
  if (isset($_POST['delete_account'])) {
    $deleteSql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
      session_destroy();
      echo "<script>alert('Akun berhasil dihapus.'); window.location.href = 'register.php';</script>";
      exit();
    } else {
      $errorMessage = "Gagal menghapus akun: " . $conn->error;
    }
    $stmt->close();
  } else {
    // Save Changes Logic
    $user['name'] = $_POST['name'];
    $user['phone'] = $_POST['phone'];
    $user['bio'] = $_POST['bio'];

    // Profile Picture Upload Logic
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
      $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
      $fileType = mime_content_type($_FILES['profile_picture']['tmp_name']);

      if (in_array($fileType, $allowedTypes)) {
        $targetDir = 'uploads/';
        if (!is_dir($targetDir)) {
          mkdir($targetDir, 0777, true);
        }

        $fileName = basename($_FILES['profile_picture']['name']);
        $targetFile = $targetDir . uniqid() . "_" . $fileName;
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile)) {
          $user['profile_picture'] = $targetFile;
        } else {
          $errorMessage = "Gagal mengunggah gambar.";
        }
      } else {
        $errorMessage = "Tipe file tidak valid. Hanya gambar yang diizinkan (JPEG, PNG, GIF).";
      }
    }

    // Update profile data in the database (excluding username and email)
    $updateSql = "UPDATE users SET name = ?, phone = ?, bio = ?, profile_picture = ? WHERE id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssssi", $user['name'], $user['phone'], $user['bio'], $user['profile_picture'], $user_id);

    if ($stmt->execute()) {
      echo "<script>alert('Profil berhasil diperbarui!');</script>";
    } else {
      echo "<script>alert('Terjadi kesalahan: " . $conn->error . "');</script>";
    }
    $stmt->close();
  }
}
$conn->close();

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
            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" readonly>
          </div>
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" required>
          </div>
          <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
          </div>
          <div class="form-group">
            <label>Bio</label>
            <textarea name="bio"><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>
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
        <button type="submit" class="button" onclick="return confirmSave()">Simpan</button>
        <button type="reset" class="button">Batal</button>
        <button type="submit" name="delete_account" class="button" onclick="return confirm('Apakah Anda yakin ingin menghapus akun?')">Hapus akun</button>
      </div>
    </form>
  </div>

  <script>
    <?php if (!empty($errorMessage)) : ?>
      alert("<?php echo $errorMessage; ?>");
    <?php endif; ?>

    function confirmSave() {
      return confirm('Apakah kamu yakin ingin menyimpan perubahan ?');
    }
  </script>
</body>
</html>