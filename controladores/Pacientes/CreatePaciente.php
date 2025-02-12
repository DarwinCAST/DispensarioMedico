<?php

if(!empty($_POST["registrar"])){
    if(!empty($_POST["nombre"]) and !empty($_POST["cedula"]) and !empty($_POST["carnet"])
    and !empty($_POST["tipo_paciente"])){
        $nombre = $_POST["nombre"];
        $cedula = $_POST["cedula"];
        $carnet = $_POST["carnet"];
        $tipo_paciente = $_POST["tipo_paciente"];


        $sql = $conexion->query("insert into gestion_pacientes(nombre_paciente,cedula_paciente,
        no_carnet,tipo_paciente) values('$nombre', '$cedula', '$carnet', '$tipo_paciente')");

        if($sql ==1){
            echo'<div class= "alert alert-success">Paciente registrado correctamente</div>';
        }else{
            echo'<div class= "alert alert-danger">Error al registrar Paciente</div>';
        }
    } else{
        echo '<div class= "alert alert-warning">Algunos de los campos esta vacio</div>';
    }

}


?>