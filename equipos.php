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
                $focusMenu = "M6";
                $focusSubMenu = "SM6.1";
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
                    <h1 class="h1"> EQUIPOS</h1>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <input type="button" class="btn btn-success" value="VER EQUIPOS" style="margin-top: 10px" onclick="equiposPromocion()">
                            <div  id="equiposActivos" style=" width:500px; height: 300px; overflow: auto">


                            </div>
                        </div>


                        <div class="col-md-6" id="crearEquipos">
                            <div>
                                <h2>CREAR EQUIPOS</h2>
                                <input type="button" class="btn btn-info" value="PASTOREADORES" style="margin-left: 300px; margin-top: -70px" onclick="abrir()">
                            </div>

                            <div id="divFormulrio">
                                <form class="form-horizontal" id="formularioEquipo">
                                    <div id="guardado"></div>

                                    <div class="form-group col-md-12 has-feedback " id="past1Div">
                                        <input type="text"  class="form-control" placeholder="ASIGNE PASTOREADOR 1" id="pastoreador1" readonly>
                                        <span class="fa fa-minus-square form-control-feedback" title="REMOVER" onclick="removerPast1()" style="color: #D9534F" id="menos1"></span>
                                        <input type="hidden" id="idPast1">

                                        <div id="alertPastoreador" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">DEBES ASIGNAR PASTOREADOR</div>

                                    </div>

                                    <div class="form-group col-md-12 has-feedback " id="past2Div">
                                        <input type="text"  class="form-control" id="pastoreador2" placeholder="ASIGNE PASTOREADOR 2" readonly>
                                        <span class="fa fa-minus-square form-control-feedback" title="REMOVER" onclick="removerPast2()" style="color: #D9534F" id="menos2"></span>
                                        <input type="hidden" id="idPast2">

                                    </div>

                                    <div class="form-group col-md-12">
                                        <?php
                                        include_once 'gold/enlace.php';
                                        $promocion2 = mysqli_query($enlace,"SELECT idpromocion,num_promocion,desc_promocion FROM promociones
where `status`=1");
                                        $datosPromocion2 = mysqli_fetch_array($promocion2, MYSQLI_ASSOC);
                                        echo ' <input type="text" class="form-control" value="PROMOCION  '.$datosPromocion2["num_promocion"].'" readonly id="numeroPromocion">';
                                        echo'<input type="hidden" value="'.$datosPromocion2["idpromocion"].'" id="idPromocion">';
                                        ?>

                                    </div>

                                    <div class="form-group col-md-12 " id="numEquipo">
                                        <input type="number" class="form-control" placeholder="NUMERO DE EQUIPO" id="numEquipoInput">
                                        <div id="alertNumeroEquipo" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">NUMERO INVALIDO</div>

                                    </div>

                                   <div class="form-group col-md-12" id="nombreEquipo" >
                                       <input type="text" class="form-control" placeholder="NOMBRE DEL EQUIPO" id="nombreEquipoInput">
                                       <div id="alertNombreEquipo" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">NOMBRE INVALIDO</div>

                                   </div>

                                </form>
                                <input type="button" class="btn btn-primary" value="GUARDAR" onclick="guardarEquipo()" >
                            </div>
                        </div>
                    </div>

                    <!-- Scrolling Modal -->
                    <div class="modal fade" id="scrollingModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">PASTOREADORES</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" id="formularioPromoEdit" role="form">

                                        <div class="form-group">

                                            <div class="col-lg-12" id="divNUMERO">
                                                <select  id="seletPastModal" class="form-control">
                                                    <option value="">LISTADO DE PASTOREADORES (INFORMATIVO)</option>
                                                    <?php
                                                    include_once 'gold/enlace.php';
                                                    $queryPast= mysqli_query($enlace,"SELECT detalle_integrantes.idetalle_integrantes,integrantes.idintegrante, integrantes.nombre_integrante,detalle_integrantes.id_promocion FROM detalle_integrantes
INNER JOIN integrantes ON detalle_integrantes.id_integrante = integrantes.idintegrante
WHERE detalle_integrantes.id_cargo = 9");
                                                    while ($datosPastoreadores= mysqli_fetch_array($queryPast)){
                                                        echo'<option value="'.$datosPastoreadores["idintegrante"].'">'.utf8_encode($datosPastoreadores["nombre_integrante"]).'</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <div id="alertPastModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">SELECCIONA PASTOREADOR</div>
                                            </div>
                                            </div>

                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <input autofocus autocomplete="off" type="text"class="form-control" placeholder="BUSCAR POR NOMBRE" id="buscarPastoreadorInput"style="text-transform: uppercase">
                                            </div>

                                            <div class="col-md-4" id="pastEncontrado">

                                            </div>

                                        </div>
                                    </form>

                                    <div class="form-group" id="Mensaje">

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Scrolling Modal -->


            </section>
        </section>
    </form>
    <!--main content end-->

</section>



<!-- Scrolling Modal -->
<div class="modal fade" id="modalEditarEquipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">EDITAR EQUIPOS</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formularioEquipoEdit" role="form">

                    <div class="form-group">

                        <div class="col-lg-6" id="divNUMERO">
                            <label>NUMERO DE EQUIPO</label>
                            <input type="text" class="form-control" id="numEquipoEdit" placeholder="NUMERO DE EQUIPO" autocomplete="off">

                            <div id="alertNumeroEditCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">NUMERO INVALIDO</div>
                        </div>

                        <div class="col-lg-6" id="divNOMBRE">
                            <label>NOMBRE DEL EQUIPO</label>
                            <input type="text" class="form-control" id="nombreEquipoEdit" style="text-transform: uppercase" placeholder="NOMBRE DEL EQUIPO" autocomplete="off">
                            <div id="alertNombreEditCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">NOMBRE INVALIDO</div>
                        </div>
                    </div>

                        <input type="hidden" id="idEquipo">

                </form>

                <div class="form-group" id="Mensaje">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-info" onclick="cambiosEquipo()" value="Guardar Cambios">

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
<script src="js/equipos.js"></script>
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