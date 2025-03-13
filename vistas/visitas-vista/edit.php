<?php
ob_start();
// Incluimos la conexión
include("/laragon/www/ProyectoDispensarioMedico/php/main.php");

// Obtenemos el id del registro a editar (por ejemplo, mediante GET)
$id = $_GET["id"];

// Consultamos el registro a editar
$sql = $conexion->query("SELECT * FROM registro_visitas WHERE id_registro = $id");
$registro = $sql->fetch_object();

// Consultas para llenar los select de las tablas relacionadas
$sqlMedicos      = $conexion->query("SELECT * FROM gestion_medicos");
$sqlPacientes    = $conexion->query("SELECT * FROM gestion_pacientes");
$sqlMedicamentos = $conexion->query("SELECT * FROM gestion_medicamentos");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Medicamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
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

        #check {
            display: none;
        }

        label #btn,
        label #cancel {
            position: absolute;
            background: #042331;
            border-radius: 3px;
            cursor: pointer;
        }

        label #btn {
            left: 40px;
            top: 25px;
            font-size: 35px;
            color: white;
            padding: 6px 12px;
            transition: all .5s;
        }

        label #cancel {
            z-index: 1111;
            left: -195px;
            top: 17px;
            font-size: 30px;
            color: #0a5275;
            padding: 4px 9px;
            transition: all .5s ease;
        }

        #check:checked~.sidebar {
            left: 0;
        }

        #check:checked~label #btn {
            left: 250px;
            opacity: 0;
            pointer-events: none;
        }

        #check:checked~label #cancel {
            left: 195px;
        }

        #check:checked~section {
            margin-left: 250px;
        }

        section {
            background: url(bg.jpeg) no-repeat;
            background-position: center;
            background-size: cover;
            height: 100vh;
            transition: all .5s;
        }

        .content {
            margin-left: 380px;
            /* Espacio para la sidebar */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <header>Dispensario Medico</header>
        <ul>
            <li><a href="../farmacos-vista/index.php"><i class="fas fa-qrcode"></i> Gestion de tipos de farmacos</a></li>
            <li><a href="../marcas-vista/index.php"><i class="fas fa-link"></i> Gestion de marcas</a></li>
            <li><a href="../ubicaciones-vista/index.php"><i class="fas fa-stream"></i> Gestion de ubicaciones</a></li>
            <li><a href="../medicamentos-vista/index.php"><i class="fas fa-calendar-week"></i> Gestion de medicamentos</a></li>
            <li><a href="../pacientes-vista/index.php"><i class="far fa-question-circle"></i> Gestion de pacientes</a></li>
            <li><a href="../medicos-vista/index.php"><i class="fas fa-sliders-h"></i> Gestion de medicos</a></li>
            <li><a href="index.php"><i class="far fa-envelope"></i> Registro de visitas</a></li>
            <li><a href="../../controladores/Login/CerrarSesion.php">Cerrar sesion</a></li>

        </ul>
    </div>
    <div class="content">
        <div class="form-container">
            <h2>Modificar Medicamento</h2>
            <form method="POST">
                <?php include("/laragon/www/ProyectoDispensarioMedico/controladores/RegistroVisitas/EditRegistro.php");  ?>
                <!-- Campo oculto para el ID del registro -->
                <input type="hidden" name="id" value="<?= $registro->id_registro ?>">

                <!-- Seleccionar Médico -->
                <div class="mb-3">
                    <label for="id_medico" class="form-label">Médico</label>
                    <select class="form-control" id="id_medico" name="id_medico" required>
                        <option value="">Seleccione un médico</option>
                        <?php
                        // Para cada médico, marcamos la opción que coincide con el registro
                        while ($medico = $sqlMedicos->fetch_object()) {
                            $selected = ($medico->id_medico == $registro->id_medico) ? 'selected' : '';
                            echo "<option value='{$medico->id_medico}' $selected>{$medico->nombre_medico}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Seleccionar Paciente -->
                <div class="mb-3">
                    <label for="id_paciente" class="form-label">Paciente</label>
                    <select class="form-control" id="id_paciente" name="id_paciente" required>
                        <option value="">Seleccione un paciente</option>
                        <?php
                        while ($paciente = $sqlPacientes->fetch_object()) {
                            $selected = ($paciente->id_paciente == $registro->id_paciente) ? 'selected' : '';
                            echo "<option value='{$paciente->id_paciente}' $selected>{$paciente->nombre_paciente}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Fecha de Visita -->
                <div class="mb-3">
                    <label for="fecha_visita" class="form-label">Fecha de Visita</label>
                    <input type="date" class="form-control" id="fecha_visita" name="fecha_visita" value="<?= htmlspecialchars($registro->fecha_visita) ?>" required>
                </div>

                <!-- Hora de Visita -->
                <div class="mb-3">
                    <label for="hora_visita" class="form-label">Hora de Visita</label>
                    <input type="time" class="form-control" id="hora_visita" name="hora_visita" value="<?= htmlspecialchars($registro->hora_visita) ?>" required>
                </div>

                <!-- Síntomas -->
                <div class="mb-3">
                    <label for="sintomas" class="form-label">Síntomas</label>
                    <textarea class="form-control" id="sintomas" name="sintomas" rows="3" required><?= htmlspecialchars($registro->sintomas) ?></textarea>
                </div>

                <!-- Seleccionar Medicamento -->
                <div class="mb-3">
                    <label for="id_medicamento" class="form-label">Medicamento</label>
                    <select class="form-control" id="id_medicamento" name="id_medicamento" required>
                        <option value="">Seleccione un medicamento</option>
                        <?php
                        while ($medicamento = $sqlMedicamentos->fetch_object()) {
                            $selected = ($medicamento->id_medicamento == $registro->id_medicamento) ? 'selected' : '';
                            echo "<option value='{$medicamento->id_medicamento}' $selected>{$medicamento->nombre}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Recomendaciones (opcional) -->
                <div class="mb-3">
                    <label for="recomendaciones" class="form-label">Recomendaciones</label>
                    <textarea class="form-control" id="recomendaciones" name="recomendaciones" rows="3"><?= htmlspecialchars($registro->recomendaciones) ?></textarea>
                </div>

                <button value="ok" name="registrar" type="submit" class="btn btn-primary w-100">Guardar</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>