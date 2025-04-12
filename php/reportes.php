<?php
ob_start();
?>

<?php
include("/laragon/www/ProyectoDispensarioMedico/php/main.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de visitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c35b649b73.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500');

        * {
            padding: 0;
            margin: 0;
            list-style: none;
            text-decoration: none;
        }

        body {
            font-family: 'Roboto', sans-serif;
        }

        .sidebar {
            position: fixed;
            width: 360px;
            height: 100%;
            background: #042331;
            transition: all .5s ease;
            margin-left: 0;
        }

        .sidebar header {
            font-size: 22px;
            color: white;
            line-height: 70px;
            text-align: center;
            background: #063146;
            user-select: none;
        }

        .sidebar ul a {
            display: block;
            height: 100%;
            width: 100%;
            line-height: 65px;
            font-size: 18px;
            color: white;
            box-sizing: border-box;
            border-bottom: 1px solid black;
            border-top: 1px solid rgba(255, 255, 255, .1);
            transition: .4s;
        }

        ul li:hover a {
            padding-left: 50px;
        }

        .sidebar ul a i {
            margin-right: 16px;
        }

        .content {
            margin-left: 380px;
            padding: 20px;
        }

        .btn-create {
            display: flex;
            justify-content: end;
            margin-bottom: 15px;
        }
    </style>
    <script>
        function eliminar() {
            let respuesta = confirm("¿Estás seguro que deseas eliminar?");
            return respuesta;
        }
    </script>
</head>

<body>
    <h1>Reporte de visitas</h1>
    <table class="table table-striped table-hover">
        <thead class="bg-info text-white">
            <tr>
                <!--  <th scope="col">ID Registro</th> -->
                <th scope="col">Médico</th>
                <th scope="col">Paciente</th>
                <th scope="col">Fecha Visita</th>
                <th scope="col">Hora Visita</th>
                <th scope="col">Síntomas</th>
                <th scope="col">Medicamento</th>
                <th scope="col">Recomendaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Consulta para unir registro_visitas con gestion_medicos y gestion_pacientes.
            $sql = $conexion->query("
                    SELECT 
                        rv.id_registro, 
                        gm.nombre_medico, 
                        gp.nombre_paciente, 
                        rv.fecha_visita, 
                        rv.hora_visita, 
                        rv.sintomas, 
                        m.nombre AS nombre_medicamento, 
                        rv.recomendaciones
                    FROM registro_visitas rv
                    INNER JOIN gestion_medicos gm ON rv.id_medico = gm.id_medico
                    INNER JOIN gestion_pacientes gp ON rv.id_paciente = gp.id_paciente
                    INNER JOIN gestion_medicamentos m ON rv.id_medicamento = m.id_medicamento
                ");
            while ($datos = $sql->fetch_object()) { ?>
                <tr>
                    <!--  <th scope="row"><?= $datos->id_registro ?></th> -->
                    <td><?= $datos->nombre_medico ?></td>
                    <td><?= $datos->nombre_paciente ?></td>
                    <td><?= $datos->fecha_visita ?></td>
                    <td><?= $datos->hora_visita ?></td>
                    <td><?= $datos->sintomas ?></td>
                    <td><?= $datos->nombre_medicamento ?></td>
                    <td><?= $datos->recomendaciones ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>

<?php
$html = ob_get_clean();

//echo $html;

require_once("/laragon/www/ProyectoDispensarioMedico/php/libreria/dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper("letter");
//$dompdf->setPaper("A4");

$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment" => false));



?>