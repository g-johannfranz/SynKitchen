<?php

require_once '../backend/session_config.php';

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
    <title>SynKitchen - Login</title>
    <link rel="stylesheet" href="../frontend/css/styles.css">
</head>
<body>

<div class="login-container">

    <?php include '../includes/left-panel.php'; ?>

    <div class="right-panel">

        <form
            class="login-form"
            action="../backend/login_process.php"
            method="POST"
            autocomplete="off"
        >

            <h2>Login</h2>

            <?php if (
                isset($_GET['loggedout']) &&
                $_GET['loggedout'] === 'inactive'
            ): ?>
                <div class="error">
                    Your session expired due to inactivity.
                </div>
            <?php endif; ?>

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
                name="username"
                placeholder="Username"
                maxlength="50"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Password"
                required
            >

            <button type="submit">Login</button>

            <p class="register-link">
                No account yet?
                <a href="register.php">Register an account here.</a>
            </p>

        </form>

    </div>

</div>

<script src="../frontend/js/scripts.js"></script>

</body>
</html>