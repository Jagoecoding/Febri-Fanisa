<?php
require 'koneksi.php';

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

// Validasi apakah password dan confirm password sesuai
if ($password !== $confirm_password) {
    echo "Password dan Konfirmasi Password tidak cocok.";
    exit();
}

// Hash password sebelum disimpan ke database
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Gunakan prepared statement untuk menghindari SQL Injection
$query_sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query_sql);
$stmt->bind_param("sss", $name, $email, $hashed_password);

if ($stmt->execute()) {
    // Redirect ke halaman login jika berhasil
    header("Location: login.html");
    exit();
} else {
    // Tampilkan pesan error jika gagal
    echo "Pendaftaran Gagal : " . $stmt->error;
}

$stmt->close();
$conn->close();
