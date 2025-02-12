<?php

#Conexion a la base de datos


//$pdo = new PDO("mysql:host=localhost;dbname=dispensariomedico", "root", "");
//$pdo ->set_charset("utf8");

$conexion = new mysqli("localhost","root","","dispensariomedico");
$conexion ->set_charset("utf8");