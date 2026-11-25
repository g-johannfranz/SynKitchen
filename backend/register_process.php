<?php

session_start();

require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../public/register.php');
    exit();
}

/*
|--------------------------------------------------------------------------
| CSRF CHECK
|--------------------------------------------------------------------------
*/

if (
    !isset($_SESSION['csrf_token']) ||
    !isset($_POST['csrf_token']) ||
    !hash_equals(
        $_SESSION['csrf_token'],
        $_POST['csrf_token']
    )
) {
    $_SESSION['error'] = 'Invalid security token.';
    header('Location: ../public/register.php');
    exit();
}

/*
|--------------------------------------------------------------------------
| SANITIZE
|--------------------------------------------------------------------------
*/

$firstName = trim($_POST['first_name']);
$lastName = trim($_POST['last_name']);
$username = trim($_POST['username']);
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

/*
|--------------------------------------------------------------------------
| VALIDATION
|--------------------------------------------------------------------------
*/

if (
    empty($firstName) ||
    empty($lastName) ||
    empty($username) ||
    empty($password) ||
    empty($confirmPassword)
) {
    $_SESSION['error'] = 'All fields are required.';
    header('Location: ../public/register.php');
    exit();
}

if (!preg_match('/^[a-zA-Z0-9_]{4,30}$/', $username)) {
    $_SESSION['error'] = 'Invalid username.';
    header('Location: ../public/register.php');
    exit();
}

if ($password !== $confirmPassword) {
    $_SESSION['error'] = 'Passwords do not match.';
    header('Location: ../public/register.php');
    exit();
}

if (strlen($password) < 8) {
    $_SESSION['error'] = 'Password must be at least 8 characters.';
    header('Location: ../public/register.php');
    exit();
}

if (
    !preg_match('/[A-Z]/', $password) ||
    !preg_match('/[a-z]/', $password) ||
    !preg_match('/[0-9]/', $password)
) {
    $_SESSION['error'] = 'Password must contain uppercase, lowercase, and a number.';
    header('Location: ../public/register.php');
    exit();
}

/*
|--------------------------------------------------------------------------
| CHECK DUPLICATE USERNAME
|--------------------------------------------------------------------------
*/

$stmt = $conn->prepare(
    "SELECT id FROM users WHERE username = ?"
);

$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $_SESSION['error'] = 'Username already exists.';
    header('Location: ../public/register.php');
    exit();
}

$stmt->close();

/*
|--------------------------------------------------------------------------
| SAVE USER
|--------------------------------------------------------------------------
*/

$hashedPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);

$stmt = $conn->prepare(
    "INSERT INTO users
    (first_name, last_name, username, password)
    VALUES (?, ?, ?, ?)"
);

$stmt->bind_param(
    "ssss",
    $firstName,
    $lastName,
    $username,
    $hashedPassword
);

if ($stmt->execute()) {

    unset($_SESSION['csrf_token']);

    $_SESSION['success'] =
        'Registration successful.';

    header('Location: ../public/login.php');
    exit();

} else {

    $_SESSION['error'] =
        'Registration failed: ' . $stmt->error;

    header('Location: ../public/register.php');
    exit();
}

$stmt->close();
$conn->close();