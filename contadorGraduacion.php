<?php
/**
 * Created by PhpStorm.
 * User: David Ortiz
 * Date: 14/11/2018
 * Time: 9:16 AM
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

      <style type="text/css">
          body {
              font-family: 'Varela Round', sans-serif;
          }
          .modal-confirm {
              color: #636363;
              width: 400px;
          }
          .modal-confirm .modal-content {
              padding: 20px;
              border-radius: 5px;
              border: none;
              text-align: center;
              font-size: 14px;
          }
          .modal-confirm .modal-header {
              border-bottom: none;
              position: relative;
          }
          .modal-confirm h4 {
              text-align: center;
              font-size: 26px;
              margin: 30px 0 -10px;
          }
          .modal-confirm .close {
              position: absolute;
              top: -5px;
              right: -2px;
          }
          .modal-confirm .modal-body {
              color: #999;
          }
          .modal-confirm .modal-footer {
              border: none;
              text-align: center;
              border-radius: 5px;
              font-size: 13px;
              padding: 10px 15px 25px;
          }
          .modal-confirm .modal-footer a {
              color: #999;
          }
          .modal-confirm .icon-box {
              width: 80px;
              height: 80px;
              margin: 0 auto;
              border-radius: 50%;
              z-index: 9;
              text-align: center;
              border: 3px solid #f15e5e;
          }
          .modal-confirm .icon-box i {
              color: #f15e5e;
              font-size: 46px;
              display: inline-block;
              margin-top: 13px;
          }
          .modal-confirm .btn {
              color: #fff;
              border-radius: 4px;
              background: #60c7c1;
              text-decoration: none;
              transition: all 0.4s;
              line-height: normal;
              min-width: 120px;
              border: none;
              min-height: 40px;
              border-radius: 3px;
              margin: 0 5px;
              outline: none !important;
          }
          .modal-confirm .btn-info {
              background: #c1c1c1;
          }
          .modal-confirm .btn-info:hover, .modal-confirm .btn-info:focus {
              background: #a8a8a8;
          }
          .modal-confirm .btn-danger {
              background: #f15e5e;
          }
          .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
              background: #ee3535;
          }
          .trigger-btn {
              display: inline-block;
              margin: 100px auto;
          }
      </style>


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
                  $focusMenu = "M8";
                  $focusSubMenu = "SM8.2";
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
                      <div class="col-md-12 form-group">
                          <div class="col-md-7">
                              <h1 class="h1" >ENTREGA DE TOGAS Y BIRRETES </h1>
                          </div>

                          <!--span class="label label-danger pull-right inbox-notification">83</span-->
                      </div>

                      <div class="col-md-12">

                          <div class="col-md-10 col-sm-10 col-xs-10 form-group">
                              <input type="password" class="form-control" placeholder="LEER TAG" id="inputTagGraduacion">
                              <input type="submit" class="btn btn-success collapse" onclick="contadorGraduacion(); ">
                          </div>
                          <div class="col-md-2 col-sm-2 col-xs-2" id="contadorVisible">

                          </div>


                          <div class="col-md-12" id="divResultados"></div>


                      </div>

              </section>
          </section>
      </form>
      <!--main content end-->

      <div id="modalConfirm" class="modal fade">
          <div class="modal-dialog modal-confirm">
              <div class="modal-content">
                  <div class="modal-header">
                      <div class="icon-box">
                          <i class="fa fa-info-circle"></i>
                      </div>
                      <h4 class="modal-title">¿CUANTAS TOGAS SERAN DEVUELTAS?</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  </div>
                  <div class="modal-body">
                      <input type="number" min="0" class="form-control" placeholder="CANTIDAD DE TOGAS A DEVOLVER" id="togasDevolver">
                  </div>
                  <div class="modal-footer">
                      <input type="hidden" id="inpDev">
                      <button type="button" class="btn btn-info" data-dismiss="modal">CANCELAR</button>
                      <button type="button" class="btn" style="background: #416AA6" onclick="devolver();" id="btnDevTg" >DEVOLVER</button>
                  </div>
              </div>
          </div>
      </div>

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
  <script src="js/contadorGradudacion.js"></script>



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