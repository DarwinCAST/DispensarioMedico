<?php
// Incluimos la conexión a la base de datos
include("/laragon/www/ProyectoDispensarioMedico/php/main.php");

if (!empty($_POST["registrar"])) {
    // Verificamos que ningún campo requerido esté vacío
    if (
        !empty($_POST["id_medico"]) &&
        !empty($_POST["id_paciente"]) &&
        !empty($_POST["fecha_visita"]) &&
        !empty($_POST["hora_visita"]) &&
        !empty($_POST["sintomas"]) &&
        !empty($_POST["id_medicamento"]) &&
        !empty($_POST["recomendaciones"])
    ) {
        // Recogemos los datos del formulario
        $id_medico       = $_POST["id_medico"];
        $id_paciente     = $_POST["id_paciente"];
        $fecha_visita    = $_POST["fecha_visita"];
        $hora_visita     = $_POST["hora_visita"];
        $sintomas        = $_POST["sintomas"];
        $id_medicamento  = $_POST["id_medicamento"];

        $recomendaciones = isset($_POST["recomendaciones"]) ? $_POST["recomendaciones"] : '';

        // Insertamos el registro en la base de datos
        $sql = $conexion->query("
            INSERT INTO registro_visitas (id_medico, id_paciente, fecha_visita, hora_visita, sintomas, id_medicamento, recomendaciones) 
            VALUES ('$id_medico', '$id_paciente', '$fecha_visita', '$hora_visita', '$sintomas', '$id_medicamento', '$recomendaciones')
        ");
        
        if ($sql) {
            echo '<div class="alert alert-success">Registro de visita creado correctamente</div>';
            // Opcional: Redireccionar a index.php después de unos segundos
            // header("refresh:2; url=index.php");
        } else {
            echo '<div class="alert alert-danger">Error al crear el registro de visita</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Por favor, complete todos los campos.</div>';
    }
}
