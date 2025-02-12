<?php
if (!empty($_POST["registrar"])) {
    if (!empty($_POST["nombre"]) and !empty($_POST["estado"])) {
        $nombre = $_POST["nombre"];
        $estado = $_POST["estado"];
        $id = $_POST["id"];

        $resultado_update = $conexion->query("UPDATE gestion_marcas SET nombre_marca = '$nombre', estado_marca = '$estado' WHERE id_marca = $id");

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
