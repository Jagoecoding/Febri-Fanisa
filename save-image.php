<?php
session_start();

// Pastikan request menggunakan POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data JSON dari request
    $data = json_decode(file_get_contents('php://input'), true);

    // Pastikan ada data gambar dan email yang diterima
    if (isset($data['image']) && isset($data['email'])) {
        $imageData = $data['image'];
        $email = $data['email'];  // Ambil email dari request
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $decodedData = base64_decode($imageData);

        // Tentukan path file gambar menggunakan email sebagai nama file
        $filename = 'uploads/' . $email . '.png'; // Simpan dengan nama email

        // Simpan gambar ke file
        if (file_put_contents($filename, $decodedData)) {
            // Hubungkan ke database
            $conn = new mysqli('localhost', 'root', '', 'jagocoding');

            if ($conn->connect_error) {
                die('Connection failed: ' . $conn->connect_error);
            }

            // Simpan path gambar ke database
            $stmt = $conn->prepare("INSERT INTO face_recognition (image_path, email) VALUES (?, ?)");
            $stmt->bind_param('ss', $filename, $email);
            if ($stmt->execute()) {
                echo json_encode(['message' => 'Image saved successfully']);
            } else {
                echo json_encode(['message' => 'Failed to save image to database']);
            }
            $stmt->close();
            $conn->close();
        } else {
            echo json_encode(['message' => 'Failed to save image file']);
        }
    } else {
        echo json_encode(['message' => 'No image or email data received']);
    }
} else {
    echo json_encode(['message' => 'Invalid request']);
}
?>
