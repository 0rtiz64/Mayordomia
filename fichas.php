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
                $focusSubMenu = "SM3.6";
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
                    <h1 class="h1">FICHAS DE INSCRIPCION</h1>
                    <div class="col-md-12">
                    <div class="col-md-6">
                        <input autocomplete="off" type="text" class="form-control" id="buscarFicha" placeholder="BUSCAR POR NOMBRE"  style="text-transform: uppercase">
                    </div>

                        <div class="col-md-6">
                            <input autocomplete="off" type="number" class="form-control" id="buscarFichaNumero" placeholder="BUSCAR POR NUMERO DE FICHA"  style="text-transform: uppercase">
                        </div>

                        <div class="col-md-12" id="fichasMostrar" style=" overflow: auto "></div>
                    </div>

            </section>
        </section>
    </form>
    <!--main content end-->

</section>
<!--Global JS-->
<script src="myfiles/js/jquery-3.2.1.min%20(2).js"></script>
<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="alertify/alertify.js"></script>


<script type="text/javascript" src="ZebraBrowserPrintDocsWebCodeExamples/sample/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="ZebraBrowserPrintDocsWebCodeExamples/sample/js/BrowserPrint-1.0.4.min.js"></script>
<script type="text/javascript" src="ZebraBrowserPrintDocsWebCodeExamples/sample/js/carnetBusqueda.js"></script>
<script type="text/javascript" src="ZebraBrowserPrintDocsWebCodeExamples/sample/js/etiquetaIndividual.js"></script>
<script type="text/javascript" src="ZebraBrowserPrintDocsWebCodeExamples/sample/js/integracionIndividual.js"></script>
<script type="text/javascript" src="ZebraBrowserPrintDocsWebCodeExamples/sample/js/tagToga.js"></script>
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
<script src="js/enlazarIntegrantes.js"></script>
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