<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 25/2/2019
 * Time: 2:07 PM
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
                  $focusMenu = "SM2";
                  $focusSubMenu = "SM2.12";
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
                      <h1 class="h1">REPORTE FECHAS</h1>
                      <div class="col-md-12">

                          <?php
                          if($_SESSION['nombre'] == "Administrador"){

                              include 'gold/enlace.php';
                              $queryFechasActive = mysqli_query($enlace,"SELECT clases.f1,clases.f2,clases.f3,clases.f4,clases.f5,clases.f6,clases.f7,clases.f8,promociones.desc_promocion from clases
INNER JOIN promociones ON clases.idPromocion = promociones.idpromocion
where  promociones.`status`=1");
                              $datosFechaActive = mysqli_fetch_array($queryFechasActive,MYSQLI_ASSOC);
                              $f1 = $datosFechaActive["f1"];
                              $f2 = $datosFechaActive["f2"];
                              $f3 = $datosFechaActive["f3"];
                              $f4 = $datosFechaActive["f4"];
                              $f5 = $datosFechaActive["f5"];
                              $f6 = $datosFechaActive["f6"];
                              $f7 = $datosFechaActive["f7"];
                              $f8 = $datosFechaActive["f8"];



                              echo'<div class="form-group">';
                                  echo' <div class="col-md-3" >';
                                  echo '<label>FECHA 1 </label>';
                                    echo'<div class="input-group-addon  btn btn-primary btn-trans" onclick="guardarFecha(1)">';
                                        echo'<i class="fa fa-save"></i>';
                                    echo'</div>';
                                        echo'<input id="fecha1" type="date" class="form-control" value="'.$f1.'" >';
                                  echo'</div>';

                              echo' <div class="col-md-3" >';
                              echo '<label>FECHA 2 </label>';
                              echo'<div class="input-group-addon  btn btn-primary btn-trans" onclick="guardarFecha(2)">';
                              echo'<i class="fa fa-save"></i>';
                              echo'</div>';
                              echo'<input id="fecha2" type="date"  class="form-control" value="'.$f2.'"> ';
                              echo'</div>';

                              echo' <div class="col-md-3" >';
                              echo '<label>FECHA 3 </label>';
                              echo'<div class="input-group-addon  btn btn-primary btn-trans" onclick="guardarFecha(3)">';
                              echo'<i class="fa fa-save"></i>';
                              echo'</div>';
                              echo'<input id="fecha3" type="date" class="form-control" value="'.$f3.'"> ';
                              echo'</div>';

                              echo' <div class="col-md-3" >';
                              echo '<label>FECHA 4 </label>';
                              echo'<div class="input-group-addon  btn btn-primary btn-trans" onclick="guardarFecha(4)">';
                              echo'<i class="fa fa-save"></i>';
                              echo'</div>';
                              echo'<input id="fecha4" type="date" class="form-control" value="'.$f4.'"> ';
                              echo'</div>';

                              echo'</div>';


                              echo'<div class="form-group">';
                              echo' <div class="col-md-3" >';
                              echo '<label>FECHA 5 </label>';
                              echo'<div class="input-group-addon  btn btn-primary btn-trans" onclick="guardarFecha(5)">';
                              echo'<i class="fa fa-save"></i>';
                              echo'</div>';
                              echo'<input id="fecha5" type="date" class="form-control" value="'.$f5.'"> ';
                              echo'</div>';

                              echo' <div class="col-md-3" >';
                              echo '<label>FECHA 6 </label>';
                              echo'<div class="input-group-addon  btn btn-primary btn-trans" onclick="guardarFecha(6)">';
                              echo'<i class="fa fa-save"></i>';
                              echo'</div>';
                              echo'<input id="fecha6" type="date" class="form-control" value="'.$f6.'"> ';
                              echo'</div>';

                              echo' <div class="col-md-3" >';
                              echo '<label>FECHA 7 </label>';
                              echo'<div class="input-group-addon  btn btn-primary btn-trans" onclick="guardarFecha(7)">';
                              echo'<i class="fa fa-save"></i>';
                              echo'</div>';
                              echo'<input id="fecha7" type="date" class="form-control" value="'.$f7.'"> ';
                              echo'</div>';

                              echo' <div class="col-md-3" >';
                              echo '<label>FECHA 8 </label>';
                              echo'<div class="input-group-addon  btn btn-primary btn-trans" onclick="guardarFecha(8)">';
                              echo'<i class="fa fa-save"></i>';
                              echo'</div>';
                              echo'<input id="fecha8" type="date" class="form-control" value="'.$f8.'"> ';
                              echo'</div>';

                              echo'</div>';

                          }else{
                              include 'gold/enlace.php';
                              $queryFechasDisabled = mysqli_query($enlace,"SELECT clases.f1,clases.f2,clases.f3,clases.f4,clases.f5,clases.f6,clases.f7,clases.f8,promociones.desc_promocion from clases
INNER JOIN promociones ON clases.idPromocion = promociones.idpromocion
where  promociones.`status`=1");
                              $datosFechaDisabled = mysqli_fetch_array($queryFechasDisabled,MYSQLI_ASSOC);
                              $f1 = $datosFechaDisabled["f1"];
                              $f2 = $datosFechaDisabled["f2"];
                              $f3 = $datosFechaDisabled["f3"];
                              $f4 = $datosFechaDisabled["f4"];
                              $f5 = $datosFechaDisabled["f5"];
                              $f6 = $datosFechaDisabled["f6"];
                              $f7 = $datosFechaDisabled["f7"];
                              $f8 = $datosFechaDisabled["f8"];

                              echo' <div class="form-group">';
                                echo'<div class="col-md-3">';
                                  echo'<label>FECHA 1</label>';
                                  echo'<input type="date" class="form-control " disabled="disabled" value="'.$f1.'"> ';
                                echo'</div>';

                              echo'<div class="col-md-3">';
                                 echo'<label>FECHA 2</label>';
                                 echo'<input type="date" class="form-control " disabled="disabled" value="'.$f2.'" > ';
                              echo'</div>';

                              echo'<div class="col-md-3">';
                                echo'<label>FECHA 3</label>';
                                echo'<input type="date" class="form-control " disabled="disabled" value="'.$f3.'" > ';
                              echo'</div>';

                              echo'<div class="col-md-3">';
                                echo'<label>FECHA 4</label>';
                                echo'<input type="date" class="form-control " disabled="disabled" value="'.$f4.'" > ';
                              echo'</div>';

                              echo'</div>';


                              echo' <div class="form-group">';
                              echo'<div class="col-md-3">';
                              echo'<label>FECHA 5</label>';
                              echo'<input type="date" class="form-control " disabled="disabled" value="'.$f5.'" > ';
                              echo'</div>';

                              echo'<div class="col-md-3">';
                              echo'<label>FECHA 6</label>';
                              echo'<input type="date" class="form-control " disabled="disabled" value="'.$f6.'" > ';
                              echo'</div>';

                              echo'<div class="col-md-3">';
                              echo'<label>FECHA 7</label>';
                              echo'<input type="date" class="form-control " disabled="disabled" value="'.$f7.'" > ';
                              echo'</div>';

                              echo'<div class="col-md-3">';
                              echo'<label>FECHA 8</label>';
                              echo'<input type="date" class="form-control " disabled="disabled" value="'.$f8.'" > ';
                              echo'</div>';

                              echo'</div>';
                          }
                          ?>

                          <div class="col-md-12">
                              <div class="panel panel-default">

                                  <div class="panel-body">

                                     <div class="form-group col-md-10">
                                         <select  id="selectEquipoReporteFechas" class="form-control">
                                             <option value="">EQUIPO</option>
                                             <?php
                                             include 'gold/enlace.php';
                                             $queryEquipos= mysqli_query($enlace,"SELECT * from equipos
INNER JOIN promociones on equipos.id_promocion = promociones.idpromocion
WHERE promociones.`status` = 1 and equipos.num_equipo>0 GROUP BY equipos.num_equipo ASC ");
                                             while ($datosEquiposFecha =mysqli_fetch_array($queryEquipos,MYSQLI_ASSOC)){
                                                 echo'<option value="'.$datosEquiposFecha["id_equipo"].'">'.$datosEquiposFecha["num_equipo"].'-'.$datosEquiposFecha["nombre_equipo"].'</option>';
                                             }
                                             ?>
                                         </select>
                                     </div>
                                      <div class="col-md-2">
                                          <input type="button" class="btn btn-success btn-trans" value="EXCEL" onclick="exportarExcel()">
                                      </div>

                                      <div class="form-group col-md-12" id="divTablaReporte">

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
  <script src="js/reporteFechas.js"></script>



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