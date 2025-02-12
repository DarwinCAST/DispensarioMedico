<?php
if (!empty($_POST["registrar"])) {
    if (!empty($_POST["ubicacion"]) and !empty($_POST["estante"]) and !empty($_POST["tramo"]) and !empty($_POST["casilla"])) {
        $ubicacion = $_POST["ubicacion"];
        $estante = $_POST["estante"];
        $tramo = $_POST["tramo"];
        $casilla = $_POST["casilla"];

        $resultado_update = $conexion->query("UPDATE gestion_ubicaciones SET ubicacion = '$ubicacion'
        , estante = '$estante', tramo = '$tramo', casilla = 'casilla' WHERE id_ubicacion = $id");

        if ($resultado_update) {
            header("location: index.php");
            exit();
        } else {
            echo '<div class= "alert alert-danger">Error al modificar marca</div>';
        }
    } else {
        echo '<div class= "alert alert-warning">Algunos de los campos esta vacio</div>';
    }
}

ob_end_flush();
?>
