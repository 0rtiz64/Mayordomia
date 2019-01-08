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

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>


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
                $focusSubMenu = "SM5.1";
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
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="page-header">
                                    INTEGRAR OVEJAS
                                </h1>

                            </div>
                        </div> <!-- ROW -->



                        <div class="col-sm-12">
                            <form class="form-horizontal" id="formularioIntegrar">

                                <div class="form-group" id="identidadDiv">

                                    <label for="pwd">Numero de Identidad:</label>
                                    <input type="number" class="form-control" id="num_identidadIntegrar" placeholder="Ejemplo: 1708199200377" >
                                    <div id="identidadAlert" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">IDENTIDAD INVALIDA</div>



                                </div>
                                <input type="submit" class="btn btn-info" value="BUSCAR" onclick="buscarCedula()">


                            </form>
                        </div>


                        
                        <div class="col-sm-12">
                            <div id="RegistroExitoso"></div>
                        </div>

                    </div>

                    <!-- INTEGRAR MODAL-->
                    <div class="modal fade" id="scrollingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">INTEGRAR OVEJA</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" id="formulario" role="form">

                                        <div class="form-group">

                                            <div class="col-md-6" id="modalIdentidad">
                                                <input type="text" class="form-control" placeholder="IDENTIDAD" id="identidadInput">
                                                <div id="alertIdentidadModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">IDENTIDAD INVALIDA</div>

                                                <input type="hidden" class="form-control" placeholder="ID" id="idInput">
                                            </div>

                                           <div class="col-md-6" id="modalNombre">
                                               <input type="text" class="form-control" placeholder="NOMRBE COMPLETO" id="nombreInput">
                                               <div id="alertNombreModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">NOMBRE INVALIDO</div>

                                           </div>


                                        </div>

                                        <div class="form-group">

                                            <div class="col-md-6" id="modalCel">
                                                <input type="number" class="form-control" placeholder="NUMERO DE CELULAR CLARO" id="celInput">
                                                <div id="alertCelModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">CELULAR INVALIDA</div>

                                            </div>

                                            <div class="col-md-6" id="modalTel">
                                                <input type="number" class="form-control" placeholder="NUMERO DE CELULAR  TIGO" id="telInput">
                                            </div>


                                        </div>


                                        <div class="form-group" >
                                            <div class="col-md-6" id="modalFijo">
                                                <input type="number" class="form-control" placeholder="NUMERO DE TELEFONO FIJO" id="fijoInput">
                                            </div>


                                            <div class="col-md-6" id="modalArea1">
                                                <select  id="inputArea1" class="form-control">
                                                    <option value="">SELECCIONE UNA</option>
                                                    <?php
                                                    include 'gold/enlace.php';
                                                    $query = mysqli_query($enlace,"SELECT idArea,Nombre FROM areas");
                                                    while ($areas= mysqli_fetch_array($query,MYSQLI_ASSOC)) {

                                                        echo ' <option value="'.$areas["Nombre"].'">'.$areas["Nombre"].' </option>';
                                                    }
                                                    ?>
                                                </select>
                                                <div id="alertAreaModal" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">DEBES SELECCIONAR UNA</div>

                                            </div>



                                        </div>

                                        <div class="form-group">

                                            <div class="col-md-6" id="modalArea2">
                                                <select  id="inputArea2"   class="form-control " >
                                                    <option value="">SELECCIONE UNA</option>
                                                    <?php
                                                    include 'gold/enlace.php';
                                                    $query = mysqli_query($enlace,"SELECT idArea,Nombre FROM areas");
                                                    while ($areas= mysqli_fetch_array($query,MYSQLI_ASSOC)) {

                                                        echo ' <option value="'.$areas["Nombre"].'">'.$areas["Nombre"].' </option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6" id="modalArea3">
                                                <select  id="inputArea3" class="form-control">
                                                    <option value="">SELECCIONE UNA</option>
                                                    <?php
                                                    include 'gold/enlace.php';
                                                    $query = mysqli_query($enlace,"SELECT idArea,Nombre FROM areas");
                                                    while ($areas= mysqli_fetch_array($query,MYSQLI_ASSOC)) {

                                                        echo ' <option value="'.$areas["Nombre"].'">'.$areas["Nombre"].' </option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>


                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6" id="modalArea4">
                                                <select  id="inputArea4" class="form-control">
                                                    <option value="">SELECCIONE UNA</option>
                                                    <?php
                                                    include 'gold/enlace.php';
                                                    $query = mysqli_query($enlace,"SELECT idArea,Nombre FROM areas");
                                                    while ($areas= mysqli_fetch_array($query,MYSQLI_ASSOC)) {

                                                        echo ' <option value="'.$areas["Nombre"].'">'.$areas["Nombre"].' </option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>


                                            <div class="col-md-6" id="modalArea5">
                                                <select  id="inputArea5" class="form-control">
                                                    <option value="">SELECCIONE UNA</option>
                                                    <?php
                                                    include 'gold/enlace.php';
                                                    $query = mysqli_query($enlace,"SELECT idArea,Nombre FROM areas");
                                                    while ($areas= mysqli_fetch_array($query,MYSQLI_ASSOC)) {

                                                        echo ' <option value="'.$areas["Nombre"].'">'.$areas["Nombre"].' </option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                    </form>


                                    <div class="form-group" id="Mensaje">

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                    <input type="submit" class="btn btn-info" onclick="cambiosIntegrante()" value="Guardar Cambios">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIN INTEGRAR MODAL-->


                    <!-- MODIFICAR MODAL-->
                    <div class="modal fade" id="scrollingModalModificar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">EDITAR OVEJA</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" id="formularioModal" role="form">

                                        <div class="form-group">

                                            <div class="col-md-6" id="modalIdentidadMod">
                                                <input type="text" class="form-control" placeholder="IDENTIDAD" id="identidadInputMod">
                                                <div id="alertIdentidadModalMod" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">IDENTIDAD INVALIDA</div>

                                                <input type="hidden" class="form-control" placeholder="ID" id="idInputMod">
                                            </div>

                                            <div class="col-md-6" id="modalNombreMod">
                                                <input type="text" class="form-control" placeholder="NOMRBE COMPLETO" id="nombreInputMod">
                                                <div id="alertNombreModalMod" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">NOMBRE INVALIDO</div>

                                            </div>


                                        </div>

                                        <div class="form-group">

                                            <div class="col-md-6" id="modalCelMod">
                                                <input type="number" class="form-control" placeholder="NUMERO DE CELULAR CLARO" id="celInputMod">
                                                <div id="alertCelModalMod" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">CELULAR INVALIDO</div>

                                            </div>

                                            <div class="col-md-6" id="modalTelMod">
                                                <input type="number" class="form-control" placeholder="NUMERO DE CELULAR TIGO" id="telInputMod">
                                            </div>


                                        </div>


                                        <div class="form-group" >
                                            <div class="col-md-6" id="modalFijoMod">
                                                <input type="number" class="form-control" placeholder="NUMERO DE TELEFONO FIJO" id="fijoInputMod">
                                            </div>

                                            <div class="col-md-6" id="modalArea1Mod">
                                                <select  id="inputArea1Mod" class="form-control">
                                                    <option value="">SELECCIONE UNA</option>
                                                    <?php
                                                    include 'gold/enlace.php';
                                                    $query = mysqli_query($enlace,"SELECT idArea,Nombre FROM areas");
                                                    while ($areas= mysqli_fetch_array($query,MYSQLI_ASSOC)) {

                                                        echo ' <option value="'.$areas["Nombre"].'">'.$areas["Nombre"].' </option>';
                                                    }
                                                    ?>
                                                </select>
                                                <div id="alertAreaModalMod" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">DEBES SELECCIONAR UNA</div>

                                            </div>



                                        </div>

                                        <div class="form-group">

                                                <div class="col-md-6" id="modalArea2Mod">
                                                    <select  id="inputArea2Mod"   class="form-control " >
                                                        <option value="">SELECCIONE UNA</option>
                                                        <?php
                                                        include 'gold/enlace.php';
                                                        $query = mysqli_query($enlace,"SELECT idArea,Nombre FROM areas");
                                                        while ($areas= mysqli_fetch_array($query,MYSQLI_ASSOC)) {

                                                            echo ' <option value="'.$areas["Nombre"].'">'.$areas["Nombre"].' </option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            <div class="col-md-6" id="modalArea3Mod">
                                                <select  id="inputArea3Mod" class="form-control">
                                                    <option value="">SELECCIONE UNA</option>
                                                    <?php
                                                    include 'gold/enlace.php';
                                                    $query = mysqli_query($enlace,"SELECT idArea,Nombre FROM areas");
                                                    while ($areas= mysqli_fetch_array($query,MYSQLI_ASSOC)) {

                                                        echo ' <option value="'.$areas["Nombre"].'">'.$areas["Nombre"].' </option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="form-group">

                                            <div class="col-md-6" id="modalArea4Mod">
                                                <select  id="inputArea4Mod" class="form-control">
                                                    <option value="">SELECCIONE UNA</option>
                                                    <?php
                                                    include 'gold/enlace.php';
                                                    $query = mysqli_query($enlace,"SELECT idArea,Nombre FROM areas");
                                                    while ($areas= mysqli_fetch_array($query,MYSQLI_ASSOC)) {

                                                        echo ' <option value="'.$areas["Nombre"].'">'.$areas["Nombre"].' </option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-md-6" id="modalArea5Mod">
                                                <select  id="inputArea5Mod" class="form-control">
                                                    <option value="">SELECCIONE UNA</option>
                                                    <?php
                                                    include 'gold/enlace.php';
                                                    $query = mysqli_query($enlace,"SELECT idArea,Nombre FROM areas");
                                                    while ($areas= mysqli_fetch_array($query,MYSQLI_ASSOC)) {

                                                        echo ' <option value="'.$areas["Nombre"].'">'.$areas["Nombre"].' </option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                    </form>


                                    <div class="form-group" id="MensajeModal">

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                    <input type="submit" class="btn btn-info" onclick="cambiosOvejasIntegradas()" value="Guardar Cambios">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIN MODIFICAR MODAL -->

            </section>
        </section>
    </form>
    <!--main content end-->

</section>
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
<script src="js/integrarOvejas.js"></script>
<script src="js/pruebaCambios.js"></script>
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