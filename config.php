<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jagoecoding";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname, 3306);

// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
