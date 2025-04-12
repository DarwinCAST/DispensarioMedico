<?php

if (!empty($_POST["registrar"])) {
    if (!empty($_POST["ubicacion"]) and !empty($_POST["estante"]) and !empty($_POST["tramo"] ) and !empty($_POST["casilla"])) {
        $ubicacion = $_POST["ubicacion"];
        $estante = $_POST["estante"];
        $tramo = $_POST["tramo"];
        $casilla = intval($_POST["casilla"]);

        //Validar que casilla sea numero
        if ($casilla > 0 && !is_nan($casilla)) {
            $sql = $conexion->query("insert into gestion_ubicaciones(ubicacion,estante,tramo,casilla)values
            ('$ubicacion', '$estante', '$tramo', '$casilla')");

            if ($sql == 1) {
                echo '<div class= "alert alert-success">Ubicacion registrada correctamente</div>';
            } else {
                echo '<div class= "alert alert-danger">Error al registrar ubicacion</div>';
            }
        } else {
            echo '<div class= "alert alert-danger">Error al registrar ubicacion. Asegurese de colocar valores positivos</div>';
        }
    } else {
        echo '<div class= "alert alert-warning">Algunos de los campos esta vacio</div>';
    }
}
