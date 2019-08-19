<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 16/8/2019
 * Time: 8:35 AM
 */
include '../gold/enlace.php';

$idIntegrante = $_POST["phpIdIntegrante"];

$confirmar = mysqli_num_rows(mysqli_query($enlace,"SELECT * from detalle_integrantes
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE detalle_integrantes.id_integrante = '.$idIntegrante.' and promociones.`status` = 1 and detalle_integrantes.`status`= 1"));

if($confirmar>0){
    //SI ENLAZADO INICIO

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
                                            
                                                 <a style="font-size: xx-large;float: right; color: #018BF5; margin-right: 2%;">
                                                 L. '.$saldoPendiente.'
                                             </a>
                                            
                                            <a onclick="cerrarCard();" style="color: red;float: right;margin-right: -10%;" title="CERRAR"><i class="fa fa-times-circle"></i></a>
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
SELECT CAST(detallepagos.fechaPago AS DATE) as fecha,detallepagos.valor,tipopago.nombre from detallepagos
INNER JOIN promociones on detallepagos.idPromocion = promociones.idpromocion
INNER JOIN tipopago on detallepagos.idTipoPago = tipopago.idTipoPago
WHERE detallepagos.idIntegrante = $idIntegrante and promociones.`status` = 1");
                                            while ($datosAbonosListar = mysqli_fetch_array($queryTomarDatosAbonos,MYSQLI_ASSOC)){

                                                //TIPO PAGO INICIO
                                                $tipoPago= $datosAbonosListar["nombre"];
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
                                                    <a href="#" style="font-size:medium;color: #018BF5">'.$tipoPago.' '.$contadorAbonos.'</a>
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

                                               <div align="center" class="col-md-4" style="background-color:#007BFF;border-top-right-radius:10px;color: white;">
                                                   <h2><i class="fa fa-print"></i></h2>
                                                   <p>IMPRIMIR RECIBO</p>
                                               </div>
                                               <!--BOTONES FINAL-->
                                           </div>

                                             <div id="detalles" class="collapse">
                                                   <div class="itemSC">
                                                        <div class="descriptionSC">
                                                            <p style="font-size: large;"> EQUIPO</p>
                                                         </div>
                                                        <p class="subpriceSC" style="font-size: large;color:GrayText">1. DAVID</p>
                                                    </div>
                                                    
                                                     <div class="itemSC">
                                                        <div class="descriptionSC">
                                                            <p style="font-size: large;"> TALLA TOGA</p>
                                                         </div>
                                                        <p class="subpriceSC" style="font-size: large;color:GrayText">S</p>
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



    echo  $tarjeta;
    //SI ENLAZADO FINAL
}else{
    //NO ENLAZADO INICIO
    echo 2;
    //NO ENLAZADO FINAL
}
?>