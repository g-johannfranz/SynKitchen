<?php
session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] =
        bin2hex(random_bytes(32));
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
            <form class="login-form" action="../backend/register_process.php" method="POST">

                <h2>Create Account</h2>

                <?php if (!empty($error)): ?>
                <div class="error">
                    <?= htmlspecialchars($error) ?>
                </div>
                <?php endif; ?>

                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <input type="text" name="first_name" placeholder="First Name" required>

                <input type="text" name="last_name" placeholder="Last Name" required>

                <input type="text" name="username" placeholder="Username" required>

                <input type="password" name="password" placeholder="Password" required>

                <input type="password" name="confirm_password" placeholder="Confirm Password" required>

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