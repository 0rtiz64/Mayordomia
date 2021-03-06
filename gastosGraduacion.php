<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 12/8/2019
 * Time: 1:49 PM
 */

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
      <link rel="stylesheet" href="js/scenejs/font.css">
      <link rel="stylesheet" href="js/scenejs/css/gastosGraduacionDatosIntegrante.css">
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
                          <input type="hidden" id="nombreServidor" value=" <?php echo  $_SESSION["nombreServidor"]?>">
                          <input type="hidden" id="equipoServicio" value=" <?php echo  $_SESSION["equipoGG"]?>">
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
                  $focusMenu = "M8";
                  $focusSubMenu = "SM8.3";
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
                      <h1 class="h1">GASTOS DE GRADUACION  </h1>
                      <div class="col-md-12">
                        <div class="col-md-6">
                            <input type="password" class="form-control" placeholder="LEER TAG" title="LEER TAG" style="border-radius: 10px;" id="tagDatosInput" autofocus>
                            <input type="submit" class="btn btn-success collapse" onclick="buscarDatos(); ">
                        </div>
                          <div class="col-md-6 ">
                              <input type="text" class="form-control" placeholder="BUSQUEDA POR NOMBRE" style="border-radius: 10px;text-transform: uppercase" id="inputBusquedaNombreGastosGraduacion">
                          </div>

                         <div class="col-md-12 collapse" id="resultados" style="margin-top: 1%">

                         </div>

                      </div>
                  </div>
              </section>
          </section>
      </form>
      <!--main content end-->

      <!--MODAL PAGO INICIO-->
      <div class="modal fade" id="modalPago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="border-radius: 10px">
          <div class="modal-dialog modal-lg">
              <div class="modal-content ">
                  <div class="modal-header" style="background-color: #ffffff ">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <!--h4 class="modal-title" id="myModalLabel" style="color: white">IDENTIDAD YA REGISTRADA EN </h4-->
                            <h3 style="color:gray ">AÑADIR PAGO</h3>
                  </div>
                  <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6 form-group" id="divTipoPago">
                                <select  id="inputTipoPago" class="form-control" style="border-radius: 10px;">
                                    <option value="">TIPO DE PAGO</option>
                                    <?php
                                    include 'gold/enlace.php';
                                    $queryTipoPagos  = mysqli_query($enlace,"SELECT * from tipopago WHERE estado =1");
                                    while ($datosTipoPago = mysqli_fetch_array($queryTipoPagos,MYSQLI_ASSOC)){
                                        echo '<option value="'.$datosTipoPago["idTipoPago"].'">'.$datosTipoPago["nombre"].'</option>';
                                    }
                                    ?>


                                </select>
                            </div>

                            <div class="col-md-6 form-group" id="divValorPago">
                                <input id="inputValorPago" type="number" min="0" class="form-control" placeholder="VALOR" title="VALOR" style="border-radius: 10px  ">
                            </div>

                            <div class="col-md-12 form-group">
                                <div class="input-group" style="border-radius: 10px">
                                    <select class="form-control" id="togaTallaSelectModalPago" style="color:GrayText;border-top-left-radius:10px;border-bottom-left-radius: 10px">
                                        <option style="border-radius: 10px" value="">ELIGE TU TALLA</option>
                                        <option style="border-radius: 10px"  value="S">S</option>
                                        <option style="border-radius: 10px" value="L">L</option>
                                        <option style="border-radius: 10px" value="M">M</option>
                                    </select>
                                    <span id="inputGuardarNuevaTalla" style="background-color: #343A40; color: white;border-top-right-radius:10px;border-bottom-right-radius: 10px" class="input-group-addon" onclick="cambioTallaModalPago();"><i class="fa fa-save"></i></span>

                                </div>
                            </div>

                        </div>
                  </div>

                  <div class="modal-footer">
                      <button onclick="realizarPago();" type="button" class="btn btn-block" style="background-color: #343A40;color: #ffffff; border-radius: 10px"><i class="fa fa-dollar"></i> REALIZAR PAGO</button>
                  </div>
              </div>
          </div>
      </div>
      <!--MODAL PAGO FINAL-->

      <!--MODAL CONTRASEÑA INICIO-->
      <div class="modal fade" id="modalPasswordAnular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
              <div class="modal-content ">
                  <div class="modal-header" style="background-color: #ffffff " align="center">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 style="color:gray ">ACCION BLOQUEADA</h4>
                  </div>
                  <div class="modal-body">
                      <input type="password"class="form-control" id="contraseñaAAutorizar" placeholder="INGRESA CONTRASEÑA" style="border-radius: 10px">
                      <input type="hidden" id="idDetallePagoAutorizarAnulacion">
                  </div>

                  <div class="modal-footer">
                      <button onclick="autorizarAnulacion()" type="button" class="btn btn-block" style="background-color: #343A40;color: #ffffff; border-radius: 10px"><i class="fa fa-lock"></i> AUTORIZAR</button>
                  </div>
              </div>
          </div>
      </div>
      <!--MODAL CONTRASEÑA FINAL-->

  </section>
  <!--Global JS-->
  <script src="myfiles/js/jquery-3.2.1.min%20(2).js"></script>
  <script src="assets/js/jquery-1.10.2.min.js"></script>
  <script src="alertify/alertify.min.js"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/plugins/waypoints/waypoints.min.js"></script>
  <script src="assets/js/application.js"></script>
  <script src="js/sweetalert.js"></script>
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
  <script src="js/gastosGraduacion.js"></script>




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