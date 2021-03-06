<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 3/11/2018
 * Time: 9:13 AM
 */

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
      <title>CAMBIOS OVEJAS</title>
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

      <!--DatePicker-->
      <link rel="stylesheet" href="myfiles/DatePicker/css/bootstrap-datepicker.css">




      <script src="assets/js/modernizr-2.6.2.min.js"></script>
      <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
      <![endif]-->






      <style>
          #ModalRegistrar .modal-dialog  {width:75%;}
          #scrollingModal .modal-dialog  {width:75%;}

          .bien{
              background-color:#3CBE34;
              text-align:center;
              font-size:14px;
              color:#FFF;
              padding:5px;
              border-radius: 50px;
          }
          table th {
              text-align: center;
          }
          table td {
              text-align: center;
          }
      </style>
  </head>
  <body>
  <section id="container">
      <header id="header">
          <!--logo start-->
          <div class="brand">
              <a href="#" class="logo"><span>Mayor</span>domia</a>
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
                          <?php  echo $_SESSION['nombre']; ?> <i class="fa fa-angle-down"></i>
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
                  $focusMenu = "";//M3
                  $focusSubMenu = "";//SM3.3
                  menuSubmenu($permisos,$focusMenu,$focusSubMenu);
                  ?>
              </ul>
          </div>

      </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section class="main-content-wrapper">
          <section id="main-content">
              <div class="row">
                  <div class="col-md-12">
                      <!--breadcrumbs start -->

                      <!--breadcrumbs end -->

                      <!--Inicio de todo el codigo que se pondra-->
                      <div class="row">
                          <div class="col-md-12">
                              <h1 class="page-header">
                                  CAMBIOS OVEJAS
                              </h1>
                          </div>
                      </div> <!-- ROW -->


                      <div class="col-sm-12" style="margin-top: 3%">
                          <div class="form-group">
                              <input type="text" style="text-transform: uppercase;" class="form-control" id="nombreOveja" placeholder="NOMBRE INTEGRANTE" autofocus >
                          </div>
                      </div>

                      <div class="col-sm-12">
                          <div id="tablaRegistros"></div>
                      </div>
                      <!--fin de todo el codigo que se pondra-->
                  </div>
              </div>

          </section>
      </section>
      <!--main content end-->
      <!--sidebar right start-->

      <!--sidebar right end-->
  </section>










  <!-- Scrolling Modal -->
  <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content ">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">CAMBIOS</h4>
              </div>
              <div class="modal-body">
                  <form class="form-horizontal" id="formulario" role="form">

                      <div class="form-group">

                          <div class="col-lg-4" id="divCivil1">
                              <select class="form-control" id="ECC">
                                  <option value="">Estado Civil</option>
                                  <option value="Casado">Casado(a)</option>
                                  <option value="Soltero">Soltero(a)</option>
                                  <option value="Divorciado">Divorciado(a)</option>
                                  <option value="Union">Union Libre</option>
                              </select>
                              <div id="alertEstadoCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Estado Civil Invalido</div>

                          </div>

                          <div class="col-lg-4" id="divGenero1">
                              <select id="GFM" class="form-control">
                                  <option value="">Genero</option>
                                  <option value="M">Masulino</option>
                                  <option value="F">Femenino</option>
                              </select>
                              <div id="alertGeneroCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Genero Invalido</div>
                          </div>

                          <div class="col-lg-4" id="divTransporte1">
                              <select class="form-control" id="OCT">
                                  <option value="">Necesita Transporte</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                              <div id="alertTransporteCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Respuesta Invalida</div>
                          </div>
                      </div>

                      <div class="form-group">

                          <div class="col-lg-4" id="identidadCambios">
                              <input type="text" style="text-transform: uppercase;" class="form-control" id="numero_I" placeholder="Ejemplo : 1708199200377">
                              <input type="hidden" id="id-prod">
                              <div id="alertIdentidadCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Identidad Invalida</div>

                          </div>

                          <div class="col-lg-4" id="nombreCambio">
                              <input type="text" style="text-transform: uppercase;" class="form-control" id="nombreI" placeholder="Ejemplo : Denny Molina">
                              <div id="alertNombreCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Nombre Invalido</div>

                          </div>

                          <div class="col-lg-4">



                              <div class="input-group" id="fechaCambios">
                                  <input type="text" id="fecha_cumple" name="daterange" class="datepicker form-control" placeholder="Ejemplo : 2017-09-25">
                                  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>


                              </div>
                              <div id="alertFechaCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Fecha Invalida</div>
                          </div>

                      </div>


                      <div class="form-group" >
                          <div class="col-lg-4" id="celCambios">
                              <input type="text" style="text-transform: uppercase;" class="form-control" id="num_cel" placeholder="Ejemplo : 94632899">
                              <div id="alertTelCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Numero Invalido</div>

                          </div>
                          <div class="col-lg-4">
                              <input type="text" style="text-transform: uppercase;" class="form-control" id="num_tel" placeholder="Ejemplo : 25641119">
                          </div>
                          <div class="col-lg-4" id="estadoCambios">
                              <select name="estados" class="form-control" id="estados">
                                  <option value="">Estado</option>
                                  <option value="1">Activo</option>
                                  <option value="3">Inactivo</option>
                                  <option value="2">Retirado</option>
                              </select>
                              <div id="alertEstadoIntCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Estado Invalido</div>

                          </div>
                      </div>

                      <div class="form-group">

                          <div class="col-lg-4">
                              <select class="form-control" id="CambioP">
                                  <option value="">NUMERO DE PROMOCION</option>
                                  <?php
                                  require_once 'gold/enlace.php';

                                  $querySelect= mysqli_query($enlace, "SELECT idpromocion,desc_promocion from promociones WHERE `status` = 1");

                                  while ($fila = mysqli_fetch_array($querySelect,MYSQLI_ASSOC)) {

                                      echo '<option value="'.$fila['idpromocion'].'" >'.$fila["desc_promocion"].'</option>';
                                  }
                                  ?>
                              </select>
                              <div id="alertPromocionCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Promocion Invalida</div>

                          </div>
                          <div class="col-lg-4">
                              <select class="form-control" id="CambioE">
                                  <option value="">NUMERO DE EQUIPO</option>
                                  <?php
                                  require_once 'gold/enlace.php';

                                  $querySelect= mysqli_query($enlace, "SELECT id_equipo,num_equipo,nombre_equipo FROM equipos
INNER JOIN promociones ON equipos.id_promocion = promociones.idpromocion
where promociones.`status`=1");

                                  while ($fila = mysqli_fetch_array($querySelect,MYSQLI_ASSOC)) {

                                      echo '<option  value="'.$fila['id_equipo'].'">'.$fila["num_equipo"].' - '.$fila["nombre_equipo"].'</option>';
                                  }
                                  ?>
                              </select>
                              <div id="alertEquipoCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Equipo Invalida</div>

                          </div>
                          <div class="col-lg-4">
                              <select class="form-control" id="Cargos">
                                  <option value="">CARGOS</option>
                                  <?php
                                  require_once 'gold/enlace.php';

                                  $querySelect= mysqli_query($enlace, "SELECT idcargo,nombre_cargo FROM cargos");

                                  while ($fila = mysqli_fetch_array($querySelect,MYSQLI_ASSOC)) {

                                      echo '<option value="'.$fila['idcargo'].'">'.$fila["nombre_cargo"].'</option>';
                                  }
                                  ?>
                              </select>
                              <div id="alertCargoCambios" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Cargo Invalida</div>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-lg-12">
                              <textarea class="form-control" rows="3" id="commentEditar" placeholder="Direccion de residencia"></textarea>
                          </div>
                      </div>

                  </form>


                  <div class="form-group" id="Mensaje">

                  </div>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                  <input type="submit" class="btn btn-info" onclick="cambiosPersona()" value="Guardar Cambios">

              </div>
          </div>
      </div>
  </div>
  <!-- End Scrolling Modal -->



  <!--Global JS-->

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
  <script src="js/jquery.js"></script>
  <script src="js/cambiosOvejas.js"></script>

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