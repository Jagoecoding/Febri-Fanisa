<?php
require 'koneksi.php';
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

$query_sql = "INSERT INTO users (name, email, password, confirm_password)
            VALUES ('$name', '$email', '$password', '$confirm_password')";

if (mysqli_query($conn, $query_sql)) {
    header("Location: login.html");
} else {
    echo "Pendaftaran Gagal : " . mysqli_error($conn);
}