<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 20/8/2019
 * Time: 9:17 AM
 */
include '../gold/enlace.php';
$idIntegrante = $_POST["phpIdIntegrante"];
$tipoPago= $_POST["phpTipoPago"];
$valorPago= $_POST["phpValor"];
$fechaentrada = date('Y-m-d  h:i:s');


//CREAR NUMERO DE RECIBO INICIO



    $queryTomarCorrelativo = mysqli_query($enlace,"SELECT max(numeroRecibo+1 ) AS numeroNew FROM detallepagos
INNER JOIN promociones on detallepagos.idPromocion = promociones.idpromocion
where  promociones.`status` = 1");
    $datosTomarCorrelativo = mysqli_fetch_array($queryTomarCorrelativo,MYSQLI_ASSOC);
    $numeroRecibo = intval($datosTomarCorrelativo["numeroNew"]);




$ultimoCorrelativo = mysqli_query($enlace,"SELECT max(correlativo +1 ) AS numeroNew FROM integrantes ");
$datoUltimoCorrelativo = mysqli_fetch_array($ultimoCorrelativo,MYSQLI_ASSOC);
$corrNew= $datoUltimoCorrelativo["numeroNew"];
//CREAR NUMERO DE RECIBO FINAL



$queryTotalAbonado = mysqli_query($enlace,"SELECT SUM(valor) as totalAbonado FROM detallepagos 
INNER JOIN promociones on detallepagos.idPromocion = promociones.idpromocion
WHERE idIntegrante=$idIntegrante and promociones.`status`= 1");
$datosTotalAbonado= mysqli_fetch_array($queryTotalAbonado,MYSQLI_ASSOC);
$totalAbonado = $datosTotalAbonado["totalAbonado"];

if($totalAbonado ==""){
    $totalAbonado =0;
}

$queryTallaToga = mysqli_query($enlace,"SELECT detalle_integrantes.tallaToga,equipos.num_equipo,equipos.nombre_equipo from detalle_integrantes 
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
INNER JOIN equipos on detalle_integrantes.id_equipo = equipos.id_equipo
where promociones.`status` =1 and detalle_integrantes.id_integrante = $idIntegrante");
$datosTallaToga = mysqli_fetch_array($queryTallaToga,MYSQLI_ASSOC);
$tallaToga = $datosTallaToga["tallaToga"];
$numEquipo= $datosTallaToga["num_equipo"];
$nombreEquipo= $datosTallaToga["nombre_equipo"];

$queryTotalGastos = mysqli_query($enlace,"SELECT * from pagospromocion 
INNER JOIN promociones on pagospromocion.idPromocion = promociones.idpromocion
where promociones.`status`=1");
$datosTotalGastos = mysqli_fetch_array($queryTotalGastos,MYSQLI_ASSOC);
$totalGastos = $datosTotalGastos["valor"];

$saldoPendiente = $totalGastos-$totalAbonado;

if($saldoPendiente  ==0){
    $style ='style="color: red;float: right;margin-right: -7%;"';
}else{
    $style ='style="color: red;float: right;margin-right: -10%;"';
}

if($valorPago > $saldoPendiente){
    echo 1;
}else{

    $queryPromocion = mysqli_query($enlace,"SELECT * from promociones WHERE `status` = 1");
    $datosPromocion = mysqli_fetch_array($queryPromocion,MYSQLI_ASSOC);
    $idPromocion = $datosPromocion["idpromocion"];
    $queryInsertarPago = mysqli_query($enlace,"INSERT INTO detallepagos(detallepagos.idIntegrante,detallepagos.idTipoPago,
detallepagos.valor,detallepagos.numeroRecibo,detallepagos.fechaPago,detallepagos.idPromocion) 
VALUES ($idIntegrante,$tipoPago,$valorPago,$numeroRecibo,'".$fechaentrada."',$idPromocion);");


//TARJETA INICIO
    $queryDatosGenerales  = mysqli_query($enlace,"SELECT * from integrantes where idintegrante  = $idIntegrante");
    $datosGenerales = mysqli_fetch_array($queryDatosGenerales,MYSQLI_ASSOC);
    $nombre = $datosGenerales["nombre_integrante"];


    $queryTotalAbonado = mysqli_query($enlace,"SELECT SUM(valor) as totalAbonado FROM detallepagos 
INNER JOIN promociones on detallepagos.idPromocion = promociones.idpromocion
WHERE idIntegrante=$idIntegrante and promociones.`status`= 1");
    $datosTotalAbonado= mysqli_fetch_array($queryTotalAbonado,MYSQLI_ASSOC);
    $totalAbonado = $datosTotalAbonado["totalAbonado"];

    if($totalAbonado ==""){
        $totalAbonado =0;
    }

    $queryTotalGastos = mysqli_query($enlace,"SELECT * from pagospromocion 
INNER JOIN promociones on pagospromocion.idPromocion = promociones.idpromocion
where promociones.`status`=1");
    $datosTotalGastos = mysqli_fetch_array($queryTotalGastos,MYSQLI_ASSOC);
    $totalGastos = $datosTotalGastos["valor"];

    $saldoPendiente = $totalGastos-$totalAbonado;
    if($saldoPendiente  ==0){
        $style ='style="color: red;float: right;margin-right: -7%;"';
    }else{
        $style ='style="color: red;float: right;margin-right: -10%;"';
    }
    $tarjeta = '
    <div class="panel-group accordion" id="accordion">
                                 <div class="panel panel-default" style=" border-radius: 10px;">
                                     <div class="panel-heading">
                                         <h4 class="panel-title">
                                             <a  style="color: gray;font-size: xx-large">
                                                 '.utf8_encode($nombre).'
                                                 <input type="hidden" id="idIntegranteInput" value="'.$idIntegrante.'">
                                             </a>
                                             <a title="VER DETALLES" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" aria-expanded="false"> <img style="margin-top: -1%" src="myfiles/img/downArrow.gif"></a>
                                            
                                                 <a style="font-size: xx-large;float: right; color: #018BF5; margin-right: 7%;">
                                                 L. '.$saldoPendiente.'
                                             </a>    
                                             
                                            <a onclick="cerrarCard();" '.$style.' title="CERRAR"><i class="fa fa-times-circle"></i></a>
                                             <span class="label label-danger pull-right" style="border-radius: 10px;font-size: xx-small; margin-right: -8%;margin-top: -1%">SALDO PENDIENTE</span>
                                         </h4>
                                     </div>
                                     <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                         <div class="panel-body">
                                           <div id="abonos">
                                           ';

    $confirmarAbonos = mysqli_num_rows(mysqli_query($enlace,"SELECT * from detallepagos
INNER JOIN promociones on detallepagos.idPromocion = promociones.idpromocion
WHERE detallepagos.idIntegrante = $idIntegrante and promociones.`status` = 1"));
    $contadorAbonos = 1;
    if($confirmarAbonos>0){
        //SI TIENE ABONOS INICIO
        $espanol = "SET lc_time_names = 'es_ES';";
        $queryTomarDatosAbonos = mysqli_query($enlace,"
SELECT CAST(detallepagos.fechaPago AS DATE) as fecha,detallepagos.valor,tipopago.nombre,idDetallePagos from detallepagos
INNER JOIN promociones on detallepagos.idPromocion = promociones.idpromocion
INNER JOIN tipopago on detallepagos.idTipoPago = tipopago.idTipoPago
WHERE detallepagos.idIntegrante = $idIntegrante and promociones.`status` = 1");
        while ($datosAbonosListar = mysqli_fetch_array($queryTomarDatosAbonos,MYSQLI_ASSOC)){

            //TIPO PAGO INICIO
            $tipoPago= $datosAbonosListar["nombre"];
            $idDetallePago= $datosAbonosListar["idDetallePagos"];
            //TIPO PAGO FINAL

            //CONVERTIR FECHA INICIO
            $fecha =  $datosAbonosListar["fecha"];
            $dia = substr($fecha,8,2);
            $mes = substr($fecha,5,2);
            $aaa = substr($fecha,0,4);

            switch ($mes){
                case 01:
                    $miMes = "ENERO";
                    break;

                case 02:
                    $miMes = "FEBRERO";
                    break;

                case 03:
                    $miMes = "MARZO";
                    break;

                case 04:
                    $miMes = "ABRIL";
                    break;

                case 05:
                    $miMes = "MAYO";
                    break;

                case 06:
                    $miMes = "JUNIO";
                    break;

                case 07:
                    $miMes = "JULIO";
                    break;

                case "08":
                    $miMes = "AGOSTO";
                    break;

                case "09":
                    $miMes = "SEPTIEMBRE";
                    break;

                case 10:
                    $miMes = "OCTUBRE";
                    break;

                case 11:
                    $miMes = "NOVIEMBRE";
                    break;

                case 12:
                    $miMes = "DICIEMBRE";
                    break;
            }


            $fCompleta = $dia."-".$miMes."-".$aaa;
            //CONVERTIR FECHA FINAL
            $tarjeta.='
         
                                              <div class="itemSC">
                                                <div class="descriptionSC">
                                                    <a style="font-size:medium;color: #018BF5" onclick="enviarAColaPrint('.$idDetallePago.',\''.$fCompleta.'\')">'.$tipoPago.' '.$contadorAbonos.'</a>
                                                    <p style="font-size: large"> '.$fCompleta.'</p>
                                                </div>
                                                <p class="subpriceSC" style="font-size: large">L.'.$datosAbonosListar["valor"].'</p>
                                               </div>
                                                ';
            $contadorAbonos++;
        }
        //SI TIENE ABONOS FINAL
    }else{

        //NO TIENE ABONOS INICIO
        $tarjeta.='
                                            <h4 style="color: red;">SIN ABONOS POR EL MOMENTO</h4>
                                            ';
        //NO TIENE ABONOS FINAL

    }
    $tarjeta.='
                                       
    

                                               <hr>

                                               <div class="itemSC">
                                                   <div class="descriptionSC">
                                                       <p style="font-size: large;color:#28A745 "> TOTAL PAGADO</p>
                                                   </div>
                                                   <p class="subpriceSC" style="font-size: large;color: #28A745">L.'.$totalAbonado.'</p>
                                               </div>


                                               <!--BOTONES INICIO-->
                                               <div align="center" class="col-md-4" style="background-color:#FFC107;color: white; border-top-left-radius:10px;">
                                                   <h2 onclick="openModalPago();"><i class="fa fa-plus-circle"></i></h2>
                                                   <p>AÑADIR PAGO</p>
                                               </div>

                                               <div align="center" class="col-md-4" style="background-color:#11a73a;color: white;">
                                                   <h2 onclick="verDetalles()"><i class="fa fa-list-alt"></i></h2>
                                                   <p> VER DETALLES</p>
                                               </div>

                                                <div onclick="imprimirRecibo();" align="center" class="col-md-4" style="background-color:#007BFF;border-top-right-radius:10px;color: white;">
                                                   <h2 id="printIcon"><i class="fa fa-print"></i></h2>
                                                   <p id="datoReciboAImprimir">IMPRIMIR RECIBO</p>
                                                   <input type="hidden" id="idDetallePagoEnCola">
                                                  
                                               </div>
                                               <!--BOTONES FINAL-->
                                           </div>

                                             <div id="detalles" class="collapse">
                                                   <div class="itemSC">
                                                   <div class="hidden collapse">
                                                   <input type="hidden" id="tallaDetalle" value="'.$tallaToga.'">
                                                   </div>
                                                        <div class="descriptionSC">
                                                            <p style="font-size: large;"> EQUIPO</p>
                                                         </div>
                                                        <p class="subpriceSC" style="font-size: large;color:GrayText">'.$numEquipo.'.'.$nombreEquipo.'</p>
                                                    </div>
                                                    
                                                     <div class="itemSC">
                                                        <div class="descriptionSC">
                                                            <p style="font-size: large;"> TALLA TOGA</p>
                                                         </div>
                                                           <div class="input-group" style="border-radius: 10px">
                                                            <select style="font-size: large;color:GrayText;border-top-left-radius:10px;border-bottom-left-radius: 10px"  id="togaTallaSelect" class=" form-control subpriceSC">
                                                                <option style="border-radius: 10px" value="">ELIGE TU TALLA</option>
                                                                <option style="border-radius: 10px"  value="S">S</option>
                                                                <option style="border-radius: 10px" value="L">L</option>
                                                                <option style="border-radius: 10px" value="M">M</option>
                                                            </select>
                                                            <span id="inputGuardarNuevaTalla" style="background-color: #343A40; color: white;border-top-right-radius:10px;border-bottom-right-radius: 10px" class="input-group-addon" onclick="cambioTalla();"><i class="fa fa-save"></i></span>
                                                            
                                                        </div>
                                                       

                                                    </div>

                                                 <div align="center" class="col-md-12" style="background-color:#007BFF;border-top-left-radius:10px;;border-top-right-radius:10px;color: white;">
                                                     <h5 onclick="regresar();"><i class="fa fa-caret-square-o-left" title="REGRESAR"></i> REGRESAR</h5>
                                                 </div>
                                             </div>



                                         </div>
                                     </div>
                                 </div>


                             </div>
                                        ';





//TARJETA FINAL

    echo $tarjeta;
}

?>