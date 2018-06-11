<?php
session_start();
if (isset($_SESSION['ingreso']) && $_SESSION['ingreso']=='YES')
{?>
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
                $focusMenu = "M4";
                $focusSubMenu = "SM4.1";
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
                    <h1 class="h1">LISTAR PROMOCIONES</h1>
                    <div class="col-md-12">
                        <!--BUSCAR PRPOMOCIONES-->
                       <div class="col-md-6">
                           <input type="text" class="form-control" placeholder="BUSCAR POR NUMERO DE PROMOCION" id="buscarPromociones">

                           <div id="agrega-registros"></div>
                       </div>
                        <!--FIN BUSCAR PRPOMOCIONES-->


                        <!--NUEVA PROMOCION-->
                        <div class="col-md-6">
                                <button type="button" class="btn btn-success" id="nuevaPromocion"><i class="fa fa-bookmark"></i> NUEVA PROMOCION</button>
                                <div id="guardado"></div>
                            <div id="formularioPromocion" class="collapse">
                                <form class="form-horizontal" id="formulario">
                                    <div class="input-group col-md-12" id="numeroPromocionDiv">
                                        <input type="number" id="numeroPromocion" class="form-control" placeholder="NUMERO DE PROMOCION">                                                    <div id="alertGeneroCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Genero Invalido</div>
                                        <div id="alertNumeroPromocion" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">PROMOCION INVALIDA</div>
                                    </div>
                                    <div class="input-group col-md-12" id="nombrePromocionDiv">
                                        <input type="text" id="nombrePromocion" class="form-control" placeholder="NOMBRE PROMOMCION">
                                        <div id="alertNombrePromocion" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">NOMBRE INVALIDO</div>
                                    </div>

                                    <div class="input-group col-md-12" id="estadoPromocionDiv">
                                        <select id="estadoPromocion" class="form-control">
                                            <option value="">SELECCIONE ESTADO</option>
                                            <option value="1">ACTIVA</option>
                                            <option value="2">FINALIZADA</option>
                                        </select>
                                        <div id="alertEstadoPromocion" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">ESTADO INVALIDO</div>
                                    </div>
                                    <input type="button" class="btn btn-default" id="limpiarNuevaPromocion"  value="LIMPIAR">
                                    <input type="button" class="btn btn-primary" id="gurdarNuevaPromocion" onclick="guardarPromocion()" value="GUARDAR">
                                </form>

                            </div>
                        </div>
                        <!--FIN NUEVA PROMOCION-->
                    </div>

            </section>
        </section>
    </form>
    <!--main content end-->

</section>

<!-- Scrolling Modal -->
<div class="modal fade" id="scrollingModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">EDITAR PROMOCION</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formularioPromoEdit" role="form">

                    <div class="form-group">

                        <div class="col-lg-6" id="divNUMERO">
                            <input type="text" class="form-control" id="numPromoEdit">
                            <div id="alertNumeroEditCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">NUMERO PROMOCION INVALIDO</div>
                        </div>

                        <div class="col-lg-6" id="divNOMBRE">
                            <input type="text" class="form-control" id="nombrePromoEdit" style="text-transform: uppercase">
                            <div id="alertNombreEditCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">NOMBRE INVALIDO</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6" id="divESTADO">
                            <select class="form-control" id="estadoPromEdit">
                                <option value="">Seleccione Estado</option>
                                <option value="1">ACTIVA</option>
                                <option value="2">FINALIZADA</option>
                            </select>
                            <div id="alertEstadoEditCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">ESTADO INVALIDA</div>
                        </div>




                        <div class="col-lg-6" id="divFECHA">
                            <div class="input-group">
                                <input type="text" id="fechaPromEdit" name="daterange" class="datepicker form-control" placeholder="Ejemplo : 2017-09-25">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <div id="alertFechaEditCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">FECHA INVALIDA</div>

                        </div>
                        <input type="hidden" id="idPromEdit">
                    </div>




                </form>


                <div class="form-group" id="Mensaje">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-info" onclick="cambiosPromocion()" value="Guardar Cambios">

            </div>
        </div>
    </div>
</div>
<!-- End Scrolling Modal -->

<!--Global JS-->
<script src="myfiles/js/jquery-3.2.1.min%20(2).js"></script>
<script src="assets/js/jquery-1.10.2.min.js"></script>
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
<script src="js/promocionesBusqueda.js"></script>
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