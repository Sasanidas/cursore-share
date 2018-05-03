<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author osboxes
 */
class Database {

    //Metodo para acceder a la base de datos, dado un usuario y una pass (en sha256)

    function __construct() {
        $this->conn = new mysqli('localhost', 'root', 'toor', 'cursorweb');
        if (!$this->conn) {
            die('No se ha podido conectar a la base de datos' . mysqli_connect_error());
        }
    }

    function validateUser($username, $password) {
        $consulta = $this->conn->stmt_init();
        $consulta->prepare("SELECT NombreUser,PasswordUser FROM usuarios WHERE NombreUser= ? AND PasswordUser= ? ");
        $consulta->bind_param("ss", $username, hash("sha256", $password));
        $consulta->execute();
        $consulta->bind_result($usernamem, $passwordd);
        while ($consulta->fetch()) {
            if ($username === $usernamem && $passwordd === hash("sha256", $password)) {
                $result = true;
            } else {
                $result = false;
            }
        }
        $consulta->close();
        $this->conn->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function insertUser($username, $password) {
        $consulta = $this->conn->stmt_init();
        $number = rand(0, 999999999);
        $consulta->prepare("INSERT INTO usuarios(ID, NombreUser, PasswordUser) VALUES (?,?,?) ");
        $consulta->bind_param("iss", $number,$username, hash("sha256", $password));
        $result = $consulta->execute();
        $consulta->close();
        $this->conn->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}
