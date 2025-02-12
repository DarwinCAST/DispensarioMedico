<?php
ob_start();
include("/laragon/www/ProyectoDispensarioMedico/php/main.php");
$id = $_GET["id"];

// Corregir la consulta para buscar por id_medicamento
$sql = $conexion->query("SELECT * FROM gestion_medicamentos WHERE id_medicamento = $id");
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
            padding-left: 40px;
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
            <li><a href="index.php"><i class="fas fa-calendar-week"></i> Gestion de medicamentos</a></li>
            <li><a href="../pacientes-vista/index.php"><i class="far fa-question-circle"></i> Gestion de pacientes</a></li>
            <li><a href="../medicos-vista/index.php"><i class="fas fa-sliders-h"></i> Gestion de medicos</a></li>
            <li><a href="../visitas-vista/index.php"><i class="far fa-envelope"></i> Registro de visitas</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="form-container">
            <h2>Modificar Medicamento</h2>
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
                <?php
                // Incluimos el controlador que realiza la consulta para obtener el medicamento a editar
                include("/laragon/www/ProyectoDispensarioMedico/controladores/Medicamentos/EditMedicamento.php");

                // Consultas para llenar los select de las tablas relacionadas
                $sqlFarmacos = $conexion->query("SELECT * FROM tipos_farmacos WHERE estado_farmaco = 'Activo'");
                $sqlMarcas = $conexion->query("SELECT * FROM gestion_marcas WHERE estado_marca = 'Activo'");
                $sqlUbicaciones = $conexion->query("SELECT * FROM gestion_ubicaciones");

                while ($datos = $sql->fetch_object()) { ?>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Medicamento</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($datos->nombre) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_farmaco" class="form-label">Tipo de Fármaco</label>
                        <select class="form-control" id="id_farmaco" name="id_farmaco" required>
                            <option value="">Seleccione un fármaco</option>
                            <?php
                            // Genera opciones para tipos de fármaco
                            while ($farmaco = $sqlFarmacos->fetch_object()) {
                                $selected = ($farmaco->id_farmaco == $datos->id_farmaco) ? 'selected' : '';
                                echo "<option value='{$farmaco->id_farmaco}' $selected>{$farmaco->nombre_farmaco}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_marca" class="form-label">Marca</label>
                        <select class="form-control" id="id_marca" name="id_marca" required>
                            <option value="">Seleccione una marca</option>
                            <?php
                            // Genera opciones para marcas
                            while ($marca = $sqlMarcas->fetch_object()) {
                                $selected = ($marca->id_marca == $datos->id_marca) ? 'selected' : '';
                                echo "<option value='{$marca->id_marca}' $selected>{$marca->nombre_marca}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_ubicacion" class="form-label">Ubicación</label>
                        <select class="form-control" id="id_ubicacion" name="id_ubicacion" required>
                            <option value="">Seleccione una ubicación</option>
                            <?php
                            // Genera opciones para ubicaciones
                            while ($ubicacion = $sqlUbicaciones->fetch_object()) {
                                $selected = ($ubicacion->id_ubicacion == $datos->id_ubicacion) ? 'selected' : '';
                                echo "<option value='{$ubicacion->id_ubicacion}' $selected>{$ubicacion->ubicacion}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="dosis" class="form-label">Dosis</label>
                        <input type="text" class="form-control" id="dosis" name="dosis" value="<?= htmlspecialchars($datos->dosis) ?>" required>
                    </div>
                <?php } ?>
                <button value="ok" name="registrar" type="submit" class="btn btn-primary w-100">Guardar</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>