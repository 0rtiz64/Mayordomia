<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 21/9/2018
 * Time: 9:46 AM
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
                  $focusMenu = "M6";
                  $focusSubMenu = "SM6.3";
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
                      <h1 class="h1" id="listEquipo">LISTADO PASTOREADORES POR EQUIPO</h1>
                      <h1 class="h1 collapse" id="listPast">LISTADO PASTOREADORES </h1>



                      <div class="col-md-12" >
                          <div id="botones" class="form-group" align="center">
                              <input type="button" class="btn btn-info" value="LISTADO PASTOREADORES POR EQUIPO" id="Equipo">
                              <input type="button" class="btn btn-primary"value="LISTADO PASTOREADORES" id="listado">
                          </div>

                         <div id="pastPorEquipo">
                             <a href="php/pdfListadoPastoreadoresEquipo.php" target="_blank" class="btn btn-danger" style="color: #ffffff;">PDF</a>
                             <table class="table table-bordered table-striped">
                                 <thead>
                                 <tr align="center">
                                     <td><strong>#</strong></td>
                                     <td><strong>EQUIPO</strong></td>
                                     <td><strong>PASTOREADOR 1</strong></td>
                                     <td><strong>PASTOREADOR 2</strong></td>
                                 </tr>
                                 </thead>
                                 <tbody>
                                 <?php
                                 include 'gold/enlace.php';
                                 $queryIdEquipos= mysqli_query($enlace,"SELECT id_equipo, num_equipo,nombre_equipo from equipos 
INNER JOIN promociones ON equipos.id_promocion = promociones.idpromocion
where promociones.`status` = 1 and  equipos.num_equipo> 0 GROUP BY num_equipo ASC");
                                 $contador = 1;
                                 while ($datosId = mysqli_fetch_array($queryIdEquipos,MYSQLI_ASSOC)){
                                     $idEquipo = $datosId["id_equipo"];
                                     $confirmarPastoreadores = mysqli_num_rows(mysqli_query($enlace,"SELECT * from detalle_integrantes 
where detalle_integrantes.id_equipo = $idEquipo AND detalle_integrantes.id_cargo = 9"));



                                     if($confirmarPastoreadores>1){
                                         $queryPastoreadoresPorEquipo= mysqli_query($enlace,"SELECT nombre_integrante from detalle_integrantes 
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
where detalle_integrantes.id_equipo = $idEquipo AND detalle_integrantes.id_cargo = 9");
                                         echo '<tr align="center">';
                                         echo '<td>'.$contador.'</td>';
                                         echo '<td>'.$datosId["num_equipo"].'- '.$datosId["nombre_equipo"].'</td>';
                                         while ($datosPastoreadores = mysqli_fetch_array($queryPastoreadoresPorEquipo,MYSQLI_ASSOC)){
                                             echo '<td>'.utf8_encode($datosPastoreadores["nombre_integrante"]).'</td>';
                                         };
                                         echo '</tr>';
                                     }else{
                                         $queryPastoreadoresPorEquipo= mysqli_query($enlace,"SELECT nombre_integrante from detalle_integrantes 
INNER JOIN integrantes on detalle_integrantes.id_integrante = integrantes.idintegrante
where detalle_integrantes.id_equipo = $idEquipo AND detalle_integrantes.id_cargo = 9");
                                         $datosPastoreadores = mysqli_fetch_array($queryPastoreadoresPorEquipo,MYSQLI_ASSOC);
                                         echo  '<tr align="center">';
                                         echo  '<td>'.$contador.'</td>';
                                         echo '<td>'.$datosId["num_equipo"].'- '.$datosId["nombre_equipo"].'</td>';
                                         echo '<td>'.utf8_encode($datosPastoreadores["nombre_integrante"]).'</td>';
                                         echo '<td></td>';
                                         echo  '</tr>';
                                     }
                                     $contador++;
                                 }
                                 ?>
                                 </tbody>

                             </table>
                         </div>

                          <div id="listadodPast" class="collapse">

                              <div id="tablaListadoPastoreadoresTodos">


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
  <script src="js/listadoPastoreadores.js"></script>
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