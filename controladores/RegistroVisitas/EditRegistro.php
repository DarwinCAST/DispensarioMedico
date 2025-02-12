<?php
// Incluimos la conexión a la base de datos
include("/laragon/www/ProyectoDispensarioMedico/php/main.php");

if (!empty($_POST["registrar"])) {
    // Validamos que los campos obligatorios no estén vacíos
    if (
        !empty($_POST["id_medico"]) &&
        !empty($_POST["id_paciente"]) &&
        !empty($_POST["fecha_visita"]) &&
        !empty($_POST["hora_visita"]) &&
        !empty($_POST["sintomas"]) &&
        !empty($_POST["id_medicamento"])
    ) {
        // Recogemos los datos del formulario
        $id_registro     = $_POST["id"];
        $id_medico       = $_POST["id_medico"];
        $id_paciente     = $_POST["id_paciente"];
        $fecha_visita    = $_POST["fecha_visita"];
        $hora_visita     = $_POST["hora_visita"];
        $sintomas        = $_POST["sintomas"];
        $id_medicamento  = $_POST["id_medicamento"];
        $recomendaciones = isset($_POST["recomendaciones"]) ? $_POST["recomendaciones"] : '';

        // Realizamos la actualización del registro
        $resultado_update = $conexion->query("
            UPDATE registro_visitas 
            SET 
                id_medico = '$id_medico',
                id_paciente = '$id_paciente',
                fecha_visita = '$fecha_visita',
                hora_visita = '$hora_visita',
                sintomas = '$sintomas',
                id_medicamento = '$id_medicamento',
                recomendaciones = '$recomendaciones'
            WHERE id_registro = $id_registro
        ");

        if ($resultado_update) {
            // Si la actualización es exitosa, redirigimos a la vista principal
            header("Location: index.php");
            exit();
        } else {
            echo '<div class="alert alert-danger">Error al modificar el registro de visita</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Algunos de los campos obligatorios están vacíos</div>';
    }
}
