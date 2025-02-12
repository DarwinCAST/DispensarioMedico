<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];

    $sql = $conexion->query("delete from gestion_ubicaciones where id_ubicacion=$id");
    if ($sql == 1) {
        echo '<div class= "alert alert-success">Ubicacion eliminada correctamente</div>';
    } else {
        echo '<div class= "alert alert-danger">Error al Eliminar Ubicacion</div>';
    }
}

?>
