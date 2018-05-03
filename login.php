<?php

require_once './Database.php';
// Este es el fichero intermedio donde comprobaremos que el usuario se ha logueado correctamente

$username = filter_input(INPUT_POST, "inputUsername");
$password = filter_input(INPUT_POST, "inputPassword");
$database = new Database();
if ($database->validateUser($username, $password)) {
    session_start();
    $_SESSION['username'] = $username;
    header("Location:main.php");
} else {
    header("Location:index.php?fail=true");
}
