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
                        <button type="button" class="btn btn-default" id="toggle-right">
                            <i class="fa fa-comment"></i>
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
                    <h1 class="h1">GRADUADOS</h1>
                    <div class="col-md-12">

                        <form id="formularioGraduados" class="form-horizontal">

                            <h3>Sube archivo CSV</h3>
                        <div class="form-group col-md-6" id="divArchivo">
                            <input type="file" class="form-control" id="csvFile" name="csv">
                            <div id="alertArchivo" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">DEBES SELECCIONAR ARCHIVO</div>

                        </div>
                        <div class="col-md-6">
                            <input type="button" class="btn btn-success" value="SUBIR ARCHIVO" onclick="alertifyFunction();">
                        </div>

                        <div id="resultados" class="col-md-12"></div>
                        </form>
                    </div>

            </section>
        </section>
    </form>
    <!--main content end-->



    <!--SIDEBAR RIGTH-->
    <aside class="sidebarRight">
        <div id="rightside-navigation">
            <div class="sidebar-heading"><i class="fa fa-user"></i> Datos Equipos</div>
            <div class="sidebar-title">online</div>
            <div class="list-contacts">

                <?php
                include 'gold/enlace.php';
                $fechaentrada = date('Y-m-d ');
                $queryNumPromo= mysqli_query($enlace,"select * from promociones where `status` =1");
                $datosNumPromo = mysqli_fetch_array($queryNumPromo,MYSQLI_ASSOC);
                $num_promo= $datosNumPromo["idpromocion"];
                $foto = ' <div class="list-item-image">
                        <img src="assets/img/user.png" class="img-circle">
                    </div>';
                $queryCantidadTotales = mysqli_query($enlace,"SELECT DISTINCT E.id_equipo,E.num_equipo,E.nombre_equipo AS Equipo, COUNT(a.id_equipo) AS cantidad_I FROM detalle_integrantes a 
INNER JOIN equipos E ON a.id_equipo = E.id_equipo
INNER JOIN promociones ON E.id_promocion = promociones.idpromocion
WHERE a.id_promocion = ".$num_promo."  AND a.id_cargo=10 AND a.`status`=1 AND promociones.`status`=1 
GROUP BY E.id_equipo,E.num_equipo,E.nombre_equipo");
                while ( $equipos = mysqli_fetch_array($queryCantidadTotales,MYSQLI_ASSOC)){
                    $queryConteoPorEquipo = mysqli_query($enlace,"SELECT  IFNULL(COUNT(*),0) Asistentes  from integrantes
INNER JOIN marcacionprovicional ON integrantes.idintegrante = marcacionprovicional.idIntegrante
INNER JOIN detalle_integrantes ON integrantes.idintegrante = detalle_integrantes.id_integrante
INNER JOIN equipos ON detalle_integrantes.id_equipo = equipos.id_equipo
WHERE
detalle_integrantes.id_equipo = ".$equipos['id_equipo']." AND
detalle_integrantes.`status` = 1 AND
detalle_integrantes.id_promocion = ".$num_promo." AND
CAST(marcacionprovicional.fechaMarcacion AS DATE) = '".$fechaentrada."' AND
detalle_integrantes.id_cargo = 10");
                    $datosConteoAsistieron = mysqli_fetch_array($queryConteoPorEquipo,MYSQLI_ASSOC);




                $asistieron = $datosConteoAsistieron["Asistentes"];
                $Totales = $equipos["cantidad_I"];
                    $porcetaje = round(($asistieron* 100) / $Totales,2);


                    echo '<a href="javascript:void(0)" class="list-item">';
                    echo $foto;
                    echo '<div class="list-item-content">';
                    echo '<h4>'.$equipos["num_equipo"].'-'.$equipos["Equipo"].'</h4>';
                        echo'<div class="progress progress-striped active">';
                                    echo '<div class="progress-bar progress-bar-success" style="width: '.$porcetaje.'%">'.$porcetaje.'%</div>';
                                echo'</div>';
                    echo'</div>';

                    echo'</a>';
///BORRAR RESTO DE CODIGO CON FOTO POR INTEGRANTE
                }

                ?>

            </div>

        </div>
    </aside>

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
<script src="myfiles/js/main.js"></script>
<script src="js/export.js"></script>
<script src="js/graduados.js"></script>



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