<?php
session_start();
if (isset($_SESSION['ingreso']) && $_SESSION['ingreso']=='YES')
{?>
<?php
include 'php/noCache.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MAYORDOMIA </title>

    <!-- Bootstrap core CSS -->
    <link href="resMarcacionAuto/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="resMarcacionAuto/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="resMarcacionAuto/vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="resMarcacionAuto/css/freelancer.min.css" rel="stylesheet">


    <!--ALERTIFY INICIO-->
    <link rel="stylesheet" href="alertify/css/alertify.css">
    <link rel="stylesheet" href="alertify/css/themes/bootstrap.css">
    <!--ALERTIFY FIN-->


</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">MARCACION AUTOMATICA</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"  onclick='cerrar();'>Salir</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Header -->
<header class="masthead bg-primary text-white text-center">
    <div class="container">
        <img class="img-fluid mb-5 d-block mx-auto" src="myfiles/img/logoBlanco.png" alt="">
        <form>
            <div class="col-md-12" align="center" style="margin-top: -5%">
                <input  type="text" id="marcacionProvicionalInput" class="form-control col-md-3" placeholder="MARCACION AUTOMATICA" autofocus>
            </div>
            <input type="submit" class="btn btn-success collapse" onclick="marcacionProvicionalAuto()">
        </form>
        <!--h1 class="text-uppercase mb-0">Start Bootstrap</h1-->
        <div id="tablaDatos"></div>
        <hr class="star-light">
        <h2 class="font-weight-light mb-0">YO Y MI CASA SERVIREMOS AL SEÑOR. JOSUE 24:15</h2>
    </div>
</header>
<div class="copyright py-4 text-center text-white">
    <div class="container">
        <small>Copyright &copy; MAYORDOMIA 2019</small>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="resMarcacionAuto/vendor/jquery/jquery.min.js"></script>
<script src="resMarcacionAuto/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="resMarcacionAuto/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="resMarcacionAuto/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Contact Form JavaScript -->
<script src="resMarcacionAuto/js/jqBootstrapValidation.js"></script>
<script src="resMarcacionAuto/js/contact_me.js"></script>

<!-- Custom scripts for this template -->
<script src="resMarcacionAuto/js/freelancer.min.js"></script>
<script src="myfiles/js/jquery-3.2.1.min%20(2).js"></script>
<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="alertify/alertify.js"></script>
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
<script src="js/marcaciones.js"></script>

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