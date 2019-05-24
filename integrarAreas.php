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
                $focusMenu = "M5";
                $focusSubMenu = "SM5.2";
                menuSubmenu($permisos,$focusMenu,$focusSubMenu);
                ?>

            </ul>
        </div>

    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <!--form class="form-horizontal" -->
        <section class="main-content-wrapper">
            <section id="main-content">
                <div class="row">
                    <h1 class="h1">INTEGRACION</h1>
                    <div class="col-md-12">

                        <div class="col-md-4">

                            <div class="col-md-6 form-group">
                                <input id="tagId" type="number" class="form-control" placeholder="LEA EL TAG" autocomplete="off" autofocus  onkeypress="if (event.keyCode == 13) agregar();">
                            </div>

                            <div class="col-md-6 form-group">
                                <select  id="PastOption" class="form-control">
                                    <option value="">Medio</option>
                                    <option value="0">Oveja</option>
                                    <option value="1">Pastoreador</option>
                                </select>
                            </div>
                        <div class="col-md-12 form-group"id="agregadoNombre"></div>

                        </div>


                        <div class="col-md-8">
                            <div class="col-md-12" id="contadorVisible"></div>

<div class="col-md-12 form-group">

    <?php
        if($_SESSION['nombre'] =="Administrador"){
             echo '<div class="col-md-8" id="divSelectAreas">';
                echo'<select  id="selectAreasServicio" class="form-control">';
                    echo'<option value="">AREAS</option>';
                    include 'gold/enlace.php';
                    $query = mysqli_query($enlace,"SELECT * FROM areas GROUP BY Nombre ASC ");
                    while ($datos = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                    echo '<option value="'.$datos["idArea"].'">'.$datos["Nombre"].'</option>';
            }
            echo'</select>';

      echo'  <div class="col-md-12" id="agredadoNombre"></div>';
    echo'</div>';
        echo'<div class="col-md-2" id="medioDiv">';
        echo'<input type="button" class="btn btn-primary" value="ENLAZAR" onclick="integrarIntegrantes()">';
        echo'</div>';
        echo'<div class="col-md-2" >';
        echo'<input type="button" class="btn btn-info" value="INDIVIDUAL" onclick="integrarIndividualModal()">';
        echo'</div>';

        }else{
            echo '<div class="col-md-9" id="divSelectAreas">';
            echo'<select  id="selectAreasServicio" class="form-control">';
            echo'<option value="">AREAS</option>';
            include 'gold/enlace.php';
            $query = mysqli_query($enlace,"SELECT * FROM areas GROUP BY Nombre ASC ");
            while ($datos = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                echo '<option value="'.$datos["idArea"].'">'.$datos["Nombre"].'</option>';
            }
            echo'</select>';

            echo'  <div class="col-md-12" id="agredadoNombre"></div>';
            echo'</div>';
            echo'<div class="col-md-3" id="medioDiv">';
            echo'<input type="button" class="btn btn-primary" value="ENLAZAR" onclick="integrarIntegrantes()">';
            echo'</div>';

        }

            ?>




</div>

                                <div class="col-md-12">
                                    <table class=" table table-bordered" id="tablaAgregados">
                                        <thead>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Identidad</th>
                                        <th>Celular</th>
                                        <th>Expediente</th>
                                        <th>Opcion</th>
                                        </thead>
                                    </table>

                                    <div id="mensajeRespuesta" align="center"></div>

                                </div>

                        </div>

                    </div>



            </section>
        </section>
    <!--/form-->
    <!--main content end-->

</section>


<!--MODALES INICIO-->

<div class="modal fade" id="editTelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="labelModal"></h4>
            </div>
            <div class="modal-body modal-scroll">

                <div class="form-group col-md-6">
                    <input type="hidden" id="inputIdTel">
                    <input type="text" class="form-control" placeholder="TELEFONO 1" id="inputTel1Edit">
                    <input type="hidden" class="form-control"  id="inputidIntegranteEdit">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" placeholder="TELEFONO 2" id="inputTel2Edit">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-info" onclick="guardarEditTel()">GUARDAR</button>

            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalIntegrarIndividual" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header info-bg">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel" style="color: #ffffff">INTEGRACION INDIVIDUAL</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-12 form-group">
                        <select class="form-control" id="selectAreasIntegracionIndividual">
                            <option value="">AREAS</option>
                            <?php
                            include 'gold/enlace.php';
                            $query = mysqli_query($enlace,"SELECT * FROM areas GROUP BY Nombre ASC ");
                            while ($datos = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                            echo '<option value="'.$datos["idArea"].'">'.$datos["Nombre"].'</option>';
                            }
                            ?>
                            </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <input type="text" id="nombreIntegracionIndividual" class="form-control" placeholder="NOMBRE COMPLETO" style="text-transform: uppercase">
                    </div>

                    <div class="col-md-6 form-group">
                        <input type="text" id="identidadIntegracionIndividual" class="form-control" placeholder="IDENTIDAD" style="text-transform: uppercase">
                    </div>


                    <div class="col-md-6 form-group">
                        <input type="text" id="telefono1IntegracionIndividual" class="form-control" placeholder="TELEFONO 1">
                    </div>

                    <div class="col-md-6 form-group">
                        <input type="text" id="telefono2IntegracionIndividual" class="form-control" placeholder="TELEFONO 2">
                    </div>

                    <div class="col-md-12 form-group">
                        <input type="text" id="sirveIntegracionIndividual" class="form-control" placeholder="SIRVE ACTUALMENTE" style="text-transform: uppercase">
                    </div>



                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
                <button type="button" class="btn btn-info" onclick="integrarIndividual();">ENLAZAR</button>
            </div>
        </div>
    </div>
</div>


<!--MODALES FINAL-->


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
<script src="js/integracionEnAreas.js"></script>
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