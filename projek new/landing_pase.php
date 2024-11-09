<?php
    // Example PHP code to manage navigation and user session
    session_start();

    // Check if user is logged in (if you have a login system)
    $isLoggedIn = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JagoeCoding</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Body Styling */
        body {
            background: linear-gradient(145deg, #0e0e2e, #3b3b7e);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            overflow-x: hidden;
        }

        /* Header Styling */
        header {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 1200px;
            align-items: center;
            padding: 20px 0;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            margin-bottom: 30px;
        }

        .nav-buttons a {
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            color: #fff;
            border-radius: 20px;
            transition: background-color 0.3s;
        }

        .nav-buttons .login {
            border: 1px solid #9c9cdb;
            background-color: transparent;
        }

        .nav-buttons .signup {
            background-color: #9c9cdb;
        }

        .hero-title {
            position: relative; /* Create a positioning context */
            margin-left: 50px; /* Align with the rest of the hero section */
        }
        
        .logo-image {
            position: absolute; /* Position the logo absolutely */
            top: 0; /* Adjust the position */
            right: 0; /* Adjust the position */
            width: 40%; /* Scale the image */
            height: auto; /* Maintain aspect ratio */
            opacity: 0.9; /* Adjust opacity to make it less prominent */
            z-index: -1; /* Place it behind the text */
        }
        
        /* Hero Section */
        .hero {
            text-align: justify;
            max-width: 800px;
            margin-bottom: 40px;
            margin-right: 500px;
        }

        .hero h1 {
            font-size: 25px;
            line-height: 1;
            margin-bottom: 10px;
            font-weight: bold;
            margin-left: 50px;
        }

        .hero p {
            font-size: 18px;
            color: #ccccff;
            margin-bottom: 20px;
            margin-left: 50px;
        }

        .cta-button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #9c9cdb;
            color: #fff;
            border-radius: 10px;
            font-weight: bold;
            text-decoration: none;
            margin-top: 20px;
            margin-left: 50px;
        }

        /* Language Cards */
        .languages {
            display: flex;
            justify-content: space-around;
            width: 100%;
            max-width: 1200px;
            gap: 20px;
            margin-top: 30px;
        }

        .language-card {
            background-color: #1e1e3f;
            border-radius: 15px;
            text-align: center;
            padding: 20px;
            width: 30%;
            color: #e0e0e0;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s;
        }

        .language-card:hover {
            transform: translateY(-10px);
        }

        .language-card img {
            width: 150px;
            height: 200px;
            margin-bottom: 10px;
        }

        .language-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #fff;
        }

        .language-card p {
            font-size: 14px;
            color: #b3b3ff;
        }

        /* Footer */
        footer {
            width: 100%;
            max-width: 1200px;
            padding-top: 30px;
            border-top: 1px solid #3c3c6d;
            margin-top: 50px;
            color: #b3b3ff;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .footer-content {
            display: flex;
            gap: 20px;
            align-items: center;
            width: 100%;
            justify-content: space-between;
        }

        .social-icons img {
            width: 30px;
            height: 30px;
            margin-bottom: 10px;
        }

        .about-text {
            max-width: 600px;
            color: #b3b3ff;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">JagoeCoding</div>
        <div class="nav-buttons">
            <?php if ($isLoggedIn): ?>
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="logout">Log out</a>
            <?php else: ?>
                <a href="login.php" class="login">Log in</a>
                <a href="register.php" class="signup">Sign up</a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Langkah Pertama Menuju Kesuksesan di Dunia Programming Dimulai di Sini!</h1>
        <p>Siap jadi Jagoers coding yang keren abis? Di JagoeCoding, kita percaya kalau kamu bisa jadi master kode tanpa
            ribet! Dengan cara yang fun dan menantang, pilih dari berbagai bahasa seperti Python, Java, hingga PHP dan
            upgrade skill-mu dari level basic jadi pro!</p>
        <a href="register.php" class="cta-button">Bergabung Sekarang!</a>
    </section>

    <section class="hero">
        <h1>Pilih bahasa pemprograman yang kamu suka</h1>
        <p>Pilih jalur pembelajaran yang sesuai dengan minatmu. Kami menyediakan berbagai bahasa pemrograman untuk
            membantu menjadi seorang jagoers coding yang sesungguhnya.</p>
        <img src="element-icon/bola.png" alt="Logo" class="logo-image"> <!-- Logo image -->
    </section>

    <!-- Language Cards Section -->
    <section class="languages">
        <div class="language-card">
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c3/Python-logo-notext.svg" alt="Python Logo">
            <h3>Python</h3>
            <p>Bahasa pemrograman yang ramah untuk pemula, sempurna untuk memulai perjalanan coding kamu.</p>
        </div>
        <div class="language-card">
            <img src="https://upload.wikimedia.org/wikipedia/en/3/30/Java_programming_language_logo.svg" alt="Java Logo">
            <h3>Java</h3>
            <p>Bahasa yang dapat dioperasikan dengan berbagai platform dan sangat digemari oleh developer.</p>
        </div>
        <div class="language-card">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/27/PHP-logo.svg" alt="PHP Logo">
            <h3>PHP</h3>
            <p>Bahasa yang kaya untuk pengembangan aplikasi web yang dinamis.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="logo">JagoeCoding</div>
            <div class="nav-buttons">
                <h3>Follow Us</h3><br>
                <a href="https://instagram.com" target="_blank" class="social-icons">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/Instagram_logo_2016.svg/640px-Instagram_logo_2016.svg.png" alt="Instagram">
                </a>
                <a href="https://twitter.com" target="_blank" class="social-icons">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/X_logo_2023.svg/640px-X_logo_2023.svg.png" alt="Twitter">
                </a>
                <a href="https://tiktok.com" target="_blank" class="social-icons">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a6/Tiktok_icon.svg/640px-Tiktok_icon.svg.png" alt="TikTok">
                </a>
                <a href="https://facebook.com" target="_blank" class="social-icons">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Facebook_f_logo_%282019%29.svg/640px-Facebook_f_logo_%282019%29.svg.png" alt="Facebook">
                </a>
            </div>
        </div>
        <div class="about-text">
            <strong>About Us</strong><br>
            Kami di JagoeCoding berkomitmen membantu kamu menjadi ahli dalam coding, menyediakan berbagai pembelajaran
            yang interaktif dan menyenangkan.
        </div>
    </footer>
</body>

</html>
