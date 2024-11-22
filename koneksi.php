<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jagocoding";

try {
    // Membuat koneksi ke database menggunakan mysqli
    $conn = new mysqli($servername, $username, $password, $dbname, 3306);

    // Memeriksa apakah koneksi berhasil
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
    die(); // Menghentikan eksekusi jika terjadi error
}
?>
