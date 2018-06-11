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
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="expires" content="0">
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
    <!-- Feature detection -->

        <!--ALERTIFY INICIO-->
        <link rel="stylesheet" href="alertify/css/alertify.css">
        <link rel="stylesheet" href="alertify/css/themes/bootstrap.css">
        <!--ALERTIFY FIN-->

        <link rel="stylesheet" href="css/hover.css">

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
            $focusSubMenu = "SM3.9";
            menuSubmenu($permisos,$focusMenu,$focusSubMenu);
         ?> 

    </ul>
</div>

        </aside>
         <!--sidebar end-->
         <!--main content start-->
        <!--form class="form-horizontal " id="formularioReporteEquipo" -->
            <section class="main-content-wrapper">
                <section id="main-content">

                    <div class="row">
                        <h1 class="h1">ENLAZAR INTEGRANTES</h1>
                        <br><br>

                        <div class="col-md-12">
                            <div  id="listaIntegrantes" class="col-md-6">
                                <h3 >INTEGRANTES SIN ENLAZAR</h3>
                                <div class='alert alert-danger collapse' id="alertaAgregar" align="center"> <strong>INTEGRANTE YA AGREGADO</strong>  </div>
                                <br>

                                <div class="col-md-12 form-group">
                                    <div class="col-md-10" id="divInputCarnet">
                                        <input type="number" placeholder="LEA EL CARNET" class="form-control" autofocus id="busIdInterno" autocomplete="off" style="text-transform: uppercase" onkeypress="if (event.keyCode == 13) agregar();">
                                    </div>
                                    <!--input type="button" class="btn btn-success  collapse" value="AGREGAR" onclick=" "-->
                                </div>

<div class="form-group col-md-12">
    <strong>
                                <div id="notificacion" align="center" class="alert alert-danger collapse"></div>

                                <div id="notificacionIntegrante"  align="center" class="alert alert-success collapse"></div>
        <div id="detalles" style="float: right" class="collapse col-md-12">
            <a onclick="verDetalles()">Ver detalles</a>
            <input type="hidden" id="idVerDetalles">
        </div>

        <div id="tablaDetalles" CLASS="">

        </div>

    </strong>
</div>



                                <!--div id="resultados" style="width: 500px; height: 300px; overflow: auto "></div-->

                            </div>

                            <div class='form-group col-md-6' >
                            <div class="col-md-12" id="contadorVisible">

                            </div>

                                <div class='col-md-12' >
                                    <div class="form-group col-md-10" id="divSelectEquiposVariosEnlazar">
                                        <select class="form-control" id="equipoSelectEnlazarVarios">
                                            <option value="">EQUIPO</option>
                                            <?php
                                            include 'gold/enlace.php';
                                            $queryEquipos = mysqli_query($enlace,"select equipos.id_equipo,equipos.num_equipo,equipos.nombre_equipo from equipos
INNER JOIN promociones on  equipos.id_promocion = promociones.idpromocion
where promociones.`status`=1");
                                            while ($datosQuery =mysqli_fetch_array($queryEquipos,MYSQLI_ASSOC)){
                                                echo'<option value="'.$datosQuery["id_equipo"].'">'.$datosQuery["num_equipo"].'-'.$datosQuery["nombre_equipo"].'</option>';
                                            }
                                            ?>
                                        </select>
                                        <div id="alertSelectEquipoVariosEnlazar" style=" background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">EQUIPO INVALIDO</div>

                                    </div>
                                    <div class="form-group col-md-2">
                                        <input type="button" class="btn btn-primary" value="ENLAZAR" onclick="enlazarVarios()">
                                    </div>
                                    <table class='table table-bordered' id='dataTable'>
                                        <thead>
                                        <tr>
                                            <th class="idAqui">#</th>
                                            <th>IDENTIDAD</th>
                                            <th>NOMBRE</th>
                                            <th>CELULAR</th>
                                            <th>RETIRAR</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        </tbody>
                                    </table>
                                    <div id='mensajeP8' ></div>
                                    <div id="botonImprimirEtiquetasEquipo" class="collapse" align="center">
                                        <input  type="button" class="btn btn-info btn-trans" value="IMPRIMIR ETIQUETAS" onclick="enviarEquipo();">
                                    </div>
                                </div>

                            </div>



                        </div>

                    </div>
                </section>
            </section>

        <!--/form-->
         <!--main content end-->

    </section>
     <!--Global JS-->
    <script src="myfiles/js/jquery-3.2.1.min%20(2).js"></script>
    <script src="assets/js/jquery-1.10.2.min.js"></script>

    <script type="text/javascript" src="ZebraBrowserPrintDocsWebCodeExamples/sample/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="ZebraBrowserPrintDocsWebCodeExamples/sample/js/BrowserPrint-1.0.4.min.js"></script>
    <script type="text/javascript" src="ZebraBrowserPrintDocsWebCodeExamples/sample/js/etiquetasEquipo.js"></script>
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