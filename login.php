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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e63946, #ff8fa3);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }
        
        .login-box {
            background: #fff;
            padding: 2.5rem 2rem;
            border-radius: 16px;
            width: 100%;
            max-width: 380px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            text-align: center;
        }
        
        .login-box h2 {
            color: #e63946;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .login-box p {
            color: #555;
            margin-bottom: 1.5rem;
        }
        
        .form-group {
            margin-bottom: 1rem;
            text-align: left;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        
        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 6px;
        }
        
        .btn-login {
            width: 100%;
            padding: 0.8rem;
            background: #e63946;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 1rem;
        }
        
        .btn-login:hover {
            background: #c1121f;
        }
        
        .error-message {
            background: #ffe6e6;
            color: #d63031;
            padding: 0.8rem;
            border-radius: 6px;
            margin-bottom: 1rem;
        }
        
        .info-message {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 0.8rem;
            border-radius: 6px;
            margin-bottom: 1rem;
        }
        
        .bottom-link {
            margin-top: 1.5rem;
        }
        
        .bottom-link a {
            color: #e63946;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-box">
        <h2>ALAMEKA Jaya Minang</h2>
        <p>Silakan login untuk masuk ke dashboard</p>

        <?php if (isset($_GET['message'])): ?>
            <div class="info-message">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error) ?></div>
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