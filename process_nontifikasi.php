<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data dari form
$challenge_update = isset($_POST['challenge-update']) ? 1 : 0;
$complete_level = isset($_POST['complete-level']) ? 1 : 0;
$new_milestone = isset($_POST['new-milestone']) ? 1 : 0;
$programming_tip = isset($_POST['programming-tip']) ? 1 : 0;
$profile_update = isset($_POST['profile-update']) ? 1 : 0;

// Debug data
echo "<pre>";
print_r($_POST);
echo "</pre>";

// Update ke database
$query = "UPDATE user_settings SET 
            challenge_update = ?, 
            complete_level = ?, 
            new_milestone = ?, 
            programming_tip = ?, 
            profile_update = ? 
        WHERE user_id = ?";

if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("iiiiii", $challenge_update, $complete_level, $new_milestone, $programming_tip, $profile_update, $user_id);

    if ($stmt->execute()) {
        $_SESSION['notification_message'] = "Pengaturan berhasil diperbarui.";
        header("Location: settings.php");
        exit;
    } else {
        echo "Error saat eksekusi query: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error saat mempersiapkan query: " . $conn->error;
}

$conn->close();
?>
