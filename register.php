<?php
require 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username === '' || strlen($password) < 6) {
        $error = 'Enter a username and a password of at least 6 characters.';
    } else {
        $stmt = $db->prepare('SELECT id FROM users WHERE username = ?');
        $stmt->execute([$username]);

        if ($stmt->fetch()) {
            $error = 'That username is taken.';
        } else {
            $stmt = $db->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
            $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT)]);
            header('Location: login.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" class="box">
        <h1>Sign up</h1>

        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Sign up</button>

        <p>Already have an account? <a href="login.php">Log in</a></p>
    </form>
</body>
</html>
