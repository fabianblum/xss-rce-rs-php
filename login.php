<?php
session_start();

$login = [];
include 'configuration.php';

foreach($login as $currentLogin) {
    if($currentLogin['user'] === $_POST['user'] && $currentLogin['password'] === $_POST["password"]) {
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['type'] = $currentLogin['type'];

        header("Location: loggedIn.php");
        die();
    }
}

header("Location: index.php?error");
