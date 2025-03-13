<?php
function validaCedula($pCedula)
{
    $vnTotal = 0;
    // Elimina guiones y espacios en blanco
    $vcCedula = str_replace("-", "", $pCedula);
    $vcCedula = trim($vcCedula);
    $pLongCed = strlen($vcCedula);

    // Arreglo de multiplicadores para cada dígito
    $digitoMult = [1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1];

    // La cédula debe tener exactamente 11 dígitos
    if ($pLongCed !== 11) {
        return false;
    }

    // Se recorre cada dígito, se multiplica por el valor correspondiente y se suma
    for ($vDig = 0; $vDig < $pLongCed; $vDig++) {
        $num = intval(substr($vcCedula, $vDig, 1));
        $vCalculo = $num * $digitoMult[$vDig];

        if ($vCalculo < 10) {
            $vnTotal += $vCalculo;
        } else {
            // Suma de los dígitos del producto
            $vnTotal += intval($vCalculo / 10) + ($vCalculo % 10);
        }
    }

    // La cédula es válida si la suma total es divisible por 10
    return ($vnTotal % 10 === 0);
}


if (!empty($_POST["registrar"])) {
    if (
        !empty($_POST["nombre"]) and !empty($_POST["cedula"]) and !empty($_POST["tanda"])
        and !empty($_POST["especialidad"])
    ) {
        $nombre = $_POST["nombre"];
        $cedula = $_POST["cedula"];
        $tanda = $_POST["tanda"];
        $especialidad = $_POST["especialidad"];

        if (validaCedula($cedula)) {
            $cedulaMod = str_split($cedula);
            array_splice($cedulaMod, 3, 0, "-");
            array_splice($cedulaMod, 11, 0, "-");

            $cedulaFinal = implode("", $cedulaMod);
            $sql = $conexion->query("insert into gestion_medicos(nombre_medico,cedula_medico,
            tanda_medico,especialidad) values('$nombre', '$cedulaFinal', '$tanda', '$especialidad')");

            if ($sql == 1) {
                echo '<div class= "alert alert-success">Medico registrado correctamente</div>';
            } else {
                echo '<div class= "alert alert-danger">Error al registrar Medico</div>';
            }
        } else {
            echo '<div class= "alert alert-warning">Digite correctamente la cedula</div>';
        }
    } else {
        echo '<div class= "alert alert-warning">Algunos de los campos esta vacio</div>';
    }
}
