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

        //Validacion de cedula
        if (validaCedula($cedula)) {
            $cedulaMod = str_split($cedula);
            array_splice($cedulaMod, 3, 0, "-");
            array_splice($cedulaMod, 11, 0, "-");

            $cedulaFinal = implode("", $cedulaMod);
            //Validar si el numero de carnet es positivo

            if ($carnet >= 0 &&  !is_nan($carnet)) {
                $sql = $conexion->query("insert into gestion_pacientes(nombre_paciente,cedula_paciente,
            no_carnet,tipo_paciente) values('$nombre', '$cedulaFinal', '$carnet', '$tipo_paciente')");

                if ($sql == 1) {
                    echo '<div class= "alert alert-success">Paciente registrado correctamente</div>';
                } else {
                    echo '<div class= "alert alert-danger">Error al registrar Paciente</div>';
                }
            } else {
                echo '<div class= "alert alert-warning">Numero de carnet incorrecto, asegurese de colocarlo positivo</div>';
            }
        } else {
            echo '<div class= "alert alert-warning">Cedula Incorrecta</div>';
        }
    } else {
        echo '<div class= "alert alert-warning">Algunos de los campos esta vacio</div>';
    }
}
