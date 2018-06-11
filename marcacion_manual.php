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
    <title>Marcacion Manual</title>
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
     <script src="assets/js/modernizr-2.6.2.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery.js"></script>

    <script src="js/validar.js"></script>

    
    
    <style>
            
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
                <button type="button" class="btn btn-default" id="toggle-left" data-toggle="tooltip" data-placement="right" title="Toggle Navigation">
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
            $focusMenu = "M1";
            $focusSubMenu = "SM1.2";
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
                                                MARCACION<small>  MANUAL...</small>
                                            </h1>
                           <div class="col-sm-12">
                <div class="pull-right"><button type="button" id="sharedPerson" class="btn btn-primary">Buscar</button></div>
                           </div>
                    </div>


                </div> <!-- ROW -->

                <div class="col-sm-10">
                    <div id="RegistroExitoso"></div>
                </div>
                        <div class="col-sm-12">
                            <form class="form-horizontal" id="formulario">

                                <div class="form-group">
                                    
                                    <label for="pwd">Numero de Identidad:</label>
                <input type="text" class="form-control" id="num_identidad" placeholder="Ejemplo: 1708199200377" >
                                    

                                </div>
                                    <input type="submit" class="btn btn-info" value="Marcar" onclick="BuscarPersona()">


                            </form>
                        </div>


<div class="col-sm-12">
    <div id="agrega-registros"></div>
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
    <div class="modal fade" id="scrollingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Busqueda Manual</h4>
                </div>
                <div class="modal-body modal-scroll">
                    <div class="form-group">
                            <label for="InputNameLabel">Nombre</label>
    <input type="text" style="text-transform: uppercase;" class="form-control" id="ModalInputName" placeholder="Ejemplo : Denny Molina" autofocus>
                    </div>
                    
                    <div id="agrega-personas"></div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    
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