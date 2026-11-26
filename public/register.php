<?php

require_once '../backend/session_config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Strict'
]);

session_start();

header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: strict-origin-when-cross-origin");

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SynKitchen - Register</title>
    <link rel="stylesheet" href="../frontend/css/styles.css">
</head>
<body>

<div class="login-container">

    <?php include '../includes/left-panel.php'; ?>

    <div class="right-panel">

        <form
            class="login-form"
            action="../backend/register_process.php"
            method="POST"
            autocomplete="off"
        >

            <h2>Create Account</h2>

            <?php if (!empty($error)): ?>
                <div class="error">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <input
                type="hidden"
                name="csrf_token"
                value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>"
            >

            <input
                type="text"
                name="first_name"
                placeholder="First Name"
                maxlength="50"
                required
            >

            <input
                type="text"
                name="last_name"
                placeholder="Last Name"
                maxlength="50"
                required
            >

            <input
                type="text"
                name="username"
                placeholder="Username"
                minlength="4"
                maxlength="30"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Password"
                minlength="8"
                required
            >

            <input
                type="password"
                name="confirm_password"
                placeholder="Confirm Password"
                minlength="8"
                required
            >

            <button type="submit">Register</button>

            <p class="register-link">
                Already have an account?
                <a href="login.php">Login here.</a>
            </p>

        </form>

    </div>

</div>

<script src="../frontend/js/scripts.js"></script>

</body>
</html>