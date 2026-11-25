<?php
session_start();

if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit();
}
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

            <form class="login-form" action="../backend/login_process.php" method="POST">
                <h2>Login</h2>

                <input type="text" name="username" placeholder="Username" required>

                <input type="password" name="password" placeholder="Password" required>

                <button type="submit">Login</button>

                <p class="register-link">
                No account yet? <a href="register.php">Register an account here.</a>
                </p>
            </form>
        </div>

    </div>

    <script src="../frontend/js/scripts.js"></script>
</body>
</html>