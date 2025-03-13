<?php
session_start();
include "./php/main.php";
if (!empty($_POST["btningresar"])) {
    if (!empty($_POST["usuario"]) and !empty($_POST["password"])) {
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];

        $sql = $conexion->query("select * from usuarios where usuario = '$usuario' and clave = '$password'");

        if ($datos = $sql->fetch_object()) {
            $_SESSION["id"]= $datos->id;
            $_SESSION["nombre"]= $datos->nombre;
            $_SESSION["apellido"]= $datos->apellido;
            $_SESSION["usuario"]= $datos->usuario;
            header("location: inicio.php");
        } else {
            echo "<div class = 'alert alert-danger'>Acceso denegado</div>";
        }
        
    } else {
        echo "Campos vacios";
    }
}
