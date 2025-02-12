<?php
if (!empty($_POST["registrar"])) {
    if(!empty($_POST["nombre"]) and !empty($_POST["cedula"]) and !empty($_POST["carnet"])
    and !empty($_POST["tipo_paciente"])){
        $nombre = $_POST["nombre"];
        $cedula = $_POST["cedula"];
        $carnet = $_POST["carnet"];
        $tipo_paciente = $_POST["tipo_paciente"];


        $resultado_update = $conexion->query("UPDATE gestion_pacientes SET nombre_paciente = '$nombre',
         cedula_paciente = '$cedula', no_carnet = '$carnet', tipo_paciente = '$tipo_paciente' WHERE id_paciente = $id");

        if ($resultado_update) {
            header("location: index.php");
            exit();
        } else {
            echo '<div class= "alert alert-danger">Error al modificar paciente</div>';
        }
    } else {
        echo '<div class= "alert alert-warning">Algunos de los campos esta vacio</div>';
    }
}

ob_end_flush();
?>
