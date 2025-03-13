<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];

    $sql = $conexion->query("delete from gestion_pacientes where id_paciente=$id");
    if ($sql == 1) {
        echo '<div class= "alert alert-success">Paciente eliminado correctamente</div>';
    } else {
        echo '<div class= "alert alert-danger">Error al Eliminar Paciente</div>';
    }
}

?>
