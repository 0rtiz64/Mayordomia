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
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/solid.css" integrity="sha384-aj0h5DVQ8jfwc8DA7JiM+Dysv7z+qYrFYZR+Qd/TwnmpDI6UaB3GJRRTdY8jYGS4" crossorigin="anonymous">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/fontawesome.css" integrity="sha384-WK8BzK0mpgOdhCxq86nInFqSWLzR5UAsNg0MGX9aDaIIrFWQ38dGdhwnNCAoXFxL" crossorigin="anonymous">
      <!--DatePicker-->
      <link rel="stylesheet" href="myfiles/DatePicker/css/bootstrap-datepicker.css">


      <!--ALERTIFY INICIO-->
      <link rel="stylesheet" href="alertify/css/alertify.css">
      <link rel="stylesheet" href="alertify/css/themes/bootstrap.css">
      <!--ALERTIFY FIN-->

      <link rel="stylesheet" href="css/modal.css">

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
              <button type="button" class="btn btn-default" id="toggle-left"  title="Desplazar Menu">
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
                  $focusMenu = "M3";
                  $focusSubMenu = "SM3.3";
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
  <div  class="modal fade" id="modalEditarOvejaSinEnlazar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content ">
              <div class="modal-header" style="background: #007BFF">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel" style="color: white">CAMBIOS</h4>
              </div>
              <div class="modal-body">

                  <div class="container">
                      <div class="row">
                          <div class="col-lg-5 col-md-12 col-sm-8 col-xs-9 bhoechie-tab-container">
                              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
                                  <ul class="list-group">
                                      <a href="#" class="list-group-item active">
                                          <br/><br/><i class="glyphicon glyphicon-home"></i> Home<br/><br/>
                                      </a>
                                      <a href="#dos" class="list-group-item ">
                                          <br/><br/><i class="glyphicon glyphicon-tasks"></i> Schedule<br/><br/>
                                      </a>
                                      <a href="#" class="list-group-item ">
                                          <br/><br/><i class="glyphicon glyphicon-transfer"></i> My trips<br/><br/>
                                      </a>
                                      <a href="#" class="list-group-item">
                                          <br/><br/><h4 class="glyphicon glyphicon-wrench"></h4> Edit My Information<br/><br/>
                                      </a>
                                  </ul>
                              </div>
                              <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                                  <!-- flight section -->
                                  <div class="bhoechie-tab-content active">
                                      <center>
                                          <h1 class="glyphicon glyphicon-user" style="font-size:14em;color:#00001a"></h1>
                                          <h2 style="margin-top: 0;color:#00001a">Welcome</h2>
                                          <h3 style="margin-top: 0;color:#00001a">User HomePage</h3>
                                      </center>
                                  </div>


                                  <div class="bhoechie-tab-content">
                                      <center>
                                          <h1 class="glyphicon glyphicon-tasks" style="font-size:12em;color:#00001a"></h1>
                                          <h2 style="margin-top: 0;color:#00001a"><a href="" class="btn btn-sm btn-primary btn-block" role="button">Schedule</a></h2>
                                          <h3 style="margin-top: 0;color:#00001a">My Schedule</h3>
                                      </center>
                                  </div>


                                  <div class="bhoechie-tab-content" id="#dos">
                                      <center>
                                          <h1 class="glyphicon glyphicon-transfer" style="font-size:12em;color:#00001a"></h1>
                                          <h2 style="margin-top: 0;color:#00001a"><a href="" class="btn btn-sm btn-primary btn-block" role="button">Trips</a></h2>
                                          <h3 style="margin-top: 0;color:#00001a">MY Trips </h3>
                                      </center>
                                  </div>

                                  <div class="bhoechie-tab-content">
                                      <center>
                                          <h1 class="glyphicon glyphicon-edit" style="font-size:12em;color:#00001a"></h1>
                                          <h2 style="margin-top: 0;color:#00001a"><a href="" class="btn btn-sm btn-primary btn-block" role="button">Edit</a></h2>
                                          <h3 style="margin-top: 0;color:#00001a">information Settings</h3>
                                      </center>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="modal-footer">
                  <input type="button" class="btn btn-danger" value="CANCELAR">
              </div>
          </div>
      </div>
  </div>
  <!-- End Scrolling Modal -->



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
  <script src="js/cambiosOvejas.js"></script>
  <script src="js/modal.js"></script>


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