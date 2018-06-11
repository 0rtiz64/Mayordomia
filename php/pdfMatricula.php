<?php
include '../gold/enlace.php';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;


$PromCorderitos=$_POST["phpPromoCordero"];
$EstadoCivil=$_POST["phpEstadoCivil"];
$Genero=$_POST["phpGenero"];
$Transporte=$_POST["phpTransporte"];
$Identidad=$_POST["phpIdentidad"];
$Nombre=$_POST["phpNombre"];
$ApeCasada=$_POST["phpApeCasada"];
$FechaCumpleanos=$_POST["phpFechaCumpleanos"];
$Tel1=$_POST["phpTel1"];
$Tel2=$_POST["phpTel2"];
$IntegradoRes=$_POST["phpIntegradoRes"];
$Areas=$_POST["phpAreas"];
$Direccion=$_POST["phpDireccion"];
$Id= $_POST["phpId"];
$fechaentrada = date('Y-m-d');
$NombreMayus = strtoupper($Nombre);



$queryPrueba = mysqli_query($enlace,"select nombre_integrante from integrantes
where idintegrante = $Id");

$dato= mysqli_fetch_array($queryPrueba,MYSQLI_ASSOC);

echo $dato["nombre_integrante "];
/*



if($fechaentrada ==""){
    $fecha ="CAMPO VACIO";
}else{
    $fecha = $fechaentrada;
}
$nombre = $NombreMayus;

if($ApeCasada ==""){
    $apellido = "CAMPO VACIO";
}else{
    $apellido = $ApeCasada;
}
$identidad =$Identidad;


if($FechaCumpleanos == ""){
    $nacimiento ="CAMPO VACIO";
}else{
    $nacimiento = $FechaCumpleanos;
}

if ($Genero == 'M'){

    $genero=' <br>
    <label style="margin-left: 25px;">Masuculino <input type="checkbox" checked></label>
    <label style="margin-left: 35px;">Femenino <input type="checkbox"></label>
   ';
}else{
    $genero=' <br>
    <label style="margin-left: 25px;">Masuculino <input type="checkbox" ></label>
    <label style="margin-left: 35px;">Femenino <input type="checkbox" checked></label> ';
}
$telefono1 =$Tel1;

if($resultados["tel"] ==""){
    $telefono2 ="CAMPO VACIO";
}else{
    $telefono2 =$Tel2;
}



if ($EstadoCivil == "Casado"){
    $civil ='
    <p style="margin-left: 4px;margin-top: 28px">Estado Civil: 
  <label>Soltero(a) <input type="checkbox" ></label> 
  <label style="float: right;margin-left: 185px;margin-top:-22px;" >Casado(a) <input type="checkbox" checked></label>
  <label style="float: right;margin-left: 285px;margin-top:-22px;" >Union Libre <input type="checkbox"></label>
  <label style="float: right;margin-left: 405px;margin-top:-22px;"> Divorciado(a) <input type="checkbox"></label>
  </p>
    ';
}elseif ($EstadoCivil == "Soltero"){
    $civil ='
    <p style="margin-left: 4px;margin-top: 28px">Estado Civil: 
  <label>Soltero(a) <input type="checkbox" checked></label> 
  <label style="float: right;margin-left: 185px;margin-top:-22px;" >Casado(a) <input type="checkbox"></label>
  <label style="float: right;margin-left: 285px;margin-top:-22px;" >Union Libre <input type="checkbox"></label>
  <label style="float: right;margin-left: 405px;margin-top:-22px;"> Divorciado(a) <input type="checkbox"></label>
  </p>
    ';
}elseif ($EstadoCivil == "Divorciado"){
    $civil ='
    <p style="margin-left: 4px;margin-top: 28px">Estado Civil: 
  <label>Soltero(a) <input type="checkbox" ></label> 
  <label style="float: right;margin-left: 185px;margin-top:-22px;" >Casado(a) <input type="checkbox"></label>
  <label style="float: right;margin-left: 285px;margin-top:-22px;" >Union Libre <input type="checkbox"></label>
  <label style="float: right;margin-left: 405px;margin-top:-22px;" > Divorciado(a) <input type="checkbox" checked></label>
  </p>
    ';
}elseif ($EstadoCivil == "Union"){
    $civil ='
    <p style="margin-left: 4px;margin-top: 28px">Estado Civil: 
  <label>Soltero(a) <input type="checkbox" ></label> 
  <label style="float: right;margin-left: 185px;margin-top:-22px;" >Casado(a) <input type="checkbox"></label>
  <label style="float: right;margin-left: 285px;margin-top:-22px;" >Union Libre <input type="checkbox" checked></label>
  <label style="float: right;margin-left: 405px;margin-top:-22px;" > Divorciado(a) <input type="checkbox"></label>
  </p>
    ';
}elseif ($EstadoCivil == ""){
    $civil ='
    <p style="margin-left: 4px;margin-top: 28px">Estado Civil: 
  <label>Soltero(a) <input type="checkbox" ></label> 
  <label style="float: right;margin-left: 185px;margin-top:-22px;" >Casado(a) <input type="checkbox"></label>
  <label style="float: right;margin-left: 285px;margin-top:-22px;" >Union Libre <input type="checkbox" ></label>
  <label style="float: right;margin-left: 405px;margin-top:-22px;" > Divorciado(a) <input type="checkbox"></label>
  </p>
    ';
};


if($Transporte =="Si"){
    $transporte ='
            <p style="font-size: 12px;margin-left: 5px"><strong>Necesita Transpsorte</strong></p>
        <p>
        <label style="font-size: 16px">Si<input type="checkbox" checked></label>
        <label style=" float: right; font-size: 16px; margin-left: 75px; margin-top:-22px;">No <input type="checkbox"  ></label>
        </p>
    ';
}elseif ($Transporte =="No"){
    $transporte ='
            <p style="font-size: 12px;margin-left: 5px"><strong>Necesita Transpsorte</strong></p>
        <p>
        <label style="font-size: 16px">Si<input type="checkbox" ></label>
        <label style=" float: right; font-size: 16px; margin-left: 75px; margin-top:-22px;">No <input type="checkbox" checked ></label>
        </p>
    ';
}elseif ($Transporte ==""){
    $transporte ='
            <p style="font-size: 12px;margin-left: 5px"><strong>Necesita Transpsorte</strong></p>
        <p>
        <label style="font-size: 16px">Si<input type="checkbox" ></label>
        <label style=" float: right; font-size: 16px; margin-left: 75px; margin-top:-22px;">No <input type="checkbox"  ></label>
        </p>
    ';
};


$direccion= $Direccion;


if($Areas ==""){
    $integrado= '
         <p style="margin-left: 15px" >¿Esta integrado?
        <label style="font-size: 16px; margin-left: 20px">Si<input type="checkbox" ></label>
        <label style=" float: right; font-size: 16px; margin-left: 175px; margin-top:-22px;">No <input type="checkbox"checked ></label>
      </p>
    ';

    $areas = "CAMPO VACIO";
}else{

    $integrado= '
         <p style="margin-left: 15px" >¿Esta integrado?
        <label style="font-size: 16px; margin-left: 20px">Si<input type="checkbox"checked ></label>
        <label style=" float: right; font-size: 16px; margin-left: 175px; margin-top:-22px;">No <input type="checkbox" ></label>
      </p>
    ';

    $areas =$Areas;
}




$Contenido = '
    <div style="text-align: right; font-size: 30px;color: red">'.$Id.' </div>
 
 <table>
    <tr>
        <td><img src="../myfiles/img/logo2.png" width="70" height="70"></td>    
        <td><h2>FICHA DE INSCRIPCION</h2></td>    
        <td><img src="../myfiles/img/logo.png" width="70" height="70"></td>    
    </tr>
    
    <tr>
        <td colspan="3">Promocion de Mayordomia #'.$resultadosPromocion["num_promocion"].' Promocion de Cordero que se graduo #'.$resultados["promo_cordero"].' </td>
    </tr>
</table>

<div>
    
    <p style="margin-left: 578px;margin-top: -93px;position: absolute;font-size: 16px; width: 120px; height: 140px;border: 1px solid green; border-radius: 50%; text-align: center;">FOTO</p>
</div>
<br>
<!--FECHA INSCRIPCION-->
<div style="border: 1px solid green; width: 550px;  border-radius: 30px; font-size: 16px; margin-top: -10px">
    <p align="center" style="margin-bottom: -10px"> '.$fecha.'</p>
    <p align="center" style="margin-top: -25px">  ____________________________________________________________________</p>
    <p align="center" style="font-size: 14px">Fecha de Inscripcion</p>
</div>
<!--FIN FECHA INSCRIPCION-->
<br>
<!--NOMBRE  COMPLETO APELLIDO CASADA-->
<div style="border: 1px solid green;  border-radius: 30px;font-size: 16px; margin-top: -15px; width: 450px; float: left">
    
    <p align="center" style="margin-bottom: -15px; margin-right: 45px;"> '.$nombre.'</p>
    <p align="center" style="margin-top: -35px">  _________________________________________________</p>
    <p style="font-size: 14px;margin-top: -70%" align="center">Nombre Completo</p>
 </div>
 <!--FIN NOMBRE  COMPLETO APELLIDO CASADA-->
 
 <div style="border: 1px solid green;  border-radius: 30px;font-size: 16px; width:250px; float: right; margin-top: -15px">
    <p align="center" style="margin-bottom: -55px;"> '.$apellido.'</p>
    <p align="center" style="margin-top: -10px">  __________________________</p>
    <p style="font-size: 14px;margin-bottom: 10px" align="center">Apellido Casada</p>
</div>   

 <br>
 <br>
 <br>
 <br>
 <br>
 <!--NUMERO DE INDENTIDAD-->
 
 <div style="border: 1px solid green;  border-radius: 30px;font-size: 16px; width:250px; float: left;margin-top: -13px">
    <p align="center" style="margin-bottom: -55px;"> '.$identidad.'</p>
    <p align="center" style="margin-top: -10px">  __________________________</p>
    <p style="font-size: 14px;margin-bottom: 10px" align="center">Numero de Identidad</p>
</div>   
<!--FIN NUMERO DE INDENTIDAD-->


<!--FECHA DE NACIMIENTO-->
 <div style="border: 1px solid green;  border-radius: 30px;font-size: 16px; width:250px; float: right; margin-right: 210px;margin-top: -13px">
    <p align="center" style="margin-bottom: -55px;"> '.$nacimiento.'</p>
    <p align="center" style="margin-top: -10px">  __________________________</p>
    <p style="font-size: 14px;margin-bottom: 10px" align="center">Fecha de Nacimiento</p>
</div>   
<!--FIN FECHA DE NACIMIENTO-->

<!--GENERO-->
<div style="border: 1px solid green;  border-radius: 35px;font-size: 16px; width:150px; height: 100px;float: left; margin-top:150px; margin-left: 300px; margin-top: 25px" >
    '.$genero.'
</div> 
<!--FIN GENERO-->

<!--TELEFONO 1-->
 <div style="border: 1px solid green;  border-radius: 30px;font-size: 16px; width:250px; float: left; margin-left: -250px; margin-top: 85px">
    <p align="center" style="margin-bottom: -55px;"> '.$telefono1.'</p>
    <p align="center" style="margin-top: -10px">  __________________________</p>
    <p style="font-size: 14px;margin-bottom: 10px" align="center">Telefono 1</p>
</div>   
<!--FIN TELEFONO 1-->

<!--TELEFONO 2-->
 <div style="border: 1px solid green;  border-radius: 30px;font-size: 16px; width:250px; float: left; margin-left: -440px; margin-top: 85px">
    <p align="center" style="margin-bottom: -55px;"> '.$telefono2.'</p>
    <p align="center" style="margin-top: -10px">  __________________________</p>
    <p style="font-size: 14px;margin-bottom: 10px" align="center">Telefono 2</p>
</div>   
<!--FIN TELEFONO 2-->

<!--ESTADO CIVIL-->
 <div style="border: 1px solid green;  border-radius: 30px;font-size: 16px; width:525px; float: left; margin-left: -515px; margin-top: 180px">
'.$civil.'  
</div>
<!--FIN ESTADO CIVIL-->   

<!--TRANSPORTE-->
    <div  style="border: 1px solid green;  border-radius: 30px; margin-top: 165px;margin-left: 555px;width:150px; height: 100px;">
       '.$transporte.'
    </div>
<!--TRANSPORTE-->

<!--DIRECCION-->
<div style="border: 1px solid green;  border-radius: 30px;font-size: 16px;margin-top: 5px">
    <p style="margin-left: 10px">Direccion:</p>
    <p align="right" style="margin-bottom: -15px; margin-right: 90px;"> <a style="margin-right: 300px;">'.$direccion.'</a></p>
    <p align="center" style="margin-top: -25px">  ________________________________________________________________________________</p>
    
 </div>
 <!--FIN DIRECCION-->
 
<div style=" border:  1px solid green; border-radius: 30px; width: 400px; float: right; margin-top: 10px; margin-right: 0px">
 <p align="center" style="margin-bottom: -55px;"> '.$areas.'</p>
    <p align="center" style="margin-top: -10px">  ___________________________________________</p>
    <p style="font-size: 14px;margin-bottom: 10px" align="center">Areas</p>
</div>

 <div style="border: 1px solid green; border-radius: 30px; font-size: 16px; float: left; margin-top: -0px; width: 300px;">
   '.$integrado.'
</div>




<!--FIRMA-->
   <div  style="  border-radius: 30px;font-size: 16px; width:250px; float: right; margin-right: -320px; margin-top: 123px">
    
    <p align="center" style="margin-top: -10px; margin-top: 25px">  __________________________</p>
    <p style="font-size: 14px;margin-top: 15px" align="center">Nombre del Equipo de Mayordomia</p>
</div>  
<!--FIN FIRMA-->
<!--FIRMA-->
 <div  style="  border-radius: 30px;font-size: 16px; width:250px; float: left; margin-left: -285px; margin-top: 120px">
    
    <p align="center" style="margin-top: -10px; margin-top: 25px">  __________________________</p>
    <p style="font-size: 14px;margin-top: 15px" align="center">Nombre del Hno(a) de Mayordomia</p>
</div>   





<!--FIN FIRMA-->

 ';


$dompdf = new DOMPDF();
$dompdf->load_html($Contenido);
$dompdf->render();
//$dompdf->stream("mi_archivo.pdf");3
$dompdf->stream("mi_archivo.pdf",array('Attachment'=>0));*/
?>