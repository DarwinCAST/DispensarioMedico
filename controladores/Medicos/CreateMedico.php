<?php

if(!empty($_POST["registrar"])){
    if(!empty($_POST["nombre"]) and !empty($_POST["cedula"]) and !empty($_POST["tanda"])
    and !empty($_POST["especialidad"])){
        $nombre = $_POST["nombre"];
        $cedula = $_POST["cedula"];
        $tanda = $_POST["tanda"];
        $especialidad = $_POST["especialidad"];


        $sql = $conexion->query("insert into gestion_medicos(nombre_medico,cedula_medico,
        tanda_medico,especialidad) values('$nombre', '$cedula', '$tanda', '$especialidad')");

        if($sql ==1){
            echo'<div class= "alert alert-success">Medico registrado correctamente</div>';
        }else{
            echo'<div class= "alert alert-danger">Error al registrar Medico</div>';
        }
    } else{
        echo '<div class= "alert alert-warning">Algunos de los campos esta vacio</div>';
    }

}


?>