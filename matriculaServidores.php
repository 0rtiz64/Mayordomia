<?php
session_start();
if (isset($_SESSION['ingreso']) && $_SESSION['ingreso']=='YES')
{?>
    <?php
    include 'php/noCache.php';
    ?>
    <!DOCTYPE html>
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mayordomia</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Fonts from Font Awsome -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- CSS Animate -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- Custom styles for this theme -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- Fonts -->
    <link href='css/itallic.css' rel='stylesheet' type='text/css'>
    <link href='css/opensans.css' rel='stylesheet' type='text/css'>
    <style>
        .myPanel{
            background-color: #424242;
        }
    </style>

    <!--DatePicker-->
    <link rel="stylesheet" href="myfiles/DatePicker/css/bootstrap-datepicker.css">




    <!--ALERTIFY INICIO-->
    <link rel="stylesheet" href="alertify/css/alertify.css">
    <link rel="stylesheet" href="alertify/css/themes/bootstrap.css">
    <!--ALERTIFY FIN-->


    <!-- Feature detection -->
    <script src="assets/js/modernizr-2.6.2.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->


</head>
<body>
<section id="container">
    <header id="header">
        <!--logo start-->
        <div class="brand">
            <a href="#" class="logo">Mayordomia</a>
        </div>
        <!--logo end-->
        <div class="toggle-navigation toggle-left">
            <button type="button" class="btn btn-default" id="toggle-left" data-toggle="tooltip" data-placement="right" title="Desplazar Menu">
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <div class="user-nav">
            <ul>

                <ul class="dropdown-menu alert animated fadeInDown">







                    <li>
                        <a href="#">
                            <div class="profile-photo">
                                <img src="myfiles/img/logo2.png" alt="" class="img-circle">
                            </div>
                            <div class="message-info">
                                <span class="sender">Ellen Baker</span>
                                <span class="time">7 hours</span>
                                <div class="message-content">Sem dapibus in, orci bibendum faucibus tellus, justo arcu...</div>
                            </div>
                        </a>
                    </li>

                </ul>

                </li>
                <li class="profile-photo">
                    <img src="myfiles/img/logo2.png"  class="img-circle" style="margin-top: -3%;width: 40px; height: 40px; float: right">
                </li>
                <li class="dropdown settings">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php  echo $_SESSION['nombre']; ?><i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu animated fadeInDown">
                        <li>
                            <a href="javascript: void(0)" onclick='cerrar();'><i class="fa fa-power-off"></i> Cerrar Sesion</a>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
    </header>
    <!--sidebar start-->
    <aside class="sidebar">
        <div id="leftside-navigation" class="nano">
            <ul class="nano-content">

                <?php
                include 'menu.php';
                $permisos = $_SESSION['area'];
                $focusMenu = "M0";
                $focusSubMenu = "SM0.1";
                menuSubmenu($permisos,$focusMenu,$focusSubMenu);
                ?>

            </ul>
        </div>

    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <form class="form-horizontal" id="formularioReporteEquipo">
        <section class="main-content-wrapper">
            <section id="main-content">
                <div class="row">
                    <h1 class="h1">REGISTRO SERVIDORES</h1>

                    <div class="col-md-12">
                        <div class="panel-group accordion" id="accordion">
                            <div id="divDatosGenerales" class="panel">
                                <div class="panel-heading myPanel" id="divDatosGeneralesHeader">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" style="color: white">
                                            A) DATOS GENERALES
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <div class="col-md-12 form-group">
                                                <input style="text-transform: uppercase" type="text" class="form-control" id="inputIdentidadRegister" placeholder="IDENTIDAD" title="IDENTIDAD">
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <div class="col-md-6">
                                                <input style="text-transform: uppercase;" id="inputNombreRegister"  type="text" class="form-control has-error" placeholder="NOMBRE COMPLETO" title="NOMBRE COMPLETO">

                                            </div>

                                            <div class="col-md-6">
                                                <select  id="inputGeneroRegister" class="form-control" title="GENERO">
                                                    <option value="">GENERO</option>
                                                    <option value="M">MASCULINO</option>
                                                    <option value="F">FEMENINO</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <div class="col-md-6">
                                                <input style="text-transform: uppercase" type="date" class="form-control" id="inputFechaNacimientoRegister" placeholder="FECHA NACIMIENTO" title="FECHA NACIMIENTO">
                                            </div>

                                            <div class="col-md-6">
                                                <input style="text-transform: uppercase" type="text" class="form-control" id="inputTipoSangreRegister" placeholder="TIPO DE SANGRE" title="TIPO DE SANGRE">
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div id="divDomicilio" onclick="validarDatosGenerales()" class="panel">
                                <div class="panel-heading myPanel" id="divDomicilioHeader">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="color: #FFFFFF">
                                           B) DOMICILIO Y FAMILIAR
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-md-12 form-group">
                                            <div class="col-md-6">
                                                <input style="text-transform: uppercase" type="text" class="form-control" placeholder="DIRECCION" id="inputDireccionRegister" title="DIRECCION">
                                            </div>
                                            <div class="col-md-6">
                                                <input style="text-transform: uppercase" type="text" class="form-control" placeholder="REFERENCIA" id="inputReferenciaRegister" title="REFERENCIA">
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <div class="col-md-6">
                                                <select  id="inputTipoCasaRegister" class="form-control" title="TIPO CASA">
                                                    <option value="">TIPO CASA</option>
                                                    <option value="PROPIA">PROPIA</option>
                                                    <option value="FAMILIAR">FAMILIAR</option>
                                                    <option value="ALQUILADA">ALQUILADA</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <select  id="inputTransporteRegister" class="form-control" title="¿NECESITA TRANSPORTE?">
                                                    <option value="">¿NECESITA TRANSPORTE?</option>
                                                    <option value="Si">SI</option>
                                                    <option value="No">NO</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <div class="col-md-6">
                                                <input style="text-transform: uppercase" type="text" class="form-control" placeholder="TELEFONO 1" id="inputTel1Register" title="TELEFONO 1">
                                            </div>
                                            <div class="col-md-6">
                                                <input style="text-transform: uppercase" type="text" class="form-control" placeholder="TELEFONO 2" id="inputTel2Register" title="TELEFONO 2">
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <div class="col-md-6">
                                                <input style="text-transform: uppercase" type="text" class="form-control" placeholder="CORREO" id="inputCorreoRegister" title="CORREO">
                                            </div>
                                            <div class="col-md-6">
                                                <select  id="inputCivilRegister" class="form-control" title="ESTADO CIVIL">
                                                    <option value="">ESTADO CIVIL</option>
                                                    <option value="Casado">CASADO</option>
                                                    <option value="Soltero">SOLTERO</option>
                                                    <option value="Divorciado">DIVORCIADO</option>
                                                    <option value="Viudo">VIUDO</option>
                                                    <option value="Union">UNION LIBRE</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <div class="col-md-6">
                                                <input style="text-transform: uppercase" type="text" class="form-control" placeholder="CONYUGUE" id="inputConyugueRegister" title="CONYUGUE">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number"  min="0" class="form-control" placeholder="HIJOS" id="inputHijosRegister" title="HIJOS">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="divIglesia" onclick="validarDatosDomicilio()" class="panel">
                                <div class="panel-heading myPanel" id="divIglesiaHeader">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="color: #FFFFFF">
                                           C) IGLESIA
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-md-12 form-group">
                                            <div class="col-md-6">
                                                <label> FECHA DE CONVERSION</label>
                                                <input style="text-transform: uppercase" type="date" class="form-control" id="inputFechaConversionRegister" placeholder="FECHA DE CONVERSION"  title="FECHA DE CONVERSION">

                                            </div>

                                            <div class="col-md-6">
                                                <label> FECHA EN IGLESIA</label>
                                                <input type="date" id="inputFechaIglesiaRegister" class="form-control" title="FECHA IGLESIA">
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <div class="col-md-6">
                                                <label> ¿BAUTISMO ESPIRITU SANTO?</label>
                                                <select  id="inputBautismoEsRegister" class="form-control" title="BAUTIMO ESPIRITU SANTO">
                                                    <option value="">BAUTISMO ESPIRITU SANTO</option>
                                                    <option value="Si">SI</option>
                                                    <option value="No">NO</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label> FECHA DE RECONCILIACION</label>
                                                <input type="date" id="inputFechaReconciliacionRegister" class="form-control" title="FECHA DE RECONCILIACION">
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <div class="col-md-6">
                                                <label> FECHA BAUTISMO EN AGUAS</label>
                                                <input type="date" id="inputFechaBautismoAguasRegister" class="form-control" title="FECHA BAUTISMO EN AGUAS">
                                            </div>

                                            <div class="col-md-6">
                                                <label> FECHA COBERTURA</label>
                                                <input type="date" id="inputFechaCoberturaRegister" class="form-control" title="FECHA COBERTURA">
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <div class="col-md-6">
                                                <label> PROMOCION CORDERITOS</label>
                                                <input type="number" min="0" id="inputPromocionCorderitosRegister" class="form-control" title="PROMOCION CORDERITOS" placeholder="PROMOCION CORDERITOS">
                                            </div>

                                            <div class="col-md-6">
                                                <label>OTRAS AREAS DONDE SIRVE</label>
                                                <input style="text-transform: uppercase" type="text" id="inputAreasRegister" class="form-control" title="OTRAS AREAS DONDE SIRVE " placeholder="OTRAS AREAS DONDE SIRVE">
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <div class="col-md-6">
                                                <label> PROMOCION MAYORDOMIA</label>
                                                <input type="number" min="0" id="inputPromocionMayordomiaRegister" class="form-control" title="PROMOCION MAYORDOMIA" placeholder="PROMOCION MAYORDOMIA">
                                            </div>

                                            <div class="col-md-6">
                                                <label> EXPEDIENTE MAYORDOMIA</label>
                                                <input style="text-transform: uppercase" type="text" id="inputExpedienteRegister" class="form-control" title="EXPEDIENTE MAYORDOMIA" placeholder="EXPEDIENTE MAYORDOMIA">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="divEducacion"  class="panel">
                                <div class="panel-heading myPanel" id="divEducacionHeader">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" style="color: #FFFFFF">
                                           D) EDUCACION
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-md-12 form-group">
                                            <div class="col-md-6">
                                                <select  id="inputNivelEducativoRegister" class="form-control">
                                                    <option value="">NIVEL EDUCATIVO</option>
                                                    <option value="MAESTRIA">MAESTRIA</option>
                                                    <option value="PRIMARIA">PRIMARIA</option>
                                                    <option value="SECUNDARIA">SECUNDARIA</option>
                                                    <option value="SIN ESTUDIOS">SIN ESTUDIOS</option>
                                                    <option value="UNIVERSIDAD">UNIVERSIDAD</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <input style="text-transform: uppercase" type="text" class="form-control" id="inputProfesionRegister" placeholder="PROFESION U OFICIO" title="PROFECION U OFICIO    ">
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <div class="col-md-12">
                                                <input style="text-transform: uppercase" type="text" class="form-control" id="inputHabilidadesRegister" placeholder="HABILIDADES" title="HABILIDADES">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="divLaboral"  class="panel">
                                <div class="panel-heading myPanel" id="divLaboralHeader">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" style="color: #FFFFFF">
                                            E) LABORAL
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFive" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-md-12 form-group">
                                            <div class="col-md-6">
                                                <select  id="inputEstadLaboralRegister" class="form-control" title="ESTADO LABORAL">
                                                    <option value="">ESTADO LABORAL</option>
                                                    <option value="DESEMPLEADO">DESEMPLEADO</option>
                                                    <option value="LABORANDO">LABORANDO</option>
                                                    <option value="ESTUDIANTE">ESTUDIANTE</option>
                                                    <option value="TEMPORAL">TEMPORAL</option>
                                                    <option value="AMA DE CASA">AMA DE CASA</option>
                                                    <option value="INDEPENDIENTE">INDEPENDIENTE</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <input style="text-transform: uppercase" class="form-control" type="text" id="inputEmpresaRegister" placeholder="EMPRESA" title="EMPRESA">
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <div class="col-md-4">
                                                <input style="text-transform: uppercase" class="form-control" type="text" id="inputPuestoRegister" placeholder="PUESTO QUE DESEMPEÑA" title="PUESTO QUE DESEMPEÑA">
                                            </div>

                                            <div class="col-md-4">
                                                <input style="text-transform: uppercase" class="form-control" type="text" id="inputTelEmpresaRegister" placeholder="TELEFONO DE EMPRESA" title="TELEFONO DE EMPRESA">
                                            </div>

                                            <div class="col-md-4">
                                                <input style="text-transform: uppercase" class="form-control" type="text" id="inputHorarioRegister" placeholder="HORARIO" title="HORARIO">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div id="divExpediente"  class="panel">
                                <div class="panel-heading myPanel" id="divExpedienteHeader">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" style="color: #FFFFFF">
                                          F) CONTROL DE EXPEDIENTE
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSix" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-md-12 form-group">
                                            <div class="col-md-4">
                                                <label>CARNET</label>
                                                <select  id="inputCarnetRegister" class="form-control" title="CARNET">
                                                    <option value="">CARNET</option>
                                                    <option value="Si">SI</option>
                                                    <option value="No">NO</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>FECHA DE VIGENCIA</label>
                                                <input type="date" class="form-control" id="inputVigenciaCarnetRegister" title="FECHA DE VIGENCIA">
                                            </div>
                                            <div class="col-md-4">
                                                <label>FECHA DE GESTION</label>
                                                <input type="date" class="form-control" id="inputFechaGestionRegister" title="FECHA DE GESTION">
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <div class="col-md-4">
                                                <label>FECHA DE ENTREGA</label>
                                                <input type="date" class="form-control" id="inputFechaEntregaRegister" title="FECHA DE ENTREGA">
                                            </div>
                                            <div class="col-md-4">
                                                <label>NOMBRE EN CARNET</label>
                                                <input style="text-transform: uppercase" type="text" class="form-control" placeholder="NOMBRE EN CARNET" id="inputNombreCarnetEntregaRegister" title="NOMBRE EN CARNET">
                                            </div>
                                            <div class="col-md-4">
                                                <label>FECHA INICIO MAYORDOMIA</label>
                                                <input type="date" class="form-control" id="inputInicioMayordomiaRegister" title="FECHA INICIO MAYORDOMIA">
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <div class="col-md-4">
                                                <label>EQUIPO DE SERVICIO</label>
                                                <select id="inputEquipoRegister" class="form-control" title="EQUIPO DE SERVICIO">
                                                    <option value="">EQUIPO DE SERVICIO</option>
                                                    <?php
                                                    include "gold/enlace.php";
                                                    $queryEquiposSelect = mysqli_query($enlace,"SELECT * from servicioequipos WHERE estado =1 GROUP BY nombreEquipo ASC");
                                                    while ($datosEquiposSelect = mysqli_fetch_array($queryEquiposSelect,MYSQLI_ASSOC)){
                                                        echo'<option value="'.$datosEquiposSelect["idEquipo"].'">'.$datosEquiposSelect["nombreEquipo"].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>CARGO</label>
                                                <select  id="inputCargoRegister" class="form-control" title="CARGO">
                                                    <option value="">CARGO</option>
                                                    <?php
                                                    include "gold/enlace.php";
                                                    $queryCargosSelect =  mysqli_query($enlace,"SELECT * from serviciocargos GROUP BY nombreCargo ASC");
                                                    while ($datosCargos = mysqli_fetch_array($queryCargosSelect,MYSQLI_ASSOC)){
                                                        echo'<option value="'.$datosCargos["idCargo"].'">'.$datosCargos["nombreCargo"].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>ESTADO</label>
                                                <select id="inputEstadoRegister" class="form-control" title="ESTADO">
                                                    <option value="">ESTADO</option>
                                                    <option value="1">ACTIVO</option>
                                                    <option value="2">INACTIVO</option>
                                                    <option value="3">RETIRADO</option>
                                                    <option value="4">SUSPENDIDO</option>
                                                    <option value="5">CON PERMISO</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <div class="col-md-12">
                                                <label>OBSERVACIONES</label>
                                                <textarea  style="text-transform: uppercase" class="form-control" id="inputObservacionesRegister" cols="90" rows="5" placeholder="OBSERVACIONES" title="OBSERVACIONES"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" placeholder="REGISTRADO POR" id="registradoPorRegister" style="text-transform: uppercase">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="col-md-6">
                                <input type="button" class="btn btn-default btn-block" value="CANCELAR" onclick="cancelarRegister()">
                            </div>
                            <div class="col-md-6">
                                <input type="button" class="btn btn-success btn-block" value="REGISTRAR"onclick="registrarServidor()">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </form>
    <!--main content end-->

</section>
<!--Global JS-->
<script src="myfiles/js/jquery-3.2.1.min%20(2).js"></script>
<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="alertify/alertify.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/waypoints/waypoints.min.js"></script>
<script src="assets/js/application.js"></script>
<script>


    function cerrar()
    {
        $.ajax({
            url:'php/ingreso.php',
            type:'POST',
            data:"boton=cerrar"
        }).done(function(resp){
            location.href = './';
        });
    }
</script>
<script src="myfiles/DatePicker/js/bootstrap-datepicker.js"></script>
<script src="js/servidoresControllers.js"></script>
<script src="js/export.js"></script>



</body>
</html>
    <?php

}
else
{
    header("location: ./");
    session_start();
    session_destroy();
}
?>