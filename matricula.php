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


    <!--DatePicker-->
    <link rel="stylesheet" href="myfiles/DatePicker/css/bootstrap-datepicker.css">


    <!---DATA TABLES-->
    <link rel="stylesheet" href="	https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="	https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">
    <!---/DATA TABLES-->


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
                $focusMenu = "M3";
                $focusSubMenu = "SM3.2";
                menuSubmenu($permisos,$focusMenu,$focusSubMenu);
                ?>

            </ul>
        </div>

    </aside>
    <!--sidebar end-->
    <!--main content start-->

        <section class="main-content-wrapper">
            <section id="main-content">
                <div class="row">
                    <h1 class="h1">MATRICULA DE INTEGRANTES</h1>
                    <div class="col-md-12">
                        <div class="collapse" id="guardado" align="center"><strong>Registro Guardado</strong></div>
                        <br>
                        <br>
                        <br>
                        <form class="form-horizontal" id="formularioRegistro" role="form">

                            <div class="form-group">

                                <div class="col-lg-4" id="divIdentidad">
                                    <input type="text" id="identidadRegistrar" class="form-control " min="0" placeholder="Identidad" style="text-transform: uppercase">
                                    <div id="alertIdentidad" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Identidad Invalida</div>
                                </div>


                                <div class="col-lg-4" id="divNombre">
                                    <input type="text" id="NombreRegistro" class="form-control" placeholder="Nombre Completo" style='text-transform:uppercase'>
                                    <input type="text" id="ApellidoCasada" class="form-control collapse" placeholder="Apellido de Casada" style="text-transform: uppercase">
                                    <div id="alertNombre" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Nombre Invalido</div>
                                </div>

                                <div class="col-lg-4" id="divFecha">
                                    <div class="input-group">
                                        <input type="date" id="fecha_cumpleRegistro" name="datarange" class="datepicker form-control" placeholder="Ejemplo:2017-09-25">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <div id="alertFecha" style="background-color: #d9534f; color: white; border-radius: 4px" align="center" class="collapse">Fecha Invalida</div>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-lg-4" id="divCivil">
                                    <select class="form-control" id="estadoCivilRegistrar">
                                        <option value="">Estado Civil</option>
                                        <option value="Casado">Casado</option>
                                        <option value="Soltero">Soltero</option>
                                        <option value="Divorciado">Divorciado</option>
                                        <option value="Union">Union Libre</option>
                                        <option value="Viudo">Viudo</option>
                                    </select>
                                    <div id="alertEstado" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Estado Civil Invalido</div>

                                </div>

                                <div class="col-lg-4" id="divGenero">
                                    <select id="generoRegistrar" class="form-control">
                                        <option value="">Genero</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                    <div id="alertGenero" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Genero Invalido</div>
                                </div>

                                <div class="col-lg-4" id="divTransporte">
                                    <select class="form-control" id="tranporteRegistrar">
                                        <option value="">Necesita Transporte</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                    <div id="alertTransporte" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Respuesta Invalida</div>
                                </div>
                            </div>

                            <div class="form-group">


                                <div  id="divIdIntegrante"></div>

                                <div class="col-lg-3" id="divCorderito">
                                    <input type="number" style="text-transform: uppercase;" class="form-control" id="corderitosPromocionRegistrar" min="0" placeholder="Promocion de Corderitos">
                                    <div id="alertPromocion" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Promocion Invalida</div>
                                </div>

                                <div class="col-lg-3" id="divBautizado">
                                    <select  id="selectBautizado" class="form-control">
                                        <option value="">BAUTIZADO</option>
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    </select>
                                    <div id="alertBautizado" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Respuesta Invalida</div>
                                </div>


                             <div class="col-lg-3 col-md-4" id="divDocumentosSelect">
                                 <select  id="selectDocumentos" class="form-control">
                                     <option value="">DOCUMENTOS PENDIENTES</option>
                                     <option value="1">Si</option>
                                     <option value="2">No</option>
                                 </select>
                                 <div id="alertDocumentos" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Repuesta Invalida</div>
                             </div>

                                <div class="col-lg-3" id="divNinosPregunta">
                                    <select  id="selectNinos" class="form-control">
                                        <option value="">¿Traera Niños?</option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                    </select>
                                    <div id="alertNinos" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Repuesta Invalida</div>
                                </div>

                            </div>

                            <div class="form-group collapse " id="DivdocumentosInput">
                             <div class="col-lg-12 col-md-12">
                                 <input type="text" class="form-control" id="inputDocumentos" placeholder="DOCUMENTOS PENDIENTES" style="text-transform: uppercase">
                             </div>
                            </div>

                            <div class="form-group collapse " id="rangoNinosDiv">
                                <div class="col-lg-2 col-md-2">
                                    <input type="number" id="inputRango1"  min="0"  pattern="^[0-9]+" class="form-control" placeholder="0-2 AÑOS">
                                </div>

                                <div class="col-lg-2 col-md-2">
                                    <input type="number" class="form-control" min="0" id="inputRango2" placeholder="2-3 AÑOS">
                                </div>

                                <div class="col-lg-2 col-md-2">
                                    <input type="number" class="form-control" min="0" id="inputRango3" placeholder="4-5 AÑOS">
                                </div>

                                <div class="col-lg-2 col-md-2">
                                    <input type="number" class="form-control" min="0" id="inputRango4" placeholder="6-7 AÑOS">
                                </div>

                                <div class="col-lg-2 col-md-2">
                                    <input type="number" class="form-control" min="0" id="inputRango5" placeholder="8-11 AÑOS">
                                </div>

                                <div class="col-lg-2 col-md-2">
                                    <input type="number" class="form-control" min="0" id="inputRango6" placeholder="OTROS">
                                </div>

                            </div>

                            <div class="form-group" >
                                <div class="col-lg-4" id="divTelefono1">
                                    <input type="text" class="form-control" id="telefono1Registrar" min="0" placeholder="Telefono 1" style="text-transform: uppercase">
                                    <div id="alertTelefono1" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse  ">Telefono Invalido</div>
                                </div>

                                <div class="col-lg-4" id="divTelefono2">
                                    <input type="text" class="form-control" id="telefono2Registrar" min="0" placeholder="Telefono 2">
                                </div>

                                <div class="col-lg-4" id="divIntegrado">
                                    <select class="form-control" id="integradoRegistrar">
                                        <option value="">Esta integrado</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                    <div id="alertIntegrado" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse  ">Respuesta Invalida</div>
                                </div>
                            </div>


                            <div class="form-group collapse" id="areasRegistro">
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" placeholder="Areas de Servicio" id="areasRegistroText" style="text-transform: uppercase">


                                </div>
                            </div>




                            <div class="form-group">
                                <div class="col-md-12" id="divDireccion">
                                    <textarea class="form-control" rows="3" id="direccionRegistrar" placeholder="Informacion Adicional" style="text-transform: uppercase"></textarea>
                                    <div id="alertDireccion" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse  ">Informacion Adicional Invalida</div>
                                </div>
                            </div>
                        </form>

                        <div id="divTEST"></div>

                        <div class="form-inline">
                            <div id="divResgistradoPor">
                                <input type="text" class="form-control" placeholder="REGISTRADO POR" id="registradoPor" style="text-transform: uppercase">
                            </div>
                        <input id="btnRegistrar" type="button" class="btn btn-success" value="REGISTRAR" STYLE="float: right" onclick="guardarPersona()">
                            <input type="button" id="btnpdf" class="btn btn-danger collapse" value="PDF" style=" float: right; margin-right:20px" onclick="consultarId()">
                            <input id="btnCarnet" type="button" class="btn btn-info collapse" value="CARNET" style="float: right;margin-right:20px" onclick="consultarIdParaCarnet()">
                          <input id="btnLimpiar" type="button" class="btn btn-primary collapse" style="float: right ;margin-right:20px" value="NUEVO" onclick="limpiarCarnt()">
                        </div>
                        </div>

            </section>
        </section>

    <!-- Inicia Modal Registrar -->
    <div class="modal fade" id="ModalRegistrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header danger-bg">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <!--h4 class="modal-title" id="myModalLabel" style="color: white">IDENTIDAD YA REGISTRADA EN </h4-->
                    <h4 id="nombrePromocion"></h4>



                </div>
                <div class="modal-body">

                    <div class="col-md-12">
                        <form class="form-horizontal" id="formularioRegistro" role="form">

                            <div class="form-group">
                                <?php
                                require_once 'gold/enlace.php';
                                $queryPromocionActiva= mysqli_query($enlace, "select num_promocion from promociones WHERE `status`=1");
                                while ($fila = mysqli_fetch_array($queryPromocionActiva,MYSQLI_ASSOC)) {
                                    echo'<div >';
                                    echo '<input type="hidden" id="promoAc" class="form-control" readonly="readonly" value="Promocion '.$fila['num_promocion'].'">';
                                    echo'</div>';
                                }
                                ?>
                                <div class="col-lg-4" id="divIdentidadModal">
                                    <input type="text" id="identidadRegistrarModal" class="form-control " min="0" placeholder="Identidad">
                                    <div id="alertIdentidadModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Identidad Invalida</div>
                                </div>


                                <div class="col-lg-4" id="divNombreModal">
                                    <input type="text" id="NombreRegistroModal" class="form-control" placeholder="Nombre Completo" style='text-transform:uppercase'>
                                    <input type="text" id="ApellidoCasadaModal" class="form-control collapse" placeholder="Apellido de Casada" style="text-transform: uppercase">
                                    <div id="alertNombreModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Nombre Invalido</div>
                                </div>

                                <div class="col-lg-4" id="divFechaModal">
                                    <div class="input-group">
                                        <input type="date" id="fecha_cumpleRegistroModal" name="datarange" class="datepicker form-control" placeholder="Ejemplo:2017-09-25">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <div id="alertFechaModal" style="background-color: #d9534f; color: white; border-radius: 4px" align="center" class="collapse">Fecha Invalida</div>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-lg-4" id="divCivilModal">
                                    <select class="form-control" id="estadoCivilRegistrarModal">
                                        <option value="">Estado Civil</option>
                                        <option value="Casado">Casado</option>
                                        <option value="Soltero">Soltero</option>
                                        <option value="Divorciado">Divorciado</option>
                                        <option value="Union">Union Libre</option>
                                        <option value="Viudo">Viudo</option>
                                    </select>
                                    <div id="alertEstadoModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Estado Civil Invalido</div>

                                </div>

                                <div class="col-lg-4" id="divGeneroModal">
                                    <select id="generoRegistrarModal" class="form-control">
                                        <option value="">Genero</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                    <div id="alertGeneroModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Genero Invalido</div>
                                </div>

                                <div class="col-lg-4" id="divTransporteModal">
                                    <select class="form-control" id="tranporteRegistrarModal">
                                        <option value="">Necesita Transporte</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                    <div id="alertTransporteModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Respuesta Invalida</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div  id="divIdIntegrante">
                                    <input type="hidden" id="idIntegrante">
                                </div>

                                <div class="col-lg-3" id="divCorderitoModal">
                                    <input type="number" style="text-transform: uppercase;" class="form-control" id="corderitosPromocionRegistrarModal" min="0" placeholder="Promocion de Corderitos">
                                    <div id="alertPromocionModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Promocion Invalida</div>
                                </div>

                                <div class="col-lg-3" id="divBautizadoModal">
                                    <select  id="selectBautizadoModal" class="form-control">
                                        <option value="">BAUTIZADO</option>
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    </select>
                                    <div id="alertSelectBautizadoModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Respuesta Invalida</div>
                                </div>


                                <div id="divdocumentosPreguntaModal" class="col-lg-3 col-md-3">
                                    <select class="form-control" id="preguntaDocumentosModal">
                                        <option value="">DOCUMENTOS PENDIENTES</option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                    </select>
                                    <div id="alertPreguntaDocumentosModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Respuesta Invalida</div>
                                </div>

                                <div id="divPreguntaNinosModal" class="col-lg-3 col-md-3">
                                    <select class="form-control" id="preguntaNinosModal">
                                        <option value="">¿Traera Niños?</option>
                                        <option value="1">Si</option>
                                        <option value="2">No</option>
                                    </select>
                                    <div id="alertNinosModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Repuesta Invalida</div>
                                </div>



                            </div>

                            <div class="form-group collapse " id="DivdocumentosInputModal">
                                <div class="col-lg-12 col-md-12">
                                    <input type="text" class="form-control" id="inputDocumentosModal" placeholder="DOCUMENTOS PENDIENTES" style="text-transform: uppercase">
                                </div>
                            </div>

                            <div class="form-group collapse " id="rangoNinosDivModal">
                                <div class="col-lg-2 col-md-2">
                                    <input type="number" id="inputRango1Modal"  min="0" class="form-control" placeholder="0-2 AÑOS">
                                </div>

                                <div class="col-lg-2 col-md-2">
                                    <input type="number" class="form-control" min="0" id="inputRango2Modal" placeholder="2-3 AÑOS">
                                </div>

                                <div class="col-lg-2 col-md-2">
                                    <input type="number" class="form-control" min="0" id="inputRango3Modal" placeholder="4-5 AÑOS">
                                </div>

                                <div class="col-lg-2 col-md-2">
                                    <input type="number" class="form-control" min="0" id="inputRango4Modal" placeholder="6-7 AÑOS">
                                </div>

                                <div class="col-lg-2 col-md-2">
                                    <input type="number" class="form-control" min="0" id="inputRango5Modal" placeholder="8-11 AÑOS">
                                </div>

                                <div class="col-lg-2 col-md-2">
                                    <input type="number" class="form-control" min="0" id="inputRango6Modal" placeholder="OTROS">
                                </div>

                            </div>

                            <div class="form-group" >
                                <div class="col-lg-4" id="divTelefono1Modal">
                                    <input type="text" class="form-control" id="telefono1RegistrarModal" min="0" placeholder="Telefono 1">
                                    <div id="alertTelefono1Modal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse  ">Telefono Invalido</div>
                                </div>

                                <div class="col-lg-4" id="divTelefono2Modal">
                                    <input type="number" class="form-control" id="telefono2RegistrarModal" min="0" placeholder="Telefono 2">
                                </div>

                                <div class="col-lg-4" id="divIntegradoModal">
                                    <select class="form-control" id="integradoRegistrarModal">
                                        <option value="">Esta integrado</option>
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                    <div id="alertIntegradoModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse  ">Respuesta Invalida</div>
                                </div>
                            </div>

                            <div class="form-group collapse" id="areasRegistroModal">
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" placeholder="Areas de Servicio" id="areasRegistroTextModal" style="text-transform: uppercase">


                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12" id="divDireccionModal">
                                    <textarea class="form-control" rows="3" id="direccionRegistrarModal" placeholder="Informacion Adicional" style="text-transform: uppercase"></textarea>
                                    <div id="alertDireccionModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse  ">Informacion Adicional Invalida</div>
                                </div>
                            </div>



                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="text" class="form-control" placeholder="REGISTRADO POR" id="registradoPorModal">
                    <div class="alert alert-success alert-dismissable  collapse" id="guardado" align="center"><strong>Registro Guardado</strong></div>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarModalRegistrar">CERRAR</button>
                    <input type="button" class="btn btn-danger collapse" value="PDF" onclick="pdfModal()" id="pdfModal">
                    <input type="button" class="btn btn-primary collapse" value="CARNET" onclick="consultarIdParaCarnetModal();" id="carnetModal">
                    <input type="button" class="btn btn-success" value="ACTUALIZAR DATOS" onclick="actualizarDatos();" id="actualizarDatosBtn">

                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Registrar -->



    <!--main content end-->

</section>
<!--Global JS-->
<script src="myfiles/js/jquery-3.2.1.min%20(2).js"></script>
<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="alertify/alertify.min.js"></script>
<script type="text/javascript" src="ZebraBrowserPrintDocsWebCodeExamples/sample/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="ZebraBrowserPrintDocsWebCodeExamples/sample/js/BrowserPrint-1.0.4.min.js"></script>
<script type="text/javascript" src="ZebraBrowserPrintDocsWebCodeExamples/sample/js/DevDemo.js"></script>
<script type="text/javascript">
    var OSName="Unknown OS";
    if (navigator.appVersion.indexOf("Win")!=-1) OSName="Windows";
    //{
    //OSName="Windows";
    //document.write('<a href="ZebraWebPrint.exe" class="navbar-brand" href="#">Download the '+OSName+' App</a>');
    //}
    if (navigator.appVersion.indexOf("Mac")!=-1) OSName="MacOS";
    if (navigator.appVersion.indexOf("X11")!=-1) OSName="UNIX";
    if (navigator.appVersion.indexOf("Linux")!=-1) OSName="Linux";

</script>


<script type="text/javascript">
    $(document).ready(setup_web_print);
</script>

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
<script src="js/matricula.js"></script>
<script src="js/export.js"></script>
<script src="ZebraBrowserPrintDocsWebCodeExamples/sample/js/BrowserPrint-1.0.4.min.js"></script>
<script src="ZebraBrowserPrintDocsWebCodeExamples/sample/js/DevDemo.js"></script>



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