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
        !empty($_POST["nombre"]) and !empty($_POST["cedula"]) and !empty($_POST["carnet"])
        and !empty($_POST["tipo_paciente"])
    ) {
        $nombre = $_POST["nombre"];
        $cedula = $_POST["cedula"];
        $carnet = $_POST["carnet"];
        $tipo_paciente = $_POST["tipo_paciente"];


        if (validaCedula($cedula)) {
            $cedulaMod = str_split($cedula);
            array_splice($cedulaMod, 3, 0, "-");
            array_splice($cedulaMod, 11, 0, "-");

            $cedulaFinal = implode("", $cedulaMod);

            $resultado_update = $conexion->query("UPDATE gestion_pacientes SET nombre_paciente = '$nombre',
            cedula_paciente = '$cedulaFinal', no_carnet = '$carnet', tipo_paciente = '$tipo_paciente' WHERE id_paciente = $id");

            if ($resultado_update) {
                header("location: index.php");
                exit();
            } else {
                echo '<div class= "alert alert-danger">Error al modificar paciente</div>';
            }
        } else {
            echo '<div class= "alert alert-warning">Favor digitar correctamente la cedula</div>';
        }
    }
}

ob_end_flush();
