<?php
if (!empty($_POST["registrar"])) {
    if (!empty($_POST["nombre"]) and !empty($_POST["estado"])) {
        $nombre = $_POST["nombre"];
        $estado = $_POST["estado"];
        $id = $_POST["id"];

        $resultado_update = $conexion->query("UPDATE tipos_farmacos SET nombre_farmaco = '$nombre', estado_farmaco = '$estado' WHERE id_farmaco = $id");

        if ($resultado_update) {
            header("location: index.php");
            exit();
        } else {
            echo '<div class= "alert alert-danger">Error al modificar farmaco</div>';
        }
    } else {
        echo '<div class= "alert alert-warning">Algunos de los campos esta vacio</div>';
    }
}

ob_end_flush();
?>
