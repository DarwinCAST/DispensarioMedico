<?php

if(!empty($_POST["registrar"])){
    if(!empty($_POST["nombre"]) and !empty($_POST["estado"])){
        $nombre = $_POST["nombre"];
        $estado = $_POST["estado"];

        $sql = $conexion->query("insert into gestion_marcas(nombre_marca,estado_marca)values
        ('$nombre', '$estado')");

        if($sql ==1){
            echo'<div class= "alert alert-success">Marca registrada correctamente</div>';
        }else{
            echo'<div class= "alert alert-danger">Error al registrar marca</div>';
        }
    } else{
        echo '<div class= "alert alert-warning">Algunos de los campos esta vacio</div>';
    }

}


?>