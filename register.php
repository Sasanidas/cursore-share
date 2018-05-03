<?php

require_once './Database.php';

session_start();
// Este es el fichero intermedio donde comprobaremos que el usuario se registra correctamente;
$ok = filter_input(INPUT_POST, 'ok');
if (!($ok === "on")) {
    header("Location:registro.php?notcheck=true");
} else {
    $captcha = filter_input(INPUT_POST, "captcha");


    if ((strtolower($_SESSION['captcha']['code']) === strtolower($captcha)) && isset($_SESSION['captcha']['code'])) {
        $username = filter_input(INPUT_POST, "inputUsername");
        $password = filter_input(INPUT_POST, "inputPassword");
        $database = new Database();
        if ($database->insertUser($username, $password)) {

            mkdir("/var/usersds/$username");
            header("Location:index.php");
        } else {
            echo "<h1> Usuario no valido, redirigiendo...</h1>";
            header("Refresh:2; url=index.php");
        }
    } else {
        header("Location:registro.php?fail=true");
    }
}



