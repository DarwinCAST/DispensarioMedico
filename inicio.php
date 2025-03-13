<?php 
session_start();

if(empty($_SESSION["id"])){
  header("location: login.php");
}

?>

<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Dispensario medico</title>
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
      width: 560px;
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
  </style>
</head>

<body>
  <div class="sidebar">
    
    <header>Dispensario Medico, <?php echo "  Bienvenido " , $_SESSION["nombre"],"!!"; ?></header>
    <ul>
      <li><a href="./vistas/farmacos-vista/index.php"><i class="fas fa-qrcode"></i>Gestion de tipos de farmacos</a></li>
      <li><a href="./vistas/marcas-vista/index.php"><i class="fas fa-link"></i>Gestion de marcas</a></li>
      <li><a href="./vistas/ubicaciones-vista/index.php"><i class="fas fa-stream"></i>Gestion de ubicaciones</a></li>
      <li><a href="./vistas/medicamentos-vista/index.php"><i class="fas fa-calendar-week"></i>Gestion de medicamentos</a></li>
      <li><a href="./vistas/pacientes-vista/index.php"><i class="far fa-question-circle"></i>Gestion de pacientes</a></li>
      <li><a href="./vistas/medicos-vista/index.php"><i class="fas fa-sliders-h"></i>Gestion de medicos</a></li>
      <li><a href="./vistas/visitas-vista/index.php"><i class="far fa-envelope"></i>Registro de visitas</a></li>
      <li><a href="./controladores/Login/CerrarSesion.php">Cerrar sesion</a></li>

    </ul>
  </div>
  <br>
</body>

</html>