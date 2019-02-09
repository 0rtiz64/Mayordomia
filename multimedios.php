<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 6/2/2019
 * Time: 8:12 AM
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
                  $focusMenu = "M9";
                  $focusSubMenu = "SM9.1";
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
                      <h1 class="h1">ESTADOS</h1>
                      <div class="col-md-12">

                          <div class="panel panel-default">

                              <div class="panel-body">
                                  <div class="tab-wrapper tab-primary">
                                      <ul class="nav nav-tabs">
                                          <p>
                                          <li class="active"><a href="#home1" data-toggle="tab" aria-expanded="false">GENERAL</a></li>
                                          </p>


                                          <?php
                                          include "gold/enlace.php";
                                          $queryCantidadesActivos = mysqli_query($enlace,"SELECT COUNT(*) as activos from detalle_integrantes
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE (detalle_integrantes.id_cargo = 8 or detalle_integrantes.id_cargo =5) and promociones.`status`= 1 and detalle_integrantes.`status` = 1 ");
                                          $datosCantidadActivos = mysqli_fetch_array($queryCantidadesActivos,MYSQLI_ASSOC);
                                          $activos = $datosCantidadActivos["activos"];

                                          $queryCantidadesDesactivos = mysqli_query($enlace,"SELECT COUNT(*) as desactivos from detalle_integrantes
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE (detalle_integrantes.id_cargo = 8 or detalle_integrantes.id_cargo =5) and promociones.`status`= 1 and detalle_integrantes.`status` = 2 ");
                                          $datosCantidaddesactivos = mysqli_fetch_array($queryCantidadesDesactivos,MYSQLI_ASSOC);
                                          $desactivos = $datosCantidaddesactivos["desactivos"];

                                            echo'
                                            <p>
                                            <li class=""><a href="#profile1" data-toggle="tab" aria-expanded="true">ACTIVOS :   <span id="activos" style="margin-top: 2%;" class="label label-info pull-right inbox-notification">'.$activos.'</span></a></li>
                                            </p>';

                                            echo'
                                            <p>
                                            <li class=""><a href="#profile2" data-toggle="tab" aria-expanded="true">DESACTIVADOS :  <span id="desactivos" style="margin-top: 2%;" class="label label-danger pull-right inbox-notification">'.$desactivos.'</span></a></li>
                                            </p>
                                            ';
                                              ?>


                                      </ul>
                                      <div class="tab-content">
                                          <div class="tab-pane active" id="home1">
                                             <!--GENERAL-->
                                              <div class="panel panel-default">

                                                  <div class="panel-body" id="table">
                                                      <table class="table table-hover" >
                                                          <thead>
                                                          <tr align="center">
                                                              <td><strong>#</strong></td>
                                                              <td><strong>NOMBRE</strong></td>
                                                              <td><strong>OPCIONES</strong></td>
                                                          </tr>
                                                          </thead>
                                                          <tbody>

                                                          <?php
                                                          include "gold/enlace.php";
                                                          $query = mysqli_query($enlace,"SELECT integrantes.idintegrante,integrantes.nombre_integrante,detalle_integrantes.`status` as estado from detalle_integrantes
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE (detalle_integrantes.id_cargo = 8 or detalle_integrantes.id_cargo =5) and promociones.`status`= 1  GROUP BY integrantes.nombre_integrante ASC");
                                                          $c=1;
                                                          while ($Datos =mysqli_fetch_array($query,MYSQLI_ASSOC)){
                                                              if($Datos["estado"]==1){
                                                                  $boton = '<button type="button" class="btn btn-danger btn-trans" onclick="desactivar('.$Datos["idintegrante"].')">DESACTIVAR</button>';
                                                              }else{
                                                                  $boton = '<button type="button" class="btn btn-success btn-trans" onclick="activar('.$Datos["idintegrante"].')">ACTIVAR</button>';
                                                              }

                                                              echo' <tr align="center">';
                                                              echo'<td>'.$c.'</td>';
                                                              echo'<td>'.$Datos["nombre_integrante"].'</td>';
                                                              echo'<td>'.$boton.'</td>';
                                                              echo'</tr>';
                                                              $c++;
                                                          }
                                                          ?>

                                                          </tbody>
                                                      </table>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="tab-pane " id="profile1">
                                              <!--ACTIVOS-->
                                              <div class="panel-body" id="tableActivos">
                                                  <table class="table table-hover" >
                                                      <thead>
                                                      <tr align="center">
                                                          <td><strong>#</strong></td>
                                                          <td><strong>NOMBRE</strong></td>
                                                          <td><strong>OPCIONES</strong></td>
                                                      </tr>
                                                      </thead>
                                                      <tbody>

                                                      <?php
                                                      include "gold/enlace.php";
                                                      $query = mysqli_query($enlace,"SELECT integrantes.idintegrante,integrantes.nombre_integrante,detalle_integrantes.`status` as estado from detalle_integrantes
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE (detalle_integrantes.id_cargo = 8 or detalle_integrantes.id_cargo =5) and promociones.`status`= 1 and detalle_integrantes.`status` = 1 group  by integrantes.nombre_integrante ASC ");
                                                      $c=1;
                                                      while ($Datos =mysqli_fetch_array($query,MYSQLI_ASSOC)){
                                                          if($Datos["estado"]==1){
                                                              $boton = '<button type="button" class="btn btn-danger btn-trans" onclick="desactivar('.$Datos["idintegrante"].')">DESACTIVAR</button>';
                                                          }else{
                                                              $boton = '<button type="button" class="btn btn-success btn-trans" onclick="activar('.$Datos["idintegrante"].')">ACTIVAR</button>';
                                                          }

                                                          echo' <tr align="center">';
                                                          echo'<td>'.$c.'</td>';
                                                          echo'<td>'.$Datos["nombre_integrante"].'</td>';
                                                          echo'<td>'.$boton.'</td>';
                                                          echo'</tr>';
                                                          $c++;
                                                      }
                                                      ?>

                                                      </tbody>
                                                  </table>
                                              </div>
                                          </div>


                                          <div class="tab-pane " id="profile2">
                                              <!--ACTIVOS-->
                                              <div class="panel-body" id="tableDesactivos">
                                                  <table class="table table-hover" >
                                                      <thead>
                                                      <tr align="center">
                                                          <td><strong>#</strong></td>
                                                          <td><strong>NOMBRE</strong></td>
                                                          <td><strong>OPCIONES</strong></td>
                                                      </tr>
                                                      </thead>
                                                      <tbody>

                                                      <?php
                                                      include "gold/enlace.php";
                                                      $query = mysqli_query($enlace,"SELECT integrantes.idintegrante,integrantes.nombre_integrante,detalle_integrantes.`status` as estado from detalle_integrantes
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
INNER JOIN promociones on detalle_integrantes.id_promocion = promociones.idpromocion
WHERE (detalle_integrantes.id_cargo = 8 or detalle_integrantes.id_cargo =5) and promociones.`status`= 1 and detalle_integrantes.`status` = 2");
                                                      $c=1;
                                                      while ($Datos =mysqli_fetch_array($query,MYSQLI_ASSOC)){
                                                          if($Datos["estado"]==1){
                                                              $boton = '<button type="button" class="btn btn-danger btn-trans" onclick="desactivar('.$Datos["idintegrante"].')">DESACTIVAR</button>';
                                                          }else{
                                                              $boton = '<button type="button" class="btn btn-success btn-trans" onclick="activar('.$Datos["idintegrante"].')">ACTIVAR</button>';
                                                          }

                                                          echo' <tr align="center">';
                                                          echo'<td>'.$c.'</td>';
                                                          echo'<td>'.$Datos["nombre_integrante"].'</td>';
                                                          echo'<td>'.$boton.'</td>';
                                                          echo'</tr>';
                                                          $c++;
                                                      }
                                                      ?>

                                                      </tbody>
                                                  </table>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>






                      </div>

              </section>
          </section>
      </form>
      <!--main content end-->

  </section>
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
  <script src="myfiles/js/main.js"></script>
  <script src="js/export.js"></script>
  <script src="js/sweetalert.js"></script>
  <script src="js/multimedios.js"></script>



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