<?php
    require_once 'dbconfig.php';
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

    function checkAuth() {
    if (isset($_SESSION['username'])) {
        return $_SESSION['username'];
    } else {
        return 0;
    }
}

?>