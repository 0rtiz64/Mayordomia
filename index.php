<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

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


    <!-- Feature detection -->
    <script src="assets/js/modernizr-2.6.2.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
    
        <script src="js/jquery.js"></script>

    <style>
        .errores1{
    margin: 10px;
    width: 250px;
    padding: 5px;
    background-color: #000;
    color: red;
    display: none;
    border-radius: 50px;
}
    </style>
</head>

<body>
    <section id="login-container">

        <div class="row">
            <div class="col-md-3" id="login-wrapper">
                <div class="panel panel-primary animated flipInY">
                    <div class="panel-heading">
                        <h3 class="panel-title">     
                           MAYORDOMIA
                        </h3>      
                    </div>
                    <div class="panel-body">
                       <p> Ingresa para acceder a su cuenta.</p>
                        <form class="form-horizontal" >
                            <div class="form-group">
                                <div class="col-md-12"> 
                                    <?php 
                                        include 'gold/enlace.php';

                                        $query = mysqli_query($enlace,"SELECT idAccesos,nombre FROM accesos where estado=1");

                            echo "<select class='form-control' name='prmo' id='promo' >";
                                                
                                echo "<option value='' align='center'>  USUARIO</option>";
                                    while( $row = mysqli_fetch_array( $query, MYSQLI_ASSOC) ) {
                                        echo "<option value='".$row['idAccesos']."'>".$row['nombre']."</option>";
                                                                }

                                                            mysqli_free_result($query);
                            echo "</select>";

                            echo "<div id='errorUser' class='errores1'></div>";
                             ?>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                               <div class="col-md-12">
                                    <input type="password" class="form-control" id="password" placeholder="Contraseña">
                                    <i class="fa fa-lock"></i>
                                    <div id='errorContra' class='errores1'></div>
                                </div>
                                
                            </div>
                            <div class="form-group">
                               <div class="col-md-12">
                <input type="submit
                " class="btn btn-primary btn-block" onclick="confirmar()" value="Ingresar">
                                    
                                    <hr />
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!--Global JS-->

    <script src="assets/js/jquery-1.10.2.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/waypoints/waypoints.min.js"></script>
    <script src="assets/plugins/nanoScroller/jquery.nanoscroller.min.js"></script>
    <script src="assets/js/application.js"></script>
           <script>

            $(document).ready(function(){

                    $("#password").on('keyup', function (e) {
                            if (e.keyCode == 13) {
        // Do something         
                                var email = document.getElementById("promo").value;
            var password = $('#password').val();

            if(email.trim().length == ""){
            $('#errorUser').html('Selecciona el usuario.').slideDown(500);
            return false;
        }else{
            $('#errorUser').html('').slideUp(300);
            if(password.trim().length == ""){
                    $('#errorContra').html('Ingresa la Contraseña.').slideDown(500);
                    $('#password').focus();
                    return false;
            }else{
                $('#errorContra').html('').slideUp(300);
            }
        }

            $.ajax({
                url:'php/ingreso.php',
                type:'POST',
                data:'email='+email+'&password='+password+"&boton=ingresar"
            }).done(function(resp){
                if(resp=='0'){
                    $('#password').val("");
                    $('#errorContra').html('Contraseña Incorrecta.').slideDown(500);
                    $('#password').focus();
                }else if(resp=='1'){
                    location.href='marca_automatica.php';
                }    
                else{
                    location.href=resp;
                }
            });
                            }
                        });


                    //pasar focus

                    $('#prmo').change(function(){
                            var id = $("#prmo").val();
                            alert('Hola Hizo cambio...' + id);
                        });

                    $("select[name=prmo]").change(function(){
                        //alert($('select[name=color1]').val());
                        //$('input[name=valor1]').val($(this).val());
                        var select = $('select[name=prmo]').val();
                        if(select.trim().length == ""){

                        }else{
                            $('#password').focus();
                        }
                    });

                    //fin pasar focus

                });//FIN DE DOCUMENT


        

        function confirmar(){

            var email = document.getElementById("promo").value;
            var password = $('#password').val();

            if(email.trim().length == ""){
            $('#errorUser').html('Selecciona el usuario.').slideDown(500);
            return false;
        }else{
            $('#errorUser').html('').slideUp(300);
            if(password.trim().length == ""){
                    $('#errorContra').html('Ingresa la Contraseña.').slideDown(500);
                    $('#password').focus();
                    return false;
            }else{
                $('#errorContra').html('').slideUp(300);
            }
        }

            $.ajax({
                url:'php/ingreso.php',
                type:'POST',
                data:'email='+email+'&password='+password+"&boton=ingresar"
            }).done(function(resp){
                if(resp=='0'){
                    $('#password').val("");
                    $('#errorContra').html('Contraseña Incorrecta.').slideDown(500);
                    $('#password').focus();
                }else if(resp=='1'){
                    location.href='marca_automatica.php';
                }    
                else{
                    location.href=resp;
                }
            });
        }

</script>
</body>

</html>
