<?php

require_once 'session_config.php';

require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../public/login.php');
    exit();
}

if (
    !isset($_SESSION['csrf_token']) ||
    !isset($_POST['csrf_token']) ||
    !hash_equals(
        $_SESSION['csrf_token'],
        $_POST['csrf_token']
    )
) {
    $_SESSION['error'] = 'Invalid request.';
    header('Location: ../public/login.php');
    exit();
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    $_SESSION['error'] = 'Invalid username or password.';
    header('Location: ../public/login.php');
    exit();
}

$stmt = $conn->prepare(
    "SELECT id, username, first_name, password
     FROM users
     WHERE username = ?
     LIMIT 1"
);

$stmt->bind_param(
    "s",
    $username
);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {

    $user = $result->fetch_assoc();

    if (password_verify(
        $password,
        $user['password']
    )) {

        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_activity'] = time();

        unset($_SESSION['csrf_token']);

        header(
            'Location: ../public/dashboard.php'
        );
        exit();
    }
}

$_SESSION['error'] =
    'Invalid username or password.';

header('Location: ../public/login.php');
exit();