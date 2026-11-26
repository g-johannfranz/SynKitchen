<?php

require_once 'session_config.php';

$timeoutDuration = 600;

if (!isset($_SESSION['user_id'])) {
    header('Location: ../public/login.php');
    exit();
}

if (
    isset($_SESSION['last_activity']) &&
    (time() - $_SESSION['last_activity']) > $timeoutDuration
) {
    header(
        'Location: ../backend/logout.php?reason=inactive'
    );
    exit();
}

$_SESSION['last_activity'] = time();