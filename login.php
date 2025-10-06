<?php
session_start();


if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

// Proses form login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Login sederhana (tanpa database)
    if ($username === "reja" && $password === "190806") {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "❌ Username atau Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ALAMEKA Jaya Minang</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <h2>ALAMEKA Jaya Minang</h2>
        <p>Silakan login untuk masuk ke dashboard</p>

        <?php if (isset($_GET['message'])): ?>
            <div class="info-message">
                <?= htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>

        <!-- Pesan error login -->
        <?php if ($error): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="bottom-link">
            <a href="index.php">← Kembali ke Beranda</a>
        </div>
    </div>
</div>

</body>
</html>
