<?php
// Sample leaderboard data (this should ideally come from your database)
$leaderboardData = [
    ['name' => 'Febri', 'tests' => 350, 'rank' => 1],
    ['name' => 'Vidya', 'tests' => 160, 'rank' => 2],
    ['name' => 'Fika', 'tests' => 95, 'rank' => 3],
    ['name' => 'Billa', 'tests' => 42, 'rank' => 11],
    ['name' => 'Taufik', 'tests' => 74, 'rank' => 4],
    ['name' => 'Evana', 'tests' => 102, 'rank' => 5],
    ['name' => 'Tyas', 'tests' => 98, 'rank' => 6],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JagoeCoding - Leaderboard & Settings</title>
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
      display: flex;
      justify-content: center;
      align-items: flex-start;
      flex-direction: column;
    }

    .leaderboard {
      display: flex;
      justify-content: center;
      gap: 50px;
    }

    .place {
      background-color: #1F183E;
      padding: 20px;
      border-radius: 15px;
      text-align: center;
      width: 120px;
      position: relative;
    }

    .circle {
      width: 80px;
      height: 80px;
      background-color: #5B47E0;
      border-radius: 50%;
      color: #FFFFFF;
      font-size: 24px;
      font-weight: bold;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto 10px;
    }

    .info {
      margin-top: 10px;
    }

    /* Star Styles */
    .stars {
      display: flex;
      justify-content: center;
      margin-bottom: 10px;
    }

    .star {
      width: 15px;
      height: 15px;
      background-color: gold;
      clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
      margin: 0 2px;
    }

    .second .star {
      background-color: silver;
    }

    .third .star {
      background-color: #CD7F32;
      /* Bronze color */
    }

    /* Additional Scores Styles */
    .other-scores {
      background-color: #1F183E;
      padding: 20px;
      border-radius: 15px;
      width: 100%;
      max-width: 500px;
      margin-top: 20px;
    }

    .score {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #2A215A;
      padding: 10px;
      border-radius: 10px;
      margin-bottom: 10px;
    }

    .score .circle {
      width: 40px;
      height: 40px;
      background-color: #5B47E0;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 14px;
    }

    .details {
      margin-left: 10px;
    }

    .details p {
      margin: 2px 0;
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
    <!-- Leaderboard Section -->
    <div class="leaderboard">
      <?php foreach ($leaderboardData as $entry): ?>
        <div class="place <?php echo $entry['rank'] == 1 ? 'first' : ($entry['rank'] == 2 ? 'second' : ($entry['rank'] == 3 ? 'third' : '')); ?>">
          <div class="stars">
            <?php for ($i = 0; $i < ($entry['rank'] == 1 ? 3 : ($entry['rank'] == 2 ? 2 : 1)); $i++): ?>
              <div class="star"></div>
            <?php endfor; ?>
          </div>
          <div class="circle"><?php echo $entry['rank']; ?></div>
          <div class="info">
            <p><?php echo $entry['name']; ?></p>
            <p><?php echo $entry['tests']; ?> Test</p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Additional Scores -->
    <div class="other-scores">
      <?php foreach ($leaderboardData as $entry): ?>
        <?php if ($entry['rank'] > 3): ?>
          <div class="score">
            <div class="circle">#<?php echo $entry['rank']; ?></div>
            <div class="details">
              <p><?php echo $entry['name']; ?></p>
              <p>Test: <?php echo $entry['tests']; ?></p>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</body>

</html>
