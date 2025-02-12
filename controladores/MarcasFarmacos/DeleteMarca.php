<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];

    $sql = $conexion->query("delete from gestion_marcas where id_marca=$id");
    if ($sql == 1) {
        echo '<div class= "alert alert-success">Marca eliminada correctamente</div>';
    } else {
        echo '<div class= "alert alert-danger">Error al Eliminar Marca</div>';
    }
}

?>
