<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Face Recognition Setup</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: radial-gradient(circle at top left, #1c1c3c, #000);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
        }

        .verification-container {
            background: #1e1e3f;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(255, 255, 255, 0.1), 0 0 15px rgba(106, 90, 205, 0.5);
            text-align: center;
            width: 320px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .verification-container h2 {
            margin-bottom: 20px;
            font-size: 1.5em;
            color: #e0e0ff;
        }

        video {
            margin: 15px auto;
            border-radius: 15px;
            border: 2px solid #6a5acd;
        }

        .verification-container button {
            width: 120px;
            padding: 10px;
            border: none;
            border-radius: 20px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.3s;
            margin: 5px;
        }

        .activate-btn {
            background: #6a5acd;
            color: white;
        }

        .activate-btn:hover {
            background: #5a4abc;
        }

        .finish-btn {
            background: #4caf50;
            color: white;
        }

        .finish-btn:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <div class="verification-container">
        <h2>Set Up Face Recognition</h2>
        <p>Follow the instructions to set up face recognition for login.</p>
        <video id="camera" autoplay playsinline width="300" height="200"></video>
        <canvas id="snapshot" style="display:none;"></canvas>
        <button class="activate-btn" onclick="captureImage()">Capture</button>
        <button class="finish-btn" style="display:none;" onclick="finishSetup()">Finish</button>
    </div>

    <script>
    const video = document.getElementById('camera');
    const canvas = document.getElementById('snapshot');
    const ctx = canvas.getContext('2d');
    const finishButton = document.querySelector('.finish-btn');

    // Cek dan akses perangkat kamera tanpa memilih deviceId
    function initializeCamera() {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then((stream) => {
                video.srcObject = stream;
            })
            .catch((error) => {
                console.error('Error accessing the camera:', error);
                alert('Unable to access the camera: ' + error.message);
            });
    }

    // Panggil fungsi untuk mengakses kamera
    initializeCamera();

    // Tangkap gambar dari video
    function captureImage() {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Konversi gambar ke base64
        const imageData = canvas.toDataURL('image/png');

        // Mengambil email dari session PHP
        const email = "<?php echo $_SESSION['email']; ?>";  // Pastikan session email sudah ada

        uploadImage(imageData, email);

        // Tampilkan tombol "Finish" setelah gambar diambil
        finishButton.style.display = 'inline-block';
    }

    // Kirim gambar dan email ke server
    function uploadImage(imageData, email) {
        fetch('save-image.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ image: imageData, email: email })
        })
        .then(response => response.json())
        .then(data => alert(data.message))
        .catch(error => {
            console.error('Error uploading image:', error);
            alert('Failed to upload image.');
        });
    }

    // Aksi saat tombol Finish ditekan
    function finishSetup() {
        // Redirect atau melakukan aksi lain setelah setup selesai
        window.location.href = 'settings.php'; // Ganti dengan halaman sesuai kebutuhan
    }
</script>

</body>
</html>
