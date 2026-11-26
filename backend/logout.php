<?php

require_once 'session_config.php';;

/*
|--------------------------------------------------------------------------
| CLEAR SESSION DATA
|--------------------------------------------------------------------------
*/

$_SESSION = [];

session_unset();

/*
|--------------------------------------------------------------------------
| DESTROY SESSION COOKIE
|--------------------------------------------------------------------------
*/

if (ini_get('session.use_cookies')) {

    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

/*
|--------------------------------------------------------------------------
| DESTROY SESSION
|--------------------------------------------------------------------------
*/

session_destroy();

/*
|--------------------------------------------------------------------------
| REDIRECT
|--------------------------------------------------------------------------
*/

if (
    isset($_GET['reason']) &&
    $_GET['reason'] === 'inactive'
) {

    header(
        'Location: ../public/login.php?loggedout=inactive'
    );

} else {

    header(
        'Location: ../public/login.php'
    );
}

exit();