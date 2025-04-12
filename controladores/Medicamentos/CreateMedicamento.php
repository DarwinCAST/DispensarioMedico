<?php
if (!empty($_POST["registrar"])) {
    if (
        !empty($_POST["nombre"]) &&
        !empty($_POST["id_farmaco"]) &&
        !empty($_POST["id_marca"]) &&
        !empty($_POST["id_ubicacion"]) &&
        !empty($_POST["dosis"]) &&
        !empty($_POST["cantidad"])
    ) {

        $nombre      = $_POST["nombre"];
        $id_farmaco  = $_POST["id_farmaco"];
        $id_marca    = $_POST["id_marca"];
        $id_ubicacion = $_POST["id_ubicacion"];
        $dosis       = $_POST["dosis"];
        $cantidad       = intval($_POST["cantidad"]);

        if ($cantidad > 0 && !is_nan($cantidad)) {
            $sql = $conexion->query("INSERT INTO gestion_medicamentos (nombre, id_farmaco, id_marca, id_ubicacion, dosis, cantidad) 
                                 VALUES ('$nombre', '$id_farmaco', '$id_marca', '$id_ubicacion', '$dosis', $cantidad)");

            if ($sql == 1) {
                echo '<div class="alert alert-success">Medicamento registrado correctamente</div>';
            } else {
                echo '<div class="alert alert-danger">Error al registrar medicamento</div>';
            }
        } else {
            echo '<div class= "alert alert-danger">Error al registrar Medicamento. Asegurese de colocar valores positivos</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Algunos de los campos están vacíos</div>';
    }
}
