<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 29/7/2019
 * Time: 8:20 AM
 */
include '../gold/enlace.php';
$identidad = $_POST["phpIdentidad"];


$confirm = mysqli_num_rows( mysqli_query($enlace,"SELECT * from servidores where num_identidad = '".$identidad."'"));
if($confirm>0){
    //SI EXISTE INICIO

    $query = mysqli_query($enlace,"SELECT * from servidores where num_identidad = '".$identidad."'");
    $datos = mysqli_fetch_array($query,MYSQLI_ASSOC);

    $nombre= $datos["nombre_integrante"];
    $genero= $datos["sexo"];
    $fechaNacimiento= $datos["fecha_cumple"];
    $tipoSangre= $datos["tipoSangre"];
    $direccion= $datos["direccion"];
    $referencia= $datos["referencia"];
    $tipoCasa= $datos["tipoCasa"];
    $transporte= $datos["trasporte"];
    $tel1= $datos["cel"];
    $tel2= $datos["tel"];
    $correo= $datos["correo"];
    $civil= $datos["estado_civil"];
    $conyugue= $datos["conyugue"];
    $hijos= $datos["hijos"];
     $fechaConversion= $datos["f_conversion"];
    if($fechaConversion == "1970-01-01"){
        $fechaConversion = "";
    }
     $fechaIglesia= $datos["f_iglesia"];
     if($fechaIglesia == "1970-01-01"){
         $fechaIglesia = "";
     }
     $bautismoEs= $datos["bautismoEs"];
     $fechaReconciliacion= $datos["f_reconciliacion"];
    if($fechaReconciliacion == "1970-01-01"){
        $fechaReconciliacion = "";
    }
     $fechaBautismoAguas= $datos["f_bautismoAguas"];
    if($fechaBautismoAguas == "1970-01-01"){
        $fechaBautismoAguas = "";
    }
     $fechaCobertura= $datos["f_cobertura"];
    if($fechaCobertura == "1970-01-01"){
        $fechaCobertura = "";
    }
     $promocionCorderitos= $datos["promo_cordero"];
     $areas= $datos["areas"];
     $promocionMayordomia= $datos["promMayordomia"];
     $expediente= $datos["expedienteMayordomia"];
         $nivelEducativo= $datos["nivelEducativo"];
         $profesion= $datos["profesion"];
         $habilidades= $datos["habilidades"];

    $estadoLaboral= $datos["estadoLaboral"];
    $empresa= $datos["empresa"];
    $puesto= $datos["puesto"];
    $telEmpresa= $datos["telEmpresa"];
    $horario= $datos["horario"];

    $carnet= $datos["carnet"];
    $fechaVigencia= $datos["vigencia"];
    if($fechaVigencia == "1970-01-01"){
        $fechaVigencia = "";
    }
    $fechaGestion= $datos["f_gestion"];
    if($fechaGestion == "1970-01-01"){
        $fechaGestion = "";
    }
    $fechaEntrega= $datos["f_entrega"];
    if($fechaEntrega == "1970-01-01"){
        $fechaEntrega = "";
    }
    $nombreCarnet= $datos["nombreCarnet"];
    $fechaInicioMayordomia= $datos["f_inicioMayordomia"];
    if($fechaInicioMayordomia == "1970-01-01"){
        $fechaInicioMayordomia = "";
    }
    $observaciones= $datos["observaciones"];
    $registradoPor= $datos["registradoPor"];


    $datos = array(
        0 => $nombre,
        1 => $genero,
        2 => $fechaNacimiento,
        3 => $tipoSangre,
         4 => $direccion,
         5 => $referencia,
         6 => $tipoCasa,
         7 => $transporte,
         8 => $tel1,
         9 => $tel2,
         10 => $correo,
         11 => $civil,
         12 => $conyugue,
         13 => $hijos,
         14 => $fechaConversion,
         15 => $fechaIglesia,
         16 => $bautismoEs,
         17 => $fechaReconciliacion,
         18 => $fechaBautismoAguas,
         19 => $fechaCobertura,
         20 => $promocionCorderitos,
         21 => $areas,
         22 => $promocionMayordomia,
         23 => $expediente,
        24 => $nivelEducativo,
        25 => $profesion,
        26 => $habilidades,
        27 => $estadoLaboral,
        28 => $empresa,
        29 => $puesto,
        30 => $telEmpresa,
        31 => $horario,
        32 => $carnet,
        33 => $fechaVigencia,
        34 => $fechaGestion,
        35 => $fechaEntrega,
        36 => $nombreCarnet,
        37 => $fechaInicioMayordomia,
        38 => $observaciones,
        39 => $registradoPor,
        40 => 1

    );
    echo json_encode($datos);

    //SI EXISTE FINAL
}else{
    $datos = array(
        40 => 0
    );
    echo json_encode($datos);
}

