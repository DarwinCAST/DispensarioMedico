<?php
if (!empty($_POST["registrar"])) {
    if (
        !empty($_POST["nombre"]) &&
        !empty($_POST["id_farmaco"]) &&
        !empty($_POST["id_marca"]) &&
        !empty($_POST["id_ubicacion"]) &&
        !empty($_POST["dosis"])
    ) {

        $nombre       = $_POST["nombre"];
        $id_farmaco   = $_POST["id_farmaco"];
        $id_marca     = $_POST["id_marca"];
        $id_ubicacion = $_POST["id_ubicacion"];
        $dosis        = $_POST["dosis"];
        $id           = $_POST["id"];

        $resultado_update = $conexion->query("
            UPDATE gestion_medicamentos 
            SET 
                nombre = '$nombre', 
                id_farmaco = '$id_farmaco', 
                id_marca = '$id_marca', 
                id_ubicacion = '$id_ubicacion', 
                dosis = '$dosis' 
            WHERE id_medicamento = $id
        ");

        if ($resultado_update) {
            header("Location: index.php");
            exit();
        } else {
            echo '<div class="alert alert-danger">Error al modificar medicamento</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Algunos de los campos están vacíos</div>';
    }
}

ob_end_flush();
?>