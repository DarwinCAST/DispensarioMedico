<?php
include_once("/laragon/www/ProyectoDispensarioMedico/php/main.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tipos de Fármacos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c35b649b73.js" crossorigin="anonymous"></script>
</head>
<script>
    function eliminar(){
        let respuesta = confirm("Estas seguro que deseas eliminar?");
        return respuesta;
    }
</script>

<body>
    <div class="sidebar">
        <header>Dispensario Medico</header>
        <ul>
            <li><a href="../farmacos-vista/index.php"><i class="fas fa-qrcode"></i> Gestion de tipos de farmacos</a></li>
            <li><a href="../marcas-vista/index.php"><i class="fas fa-link"></i> Gestion de marcas</a></li>
            <li><a href="index.php"><i class="fas fa-stream"></i> Gestion de ubicaciones</a></li>
            <li><a href="../medicamentos-vista/index.php"><i class="fas fa-calendar-week"></i> Gestion de medicamentos</a></li>
            <li><a href="../pacientes-vista/index.php"><i class="far fa-question-circle"></i> Gestion de pacientes</a></li>
            <li><a href="../medicos-vista/index.php"><i class="fas fa-sliders-h"></i> Gestion de medicos</a></li>
            <li><a href="../visitas-vista/index.php"><i class="far fa-envelope"></i> Registro de visitas</a></li>
        </ul>
    </div>

    <div class="content">
        <h2 class="text-center mb-4">Gestión de Ubicaciones</h2>
        <?php
        include("/laragon/www/ProyectoDispensarioMedico/controladores/UbicacionesFarmacos/DeleteUbicacion.php");

        ?>

        <div class="btn-create">
            <a href="create.php" class="btn btn-success">
                <i class="fas fa-plus"></i> Crear Ubicacion
            </a>
        </div>

        <table class="table table-striped table-hover">
            <thead class="bg-info text-white">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Ubicacion</th>
                    <th scope="col">Estante</th>
                    <th scope="col">Tramo</th>
                    <th scope="col">Casilla</th>

                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = $conexion->query("SELECT * FROM gestion_ubicaciones");

                while ($datos = $sql->fetch_object()) { ?>
                    <tr>
                        <th scope="row"><?= $datos->id_ubicacion ?></th>
                        <td><?= $datos->ubicacion ?></td>
                        <td><?= $datos->estante ?></td>
                        <td><?= $datos->tramo ?></td>
                        <td><?= $datos->casilla ?></td>

                        <td class="text-center">
                            <a href="edit.php?id=<?= $datos->id_ubicacion ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a onclick="return eliminar() " href="index.php?id=<?= $datos->id_ubicacion ?>" class="btn btn-danger btn-sm"">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>