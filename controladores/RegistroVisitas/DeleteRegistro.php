<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];

    $sql = $conexion->query("delete from registro_visitas where id_registro=$id");
    if ($sql == 1) {
        echo '<div class= "alert alert-success">Visita eliminada correctamente</div>';
    } else {
        echo '<div class= "alert alert-danger">Error al Eliminar Visita</div>';
    }
}

?>
