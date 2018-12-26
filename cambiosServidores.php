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
                $focusSubMenu = "SM3.5";
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
                    <h1 class="h1">CAMBIOS SERVIDORES</h1>
                    <div class="col-md-12">
                        <div class="col-md-12 form-group">
                            <input  id="inputBuscarServidores" type="text" class="form-control" placeholder="BUSQUEDA POR NOMBRE" style="text-transform: uppercase" autofocus>
                        </div>

                        <div class="col-md-12" id="tablaResultados">

                        </div>

                    </div>



                    <!-- Inicia Modal Cambios -->
                    <div class="modal fade" id="ModalEditarServidores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content ">
                                <div class="modal-header primary-bg">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <!--h4 class="modal-title" id="myModalLabel" style="color: white">IDENTIDAD YA REGISTRADA EN </h4-->
                                    <h4 style="color: #FFFFFF">EDITAR INTEGRANTE</h4>



                                </div>
                                <div class="modal-body">

                                    <div class="col-md-12">
                                        <form class="form-horizontal" id="formularioRegistro" role="form">



                                            <div class="form-group">
                                                <input type="hidden" id="idServidorEditar" value="">
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




                                            <div class="form-group" >
                                                <div class="col-lg-4" id="divTelefono1Modal">
                                                    <input type="text" class="form-control" id="telefono1RegistrarModal" min="0" placeholder="Telefono 1">
                                                    <div id="alertTelefono1Modal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse  ">Telefono Invalido</div>
                                                </div>

                                                <div class="col-lg-4" id="divTelefono2Modal">
                                                    <input type="text" class="form-control" id="telefono2RegistrarModal" min="0" placeholder="Telefono 2">
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
    <div class="col-md-3" id="divEquipoModal">
        <select  id="equipoModal" class="form-control">
            <option value="">SELECIONA EQUIPO</option>
            <?php
            include 'gold/enlace.php';
            $queryEquiposModal=mysqli_query($enlace,"SELECT * from servicioequipos");
            while($resultadoEquiposModal=mysqli_fetch_array($queryEquiposModal,MYSQLI_ASSOC)){
            echo '<option value="'.$resultadoEquiposModal["idEquipo"].'">'.$resultadoEquiposModal["nombreEquipo"].'</option>';
            }
            ?>
        </select>
    </div>



    <div class="col-md-3" id="divCargoModal">
        <select  id="cargoModal" class="form-control">
            <option value="">SELECIONA CARGO</option>
            <?php
            include 'gold/enlace.php';
            $queryEquiposModal=mysqli_query($enlace,"SELECT * from serviciocargos");
            while($resultadoEquiposModal=mysqli_fetch_array($queryEquiposModal,MYSQLI_ASSOC)){
                echo '<option value="'.$resultadoEquiposModal["idCargo"].'">'.$resultadoEquiposModal["nombreCargo"].'</option>';
            }
            ?>
        </select>
        <div id="alertCargoModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Respuesta Invalida</div>

    </div>


    <div class="col-md-3" id="divEstado">
        <select  id="selectEstadoModal" class="form-control">
            <option value="">SELECCIONE ESTADO</option>
            <option value="1">ACTIVO</option>
            <option value="2">RETIRADO</option>
            <option value="3">INACTIVO</option>
        </select>
        <div id="alertEstadoACModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse  ">Respuesta Invalida</div>

    </div>

    <div class="col-md-3" id="divCorderitoModal">
        <input type="number" style="text-transform: uppercase;" class="form-control" id="corderitosPromocionRegistrarModal" min="0" placeholder="Promocion de Corderitos">
        <div id="alertPromocionModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Promocion Invalida</div>
    </div>

</div>

                                            <div class="form-group">
                                                <div class="col-md-12" id="divDireccionModal">
                                                    <textarea class="form-control" rows="3" id="direccionRegistrarModal" placeholder="Direccion" style="text-transform: uppercase"></textarea>
                                                    <div id="alertDireccionModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse  ">Direccion Invalida</div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <div class="alert alert-success alert-dismissable  collapse" id="guardado" align="center"><strong>Registro Guardado</strong></div>
                                    <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarModalRegistrar">Cerrar</button>

                                    <input type="button" class="btn btn-danger" value="PDF" onclick="consultarIdParaPDF()">
                                    <input type="button" class="btn btn-primary" value="ACTUALIZAR DATOS" onclick="actualizarDatosServidores();">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Cambios -->

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
<script src="js/cambiosServidores.js"></script>
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