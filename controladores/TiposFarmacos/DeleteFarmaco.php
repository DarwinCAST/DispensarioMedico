<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];

    $sql = $conexion->query("delete from tipos_farmacos where id_farmaco=$id");
    if ($sql == 1) {
        echo '<div class= "alert alert-success">Farmaco eliminado correctamente</div>';
    } else {
        echo '<div class= "alert alert-danger">Error al Eliminar farmaco</div>';
    }
}

?>
