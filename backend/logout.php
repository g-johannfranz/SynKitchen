<?php

session_start();

session_unset();
session_destroy();

if (
    isset($_GET['reason']) &&
    $_GET['reason'] === 'inactive'
) {
    header("Location: ../public/login.php?loggedout=inactive");
} else {
    header("Location: ../public/login.php");
}

exit();