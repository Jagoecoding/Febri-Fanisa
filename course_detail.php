<?php
session_start();
include('koneksi.php'); // Include connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Jika belum login, arahkan ke login
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    // Query untuk mengambil detail kursus
    $stmt = $conn->prepare('SELECT * FROM courses WHERE course_id = :course_id');
    $stmt->execute(['course_id' => $course_id]);
    $course = $stmt->fetch();
}

if (!$course) {
    echo 'Course not found!';
    exit;
}
?>

<!-- HTML untuk menampilkan detail kursus -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($course['course_name']); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($course['course_name']); ?></h1>
    <p><?php echo htmlspecialchars($course['course_description']); ?></p>
    <!-- Anda bisa menambahkan fitur seperti "Mulai" atau "Lanjutkan" untuk melanjutkan course -->
</body>
</html>
