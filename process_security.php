<?php
session_start();
require 'koneksi.php'; // Koneksi ke database Anda

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data dari form
$current_password = $_POST['current-password'];
$new_password = $_POST['new-password'];
$confirm_password = $_POST['confirm-password'];
$face_recognition = isset($_POST['face-recognition']) ? 1 : 0;

// Verifikasi kata sandi saat ini
$query = "SELECT password FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($stored_password);
$stmt->fetch();

// Pastikan kita telah selesai dengan query pertama sebelum mengeksekusi query kedua
$stmt->close(); // Menutup statement setelah selesai dengan hasilnya

if (password_verify($current_password, $stored_password)) {
    // Cek apakah kata sandi baru sesuai
    if ($new_password === $confirm_password) {
        // Enkripsi kata sandi baru
        $new_password_hashed = password_hash($new_password, PASSWORD_BCRYPT);

        // Update kata sandi pengguna
        $update_password_query = "UPDATE users SET password = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_password_query);
        $update_stmt->bind_param("si", $new_password_hashed, $user_id);
        $update_stmt->execute();
        $update_stmt->close(); // Menutup statement setelah selesai dengan query ini
    } else {
        // Jika kata sandi tidak cocok, tampilkan pesan error
        echo "<script>
                alert('Kata sandi baru tidak sesuai!');
                window.location.href = 'setting.php'; // Redirect ke halaman setting.php
            </script>";
        exit;
    }

    // Update pengaturan wajah
    // Query untuk update pengaturan wajah
    $update_face_recognition_query = "UPDATE user_settings SET face_recognition_enabled = ? WHERE user_id = ?";
    $update_face_stmt = $conn->prepare($update_face_recognition_query);

    if ($update_face_stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $update_face_stmt->bind_param("ii", $face_recognition, $user_id);
    $update_face_stmt->execute();
    $update_face_stmt->close();

    // Pesan sukses setelah pengaturan berhasil diperbarui
    echo "<script>
            alert('Pengaturan keamanan berhasil diperbarui!');
            window.location.href = 'settings.php'; // Redirect ke halaman setting.php setelah klik OK
        </script>";
} else {
    // Jika kata sandi saat ini salah, tampilkan pesan error
    echo "<script>
            alert('Kata sandi saat ini tidak benar!');
            window.location.href = 'settings.php'; // Redirect ke halaman setting.php setelah klik OK
        </script>";
}

$conn->close();
