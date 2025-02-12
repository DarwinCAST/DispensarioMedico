<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];

    $sql = $conexion->query("delete from gestion_medicamentos where id_medicamento=$id");
    if ($sql == 1) {
        echo '<div class= "alert alert-success">Medicamento eliminado correctamente</div>';
    } else {
        echo '<div class= "alert alert-danger">Error al Eliminar medicamento</div>';
    }
}

?>
