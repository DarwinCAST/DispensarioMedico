<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Fármaco</title>
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
            <li><a href="../medicamentos-vista/"><i class="fas fa-calendar-week"></i> Gestion de medicamentos</a></li>
            <li><a href="../pacientes-vista/index.php"><i class="far fa-question-circle"></i> Gestion de pacientes</a></li>
            <li><a href="../medicos-vista/index.php"><i class="fas fa-sliders-h"></i> Gestion de medicos</a></li>
            <li><a href="index.php"><i class="far fa-envelope"></i> Registro de visitas</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="form-container">
            <h2>Crear Registro de visitas</h2>

            <form method="POST" action="">
                <?php
                include("/laragon/www/ProyectoDispensarioMedico/php/main.php");
                include("/laragon/www/ProyectoDispensarioMedico/controladores/RegistroVisitas/CreateRegistro.php");
                $sqlPacientes = $conexion->query("SELECT * FROM gestion_pacientes ");
                $sqlMedicos = $conexion->query("SELECT * FROM gestion_medicos ");
                $sqlMedicamentos = $conexion->query("SELECT * FROM gestion_medicamentos");
                ?>

                <div class="mb-3">
                    <label for="id_paciente" class="form-label">Paciente</label>
                    <select class="form-control" id="id_paciente" name="id_paciente" required>
                        <option value="">Seleccione un paciente</option>
                        <?php while ($row = $sqlPacientes->fetch_object()) { ?>
                            <option value="<?= $row->id_paciente ?>"><?= $row->nombre_paciente ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_medico" class="form-label">Médico</label>
                    <select class="form-control" id="id_medico" name="id_medico" required>
                        <option value="">Seleccione un médico</option>
                        <?php while ($row = $sqlMedicos->fetch_object()) { ?>
                            <option value="<?= $row->id_medico ?>"><?= $row->nombre_medico ?></option>
                        <?php } ?>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="fecha_visita" class="form-label">Fecha de Visita</label>
                    <input type="date" class="form-control" id="fecha_visita" name="fecha_visita" required>
                </div>

                <div class="mb-3">
                    <label for="hora_visita" class="form-label">Hora de Visita</label>
                    <input type="time" class="form-control" id="hora_visita" name="hora_visita" required>
                </div>

                <div class="mb-3">
                    <label for="sintomas" class="form-label">Síntomas</label>
                    <textarea class="form-control" id="sintomas" name="sintomas" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="id_medicamento" class="form-label">Medicamento</label>
                    <select class="form-control" id="id_medicamento" name="id_medicamento" required>
                        <option value="">Seleccione un medicamento</option>
                        <?php while ($row = $sqlMedicamentos->fetch_object()) { ?>
                            <option value="<?= $row->id_medicamento ?>"><?= $row->nombre ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="recomendaciones" class="form-label">Recomendaciones</label>
                    <textarea class="form-control" id="recomendaciones" name="recomendaciones" rows="3"></textarea>
                </div>

                <button value="ok" name="registrar" type="submit" class="btn btn-primary w-100">Guardar</button>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>