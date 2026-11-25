<?php

require_once 'db_connection.php';

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare(
    "SELECT * FROM users WHERE username = ?"
);

$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        $_SESSION['last_activity'] = time();

        header("Location: ../public/dashboard.php");
        exit();

    } else {
        echo "Invalid password.";
    }

} else {
    echo "User not found.";
}