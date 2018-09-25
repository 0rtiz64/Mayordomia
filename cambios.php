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
    <title>CAMBIOS</title>
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

        <link rel="stylesheet" href="angular/angularEstilos.css">



        <script src="assets/js/modernizr-2.6.2.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->

    <script src="js/jquery.js"></script>
    <script src="js/validar.js"></script>
    <script src="js/cambios.js"></script>


    
    
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
                                                CAMBIOS ENLAZADOS
                                            </h1>
                                            <div class="form-group">
                                            <button class="btn btn-primary" style="float: right; margin-top: -6%" id="btnRegistrar">Registrar Nuevo <span class="fa fa-plus-square"></span></button>
                                            </div>

                                            
                           <div class="col-sm-12">
                <!-- <div class="pull-right"><button type="button" id="sharedPerson" class="btn btn-primary">Buscar</button></div> -->
                           </div>
                    </div>


                </div> <!-- ROW -->

                <div class="col-sm-10">
                    <div id="RegistroExitoso"></div>
                </div>
                        <div class="col-sm-12" style="margin-top: 3%">
                            

                                <div class="form-group">
                                    
                                    
                <input type="text" style="text-transform: uppercase;" class="form-control" id="nombreShared" placeholder="NOMBRE INTEGRANTE" >
                                    

                                </div>
                                <!--<input type="submit" class="btn btn-info" value="Marcar" onclick="NewBuscarPersona()"> -->
                                    
                            
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



       <!-- Inicia Modal Registrar -->
    <div class="modal fade" id="ModalRegistrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Registrar </h4>
                    
                    

                </div>
                <div class="modal-body">

                    <div class="col-md-12">
                        <div class="panel panel-default">

                            <div class="panel-body">
                                <div class="tab-wrapper tab-primary">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#home1" data-toggle="tab" id="tabRegistrar">Registrar</a>
                                        </li>
                                        <li><a href="#profile1" data-toggle="tab" id="tabEnlazar">Enlazar</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home1">
                                            <div class="form-group col-md-12">
                                                <input type="text" id="identidadCenso" class="form-control" min="0" placeholder="Buscar en Censo Nacional 2013">
                                            </div>

                                            <div class="form-group">
                                                <div id="cargar">

                                                </div>
                                            </div>



                                            <form class="form-horizontal" id="formularioRegistro" role="form">

                                                <div class="form-group">


                                                    <div class="col-lg-4" id="divIdIntegrante"></div>





                                                    <div class="col-lg-4" id="divCorderito">
                                                        <input type="number" style="text-transform: uppercase;" class="form-control" id="corderitosPromocionRegistrar" min="0" placeholder="Promocion de Corderitos">
                                                        <div id="alertPromocion" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Promocion Invalida</div>
                                                    </div>



                                                    <?php
                                                    require_once 'gold/enlace.php';

                                                    $queryPromocionActiva= mysqli_query($enlace, "select num_promocion from promociones WHERE `status`=1");

                                                    while ($fila = mysqli_fetch_array($queryPromocionActiva,MYSQLI_ASSOC)) {
                                                        echo'<div class="col-lg-4">';
                                                        echo '<input type="text" class="form-control" readonly="readonly" value="Promocion '.$fila['num_promocion'].' de Mayordomia">';
                                                        echo'</div>';
                                                    }
                                                    ?>
                                                </div>


                                                <div class="form-group">

                                                    <div class="col-lg-4" id="divCivil">
                                                        <select class="form-control" id="estadoCivilRegistrar">
                                                            <option value="">Estado Civil</option>
                                                            <option value="Casado">Casado</option>
                                                            <option value="Soltero">Soltero</option>
                                                            <option value="Divorciado">Divorciado</option>
                                                            <option value="Union">Union Libre</option>
                                                        </select>
                                                        <div id="alertEstado" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Estado Civil Invalido</div>

                                                    </div>

                                                    <div class="col-lg-4" id="divGenero">
                                                        <select id="generoRegistrar" class="form-control">
                                                            <option value="">Genero</option>
                                                            <option value="M">Masculino</option>
                                                            <option value="F">Femenino</option>
                                                        </select>
                                                        <div id="alertGenero" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Genero Invalido</div>
                                                    </div>

                                                    <div class="col-lg-4" id="divTransporte">
                                                        <select class="form-control" id="tranporteRegistrar">
                                                            <option value="">Necesita Transporte</option>
                                                            <option value="Si">Si</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                        <div id="alertTransporte" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Respuesta Invalida</div>
                                                    </div>
                                                </div>


                                                <div class="form-group">

                                                    <div class="col-lg-4" id="divIdentidad">
                                                        <input type="number" id="identidadRegistrar" class="form-control " min="0" placeholder="Identidad">
                                                        <div id="alertIdentidad" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Identidad Invalida</div>
                                                    </div>


                                                    <div class="col-lg-4" id="divNombre">
                                                        <input type="text" id="NombreRegistro" class="form-control" placeholder="Nombre Completo" style='text-transform:uppercase'>
                                                        <input type="text" id="ApellidoCasada" class="form-control collapse" placeholder="Apellido de Casada">
                                                        <div id="alertNombre" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Nombre Invalido</div>
                                                    </div>

                                                    <div class="col-lg-4" id="divFecha">
                                                        <div class="input-group">
                                                            <input type="date" id="fecha_cumpleRegistro" name="datarange" class="datepicker form-control" placeholder="Ejemplo:2017-09-25">
                                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                        </div>
                                                        <div id="alertFecha" style="background-color: #d9534f; color: white; border-radius: 4px" align="center" class="collapse">Fecha Invalida</div>
                                                    </div>
                                                </div>

                                                <div class="form-group" >
                                                    <div class="col-lg-4" id="divTelefono1">
                                                        <input type="number" class="form-control" id="telefono1Registrar" min="0" placeholder="Telefono 1">
                                                        <div id="alertTelefono1" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse  ">Telefono Invalido</div>
                                                    </div>

                                                    <div class="col-lg-4" id="divTelefono2">
                                                        <input type="number" class="form-control" id="telefono2Registrar" min="0" placeholder="Telefono 2">
                                                    </div>

                                                    <div class="col-lg-4" id="divIntegrado">
                                                        <select class="form-control" id="integradoRegistrar">
                                                            <option value="">Esta integrado</option>
                                                            <option value="Si">Si</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                        <div id="alertIntegrado" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse  ">Respuesta Invalida</div>
                                                    </div>
                                                </div>


                                                <div class="form-group collapse" id="areasRegistro">
                                                    <div class="col-lg-12">
                                                        <input type="text" class="form-control" placeholder="Areas de Servicio" id="areasRegistroText">
                                                    </div>
                                                </div>




                                                <div class="form-group">
                                                    <div class="col-md-12" id="divDireccion">
                                                        <textarea class="form-control" rows="3" id="direccionRegistrar" placeholder="Direccion"></textarea>
                                                        <div id="alertDireccion" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse  ">Direccion Invalida</div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>


                                        <div class="tab-pane" id="profile1">
                                            <form id="enlazarForm" class="form-horizontal">

                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" id="buscarEnlazar" placeholder="Buscar  Por Nombres" style="text-transform:uppercase;">
                                                    </div>


                                                </div>
                                    
                                                <div class="form-group">
                                                    <div  id="divIntegranteEnlazar">

                                                 <div id="alertIntegranteEnlazar" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Integrante Invalido</div>
                                             </div>

                                                    <div class="col-md-6" id="divequipoEnlazar" style="float: right">
                                                <select id="equipoSelect" class="form-control">
                                                    <option value=""> Seleccione Equipo</option>
                                                    <?php
                                                    require_once 'gold/enlace.php';

                                                    $querySelect= mysqli_query($enlace, "SELECT equipos.id_promocion,equipos.id_equipo,equipos.num_equipo,nombre_equipo from equipos 
INNER JOIN promociones ON equipos.id_promocion = promociones.idpromocion
WHERE promociones.`status`=1");

                                                    while ($fila = mysqli_fetch_array($querySelect,MYSQLI_ASSOC)) {
                                                        echo '<option  value="'.$fila['id_equipo'].'">'.$fila["num_equipo"].'. '.$fila["nombre_equipo"].'</option>';
                                                    }
                                                    ?>

                                                </select>
                                                    <div id="alertEquipoEnlazar" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Equipo Invalido</div>

                                                </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-6" id="divCargoEnlazar">
                                                <select id="cargoSelect" class="form-control">
                                                    <option value="">Seleccione Cargo</option>
                                                    <?php
                                                    require_once 'gold/enlace.php';

                                                    $querySelect= mysqli_query($enlace, "SELECT idcargo,nombre_cargo from cargos");

                                                    while ($fila = mysqli_fetch_array($querySelect,MYSQLI_ASSOC)) {

                                                        echo '<option  value="'.$fila['idcargo'].'">'.$fila["nombre_cargo"].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <div id="alertCargo" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Cargo Invalido</div>

                                            </div>
                                                    <div class="col-md-6" id="divEstadoEnlazar">
                                                <select id="estadoSelect" class="form-control">
                                                    <option value="">Seleccione Estado</option>
                                                    <option value="1">Activo</option>
                                                    <option value="3">Inactivo</option>
                                                    <option value="2">Retirado</option>
                                                </select>
                                                <div id="alertEstadoEnlazar" style="background-color: #D9534F; color: white; border-radius:4px" align="center" class="collapse">Estado Invalido</div>

                                            </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <input id="comentario" type="text" placeholder="Comentario"  class="form-control">

                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="alert alert-success alert-dismissable  collapse" id="guardado" align="center"><strong>Registro Guardado</strong></div>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="cerrarModalRegistrar">Cerrar</button>
                            <?php
                            $Querynumero=mysqli_query($enlace,"SELECT (idintegrante) AS orden FROM integrantes  
                            ORDER BY orden DESC limit 1");
                            $resultadoNumero =  mysqli_fetch_array($Querynumero,MYSQLI_ASSOC);
                            echo'<a class="btn btn-danger"  href="php/fichaInscripcion.php?numero='.$resultadoNumero["orden"].'" target="_blank" style="color:white;" id="PDF"> <span>Exportar A PDF</span> </a>';
                            ?>
                         <input type="submit" class="btn btn-info" onclick="guardarPersona()"; value="Registrar Integrante" id="Registrar">
                         <input type="submit" class="btn btn-info collapse" onclick="enlazarIntegrante()"; value="Enlazar Integrante" id="Enlazar">

                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Registrar -->






        <!-- Scrolling Modal -->
    <div class="modal fade" id="scrollingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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