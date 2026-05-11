<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/validation.php';

$mode = $_GET['mode'] ?? 'login';
$loginError = '';
$registerError = '';
$registerOk = '';

$loginForm = [
    'email' => '',
];
$registerForm = [
    'name' => '',
    'email' => '',
    'phone' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'register') {
        $registerForm['name'] = cleanInput($_POST['name'] ?? '');
        $registerForm['email'] = cleanInput($_POST['email'] ?? '');
        $registerForm['phone'] = cleanInput($_POST['phone'] ?? '');
        $password = (string) ($_POST['password'] ?? '');
        $confirm = (string) ($_POST['confirm_password'] ?? '');

        if ($registerForm['name'] === '' || strlen($registerForm['name']) < 2) {
            $registerError = 'Please provide a valid name.';
        } elseif (!isValidEmail($registerForm['email'])) {
            $registerError = 'Please provide a valid email.';
        } elseif (!isValidPhone($registerForm['phone'])) {
            $registerError = 'Please provide a valid phone number.';
        } elseif (strlen($password) < 8) {
            $registerError = 'Password must be at least 8 characters.';
        } elseif ($password !== $confirm) {
            $registerError = 'Passwords do not match.';
        } else {
            try {
                $pdo = getDbConnection();
                $exists = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
                $exists->execute([':email' => $registerForm['email']]);
                if ($exists->fetch()) {
                    $registerError = 'Email already registered. Please login.';
                } else {
                    $stmt = $pdo->prepare(
                        'INSERT INTO users (full_name, email, phone, password_hash) VALUES (:name, :email, :phone, :password_hash)'
                    );
                    $stmt->execute([
                        ':name' => $registerForm['name'],
                        ':email' => $registerForm['email'],
                        ':phone' => $registerForm['phone'],
                        ':password_hash' => password_hash($password, PASSWORD_DEFAULT),
                    ]);
                    $registerOk = 'Registration successful. You can login now.';
                    $mode = 'login';
                    $registerForm = ['name' => '', 'email' => '', 'phone' => ''];
                }
            } catch (Throwable $e) {
                $registerError = 'Registration failed. Try again.';
            }
        }
    }

    if ($action === 'login') {
        $loginForm['email'] = cleanInput($_POST['email'] ?? '');
        $password = (string) ($_POST['password'] ?? '');
        if (!isValidEmail($loginForm['email']) || $password === '') {
            $loginError = 'Enter valid email and password.';
        } else {
            try {
                $pdo = getDbConnection();
                $stmt = $pdo->prepare('SELECT id, full_name, email, password_hash FROM users WHERE email = :email LIMIT 1');
                $stmt->execute([':email' => $loginForm['email']]);
                $user = $stmt->fetch();
                if (!$user || !password_verify($password, $user['password_hash'])) {
                    $loginError = 'Invalid credentials.';
                } else {
                    $_SESSION['user_id'] = (int) $user['id'];
                    $_SESSION['user_name'] = $user['full_name'];
                    $_SESSION['user_email'] = $user['email'];
                    header('Location: index.php');
                    exit;
                }
            } catch (Throwable $e) {
                $loginError = 'Login failed due to a server issue.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login / Register - Plan Karo</title>
  <style>
    body{font-family:Arial,sans-serif;background:#0f1b2d;color:#fff;margin:0}
    .wrap{max-width:520px;margin:40px auto;padding:22px;background:#111e2f;border-radius:12px}
    h1{margin-top:0;color:#f59e0b}
    .tabs a{margin-right:10px;color:#0ea5a4;text-decoration:none}
    .tabs .on{color:#f59e0b;font-weight:700}
    .row{margin-bottom:11px}
    label{display:block;margin-bottom:6px;color:#93c5fd;font-size:13px}
    input{width:100%;padding:10px;border-radius:8px;border:1px solid #334155;background:#0b1220;color:#fff}
    button{background:#0ea5a4;color:#fff;border:none;padding:10px 16px;border-radius:8px;font-weight:700;cursor:pointer}
    .msg{margin:10px 0;padding:9px;border-radius:8px}
    .err{background:#7f1d1d}.ok{background:#14532d}
  </style>
</head>
<body>
  <div class="wrap">
    <p><a href="index.php" style="color:#0ea5a4;text-decoration:none">← Back Home</a></p>
    <h1>Plan Karo Account</h1>
    <div class="tabs">
      <a href="login.php?mode=login" class="<?= $mode === 'login' ? 'on' : '' ?>">Login</a>
      <a href="login.php?mode=register" class="<?= $mode === 'register' ? 'on' : '' ?>">Register</a>
    </div>

    <?php if ($registerOk !== ''): ?><div class="msg ok"><?= esc($registerOk) ?></div><?php endif; ?>

    <?php if ($mode === 'register'): ?>
      <?php if ($registerError !== ''): ?><div class="msg err"><?= esc($registerError) ?></div><?php endif; ?>
      <form method="post" action="login.php?mode=register">
        <input type="hidden" name="action" value="register">
        <div class="row"><label>Full Name</label><input name="name" value="<?= esc($registerForm['name']) ?>" required></div>
        <div class="row"><label>Email</label><input name="email" type="email" value="<?= esc($registerForm['email']) ?>" required></div>
        <div class="row"><label>Phone</label><input name="phone" value="<?= esc($registerForm['phone']) ?>" required></div>
        <div class="row"><label>Password</label><input name="password" type="password" required></div>
        <div class="row"><label>Confirm Password</label><input name="confirm_password" type="password" required></div>
        <button type="submit">Create Account</button>
      </form>
    <?php else: ?>
      <?php if ($loginError !== ''): ?><div class="msg err"><?= esc($loginError) ?></div><?php endif; ?>
      <form method="post" action="login.php?mode=login">
        <input type="hidden" name="action" value="login">
        <div class="row"><label>Email</label><input name="email" type="email" value="<?= esc($loginForm['email']) ?>" required></div>
        <div class="row"><label>Password</label><input name="password" type="password" required></div>
        <button type="submit">Login</button>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>
