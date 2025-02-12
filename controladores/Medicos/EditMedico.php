<?php
if (!empty($_POST["registrar"])) {
    if(!empty($_POST["nombre"]) and !empty($_POST["cedula"]) and !empty($_POST["tanda"])
    and !empty($_POST["especialidad"])){
        $nombre = $_POST["nombre"];
        $cedula = $_POST["cedula"];
        $tanda = $_POST["tanda"];
        $especialidad = $_POST["especialidad"];


        $resultado_update = $conexion->query("UPDATE gestion_medicos SET nombre_medico = '$nombre',
         cedula_medico = '$cedula', tanda_medico = '$tanda', especialidad = '$especialidad' WHERE id_medico = $id");

        if ($resultado_update) {
            header("location: index.php");
            exit();
        } else {
            echo '<div class= "alert alert-danger">Error al modificar medico</div>';
        }
    } else {
        echo '<div class= "alert alert-warning">Algunos de los campos esta vacio</div>';
    }
}

ob_end_flush();
?>
