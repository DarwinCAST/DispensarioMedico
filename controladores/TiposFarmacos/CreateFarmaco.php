<?php

if(!empty($_POST["registrar"])){
    if(!empty($_POST["nombre"]) and !empty($_POST["estado"])){
        $nombre = $_POST["nombre"];
        $estado = $_POST["estado"];

        $sql = $conexion->query("insert into tipos_farmacos(nombre_farmaco,estado_farmaco)values
        ('$nombre', '$estado')");

        if($sql ==1){
            echo'<div class= "alert alert-success">Farmaco registrado correctamente</div>';
        }else{
            echo'<div class= "alert alert-danger">Error al registrar farmaco</div>';
        }
    } else{
        echo '<div class= "alert alert-warning">Algunos de los campos esta vacio</div>';
    }

}


?>