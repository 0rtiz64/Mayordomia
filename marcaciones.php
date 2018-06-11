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

                <li>
                    <div class="toggle-navigation toggle-right">

                        <button type="button" class="btn btn-default" id="toggle-right" onclick="porcentajesEquipos()">
                            <i style="color:gray;" id="iconoPorcentajes" class="fa fa-bar-chart-o"></i>
                        </button>
                    </div>
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
                $focusMenu = "M1";
                $focusSubMenu = "SM1.4";
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
                    <h2 class="h2">MARCACIONES</h2>
                         <div id="mostrarCantidad" class="col-md-10" style="margin-top: -45px;margin-left: 250px">
                             <div class="col-md-4" id="ovejasDiv">
                             </div>

                             <div class="col-md-4" id="pastDiv">
                             </div>

                             <div class="col-md-4" id="lidDiv">
                             </div>
                         </div>
                    <form class="form-horizontal" >
                    <div class="col-md-12 form-horizontal"> <!--DIV PRINCIPAL-->

                        <div class="col-md-12 form-group" id="divInputProvicional">
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="marcacionProvicionalInput" placeholder="MARCACION ID INTERNO">
                            </div>
                            <input type="submit" class="btn btn-success collapse" onclick="marcacionProvicional(); ">

                        </div>





                            <div class="col-md-9 form-group" id="marcacionManualDiv">
                                <input type="text" class="form-control" id="marcacionManualInput" placeholder="MARCACION BUSQUEDA">
                            </div>

                            <div class="col-md-3">
                                <input type="button" class="btn btn-primary" value="BUSCAR" id="buscarBoton">
                                <input type="button" class="btn btn-success" value="MARCAR" onclick="marcarManual()">
                            </div>

                        <div class="col-md-10 form-group collapse" id="marcacionAutoDiv">
                            <input type="text" class="form-control" placeholder="MARCACION POR IDENDITAD" id="marcacionAutoInput">
                        </div>
                        <div class="col-md-2 collapse">
                            <input type="button" class="btn btn-success"value="MARCAR" onclick="marcacionAuto()">
                        </div>






                        <div class="col-md-12" id="tablaDatos"></div>


                        <!-- Scrolling Modal -->
                        <div class="modal fade" id="scrollingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Busqueda Manual</h4>
                                    </div>
                                    <div class="modal-body modal-scroll">
                                        <div class="form-group">
                                            <label for="InputNameLabel">Nombre</label>
                                            <input type="text" style="text-transform: uppercase;" class="form-control" id="ModalInputName" placeholder="BUSCAR POR NOMBRE" autofocus>
                                        </div>

                                        <div id="agrega-personas"></div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Scrolling Modal -->


                    </div><!--FIN DIV PRINCIPAL-->
                    </form>
            </section>

            <aside class="sidebarRight">
                <div id="rightside-navigation">
                    <div class="sidebar-heading"><i class="fa fa-user"></i> Datos Equipos <img style="width: 50px; width: 50px" src="assets/img/source.gif" alt=""></div>
                    <div class="sidebar-title">Equipos</div>
                    <div class="list-contacts" id="listaPorcentajesEquipos">



                    </div>

                </div>
            </aside>
        </section>
    </form>
    <!--main content end-->

</section>
<!--Global JS-->
<script src="myfiles/js/jquery-3.2.1.min%20(2).js"></script>
<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="alertify/alertify.js"></script>
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
<script src="js/marcaciones.js"></script>
<script src="js/porcentajesEquipos.js"></script>
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