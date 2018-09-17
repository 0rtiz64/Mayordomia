<?php
include '../gold/enlace.php';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;


$ficha =$_GET["numero"];


$queryIntegrante = mysqli_query($enlace, "Select idServidor,promo_cordero,num_identidad,nombre_integrante,fecha_cumple,cel,tel,
estado_civil,sexo,trasporte,direccion,areas,CAST(fecha_registro AS DATE) AS REGISTRO,apellidoCasada,correlativo
 from servidores
WHERE servidores.idServidor='".$ficha."'");
$resultados =  mysqli_fetch_array($queryIntegrante,MYSQLI_ASSOC);

//INICIO RUTA IMAGEN
$rutaImg1="../Servidores/Fotos/";
$finRuta=".jpg";
$identidad =$resultados["num_identidad"];
$rutaImg2=$rutaImg1.$identidad.$finRuta;
//FIN RUTA IMAGEN

if(file_exists($rutaImg2)){
    $foto='<p style="margin-left: 578px;margin-top: -93px;position: absolute;font-size: 16px; width: 120px; height: 140px;border: 1px solid green; border-radius: 50%; text-align: center;">
    <img src="'.$rutaImg2.'" style="width: 110px; height: 135px">
    </p>';
}else{
    $foto='<p style="margin-left: 578px;margin-top: -93px;position: absolute;font-size: 16px; width: 120px; height: 140px;border: 1px solid green; border-radius: 50%; text-align: center;">
     <p style="margin-left: 578px;margin-top: -93px;position: absolute;font-size: 16px; width: 120px; height: 140px;border: 1px solid green; border-radius: 50%; text-align: center;">FOTO</p>
    </p>';
}

//INICIO RUTA IMAGEN
$inicioRuta="../Servidores/Identidad/";
$finalRuta=".jpg";
$identidad =$resultados["num_identidad"];
$rutaFinal=$inicioRuta.$identidad.$finalRuta;
//FIN RUTA IMAGEN

if(file_exists($rutaFinal)){
    $foto2='<p style="margin-left: 578px;margin-top: -93px;position: absolute;font-size: 16px; width: 120px; height: 140px;border: 1px solid green; border-radius: 50%; text-align: center;">
   
    <img src="'.$rutaFinal.'" style="width:710px; height: 335px">
    </p>';
}else{
    $foto2='';
}




$queryPromocion = mysqli_query($enlace, "Select num_promocion from promociones
WHERE `status` = 1");
$resultadosPromocion = mysqli_fetch_array($queryPromocion, MYSQLI_ASSOC);

$corr =$resultados["correlativo"];

if($resultados["REGISTRO"] ==""){
    $fCompleta =".";
}else{
    $fecha = $resultados["REGISTRO"];

//FUNCTION FECHA
    /* function nombremes($mes){
         setlocale(LC_TIME, 'spanish');
         $nombre=strftime("%B",mktime(0, 0, 0, $mes, 0, 2000));
         return ucwords($nombre);
     }*/

    $dia = substr($fecha,8,2);
    $mes = substr($fecha,5,2);
    $aaa = substr($fecha,0,4);

    switch ($mes){
        case 01:
            $miMes = "ENERO";
            break;

        case 02:
            $miMes = "FEBRERO";
            break;

        case 03:
            $miMes = "MARZO";
            break;

        case 04:
            $miMes = "ABRIL";
            break;

        case 05:
            $miMes = "MAYO";
            break;

        case 06:
            $miMes = "JUNIO";
            break;

        case 07:
            $miMes = "JULIO";
            break;

        case "08":
            $miMes = "AGOSTO";
            break;

        case "09":
            $miMes = "SEPTIEMBRE";
            break;

        case 10:
            $miMes = "OCTUBRE";
            break;

        case 11:
            $miMes = "NOVIEMBRE";
            break;

        case 12:
            $miMes = "DICIEMBRE";
            break;
    }


    $fCompleta = $dia."-".$miMes."-".$aaa;





}
if($resultados["nombre_integrante"] == ""){
    $nombre = "<a style='color: white'>.</a>";
}else{
    $nombre = $resultados["nombre_integrante"];
}




if($resultados["apellidoCasada"] ==""){
    $apellido = "<a style='color: white'>.</a>";
}else{
    $apellido = $resultados["apellidoCasada"];
}

if($resultados["num_identidad"] ==""){
$identidad="<a style='color: white'>.</a>";
}else{
    $identidad = $resultados["num_identidad"];
}


if($resultados["fecha_cumple"] == ""){
    $fCompletaN ="<a style='color: white'>.</a>";
}else{
    $nacimiento = $resultados["fecha_cumple"];

    $dia = substr($nacimiento,8,2);
    $mesN = substr($nacimiento,5,2);
    $aaa = substr($nacimiento,0,4);

    switch ($mesN){
        case 01:
            $miMesN = "ENERO";
            break;

        case 02:
            $miMesN= "FEBRERO";
            break;

        case 03:
            $miMesN= "MARZO";
            break;

        case 04:
            $miMesN= "ABRIL";
            break;

        case 05:
            $miMesN= "MAYO";
            break;

        case 06:
            $miMesN= "JUNIO";
            break;

        case 07:
            $miMesN= "JULIO";
            break;

        case "08":
            $miMesN= "AGOSTO";
            break;

        case "09":
            $miMesN= "SEPTIEMBRE";
            break;

        case 10:
            $miMesN= "OCTUBRE";
            break;

        case 11:
            $miMesN= "NOVIEMBRE";
            break;

        case 12:
            $miMesN= "DICIEMBRE";
            break;
    }


    $fCompletaN = $dia."-".$miMesN."-".$aaa;
}

if ($resultados["sexo"] == 'M'){

    $genero=' <br>
    <label style="margin-left: 25px;">Masculino <input type="checkbox" checked></label>
    <label style="margin-left: 35px;">Femenino <input type="checkbox"></label>
   ';
}else{
    $genero=' <br>
    <label style="margin-left: 25px;">Masculino <input type="checkbox" ></label>
    <label style="margin-left: 35px;">Femenino <input type="checkbox" checked></label> ';
}

if($resultados["cel"] ==""){
    $telefono1 = "<a style='color: white'>.</a>";
}else{
    $telefono1 = $resultados["cel"];
}


if($resultados["tel"] ==""){
    $telefono2 ="<a style='color: white'>.</a>";
}else{
    $telefono2 = $resultados["tel"];
}

if($resultados["promo_cordero"]==""){
    $promoCorederitos = "<a style='color: white'>.</a>";
}else{
    $promoCorederitos=$resultados["promo_cordero"];
}



if($resultados["estado_civil"] ==""){
    $civil1 = "<a style='color: white'>.</a>";
}else{
    $civil1 =$resultados["estado_civil"];
}


$civil= strtoupper($civil1);




if($resultados["trasporte"] =="Si"){
    $transporte ='
            <p style="font-size: 12px;margin-left: 5px"><strong>Necesita Transpsorte</strong></p>
        <p>
        <label style="font-size: 16px">Si<input type="checkbox" checked></label>
        <label style=" float: right; font-size: 16px; margin-left: 75px; margin-top:-22px;">No <input type="checkbox"  ></label>
        </p>
    ';
}elseif ($resultados["trasporte"] =="No"){
    $transporte ='
            <p style="font-size: 12px;margin-left: 5px"><strong>Necesita Transpsorte</strong></p>
        <p>
        <label style="font-size: 16px">Si<input type="checkbox" ></label>
        <label style=" float: right; font-size: 16px; margin-left: 75px; margin-top:-22px;">No <input type="checkbox" checked ></label>
        </p>
    ';
}elseif ($resultados["trasporte"] ==""){
    $transporte ='
            <p style="font-size: 12px;margin-left: 5px"><strong>Necesita Transpsorte</strong></p>
        <p>
        <label style="font-size: 16px">Si<input type="checkbox" ></label>
        <label style=" float: right; font-size: 16px; margin-left: 75px; margin-top:-22px;">No <input type="checkbox"  ></label>
        </p>
    ';
};


$direccion= $resultados["direccion"];
if($resultados["direccion"]==""){
    $direccion=   "<a style='color: white'>.</a><br><a style='color: white'>.</a><br><a style='color: white'>.</a>";
}else{
    $direccion= $resultados["direccion"];
}

if($resultados["areas"] ==""){
    $integrado= '
         <p style="margin-left: 15px" >¿Esta integrado?
        <label style="font-size: 16px; margin-left: 20px">Si<input type="checkbox" ></label>
        <label style=" float: right; font-size: 16px; margin-left: 175px; margin-top:-22px;">No <input type="checkbox"checked ></label>
      </p>
    ';

    $areas =  "<a style='color: white'>.</a><br><a style='color: white'>.</a><br><a style='color: white'>.</a>";
}else{

    $integrado= '
         <p sty le="margin-left: 15px" >¿Esta integrado?
        <label style="font-size: 16px; margin-left: 20px">Si<input type="checkbox"checked ></label>
        <label style=" float: right; font-size: 16px; margin-left: 175px; margin-top:-22px;">No <input type="checkbox" ></label>
      </p>
    ';

    $areas =$resultados["areas"];
}




$Contenido = '
    <div style="text-align: right; font-size: 30px;color: red; margin-right:40px; margin-top: -40px ">'.$corr.' </div>

 <table width="80%" style="margin-top: -10px">
    <tr align="center">
        <td><img src="../myfiles/img/logo2.png" width="70" height="70"></td>    
        <td><h2>MAYORDOMIA</h2></td>    
        <td><img src="../myfiles/img/logo.png" width="70" height="70"></td>    
    </tr>
    
    <tr align="center">
        <td colspan="3">FICHA DE SERVIDOR </td>
    </tr>
</table>

<div style="margin-top:-50px ;">
    
   '.$foto.'
</div>
<br>
<br>
<br>
<br>
<!--FECHA INSCRIPCION-->

<div style="border: 1px solid green; width: 500px;  border-radius: 30px; font-size: 16px; margin-top: -10px; float: left">
    <p align="center" style="margin-bottom: -10px"> '.$nombre.'</p>
    <p align="center" style="margin-top: -25px">  __________________________________________________________</p>
    <p align="center" style="font-size: 14px">Nombre</p>
</div>

 
 <div style="border: 1px solid green;  border-radius: 30px;font-size: 16px; width:250px; float: left; margin-top: -10px; margin-left: 10px">
    <p align="center" style="margin-bottom: -55px;"> '.$apellido.'</p>
    <p align="center" style="margin-top: -10px">  __________________________</p>
    <p style="font-size: 14px;margin-bottom: 10px" align="center">Apellido Casada</p>
</div>   

 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <!--NUMERO DE INDENTIDAD-->
 
 <div style="border: 1px solid green;  border-radius: 30px;font-size: 16px; width:250px; float: left;margin-top: -15px">
    <p align="center" style="margin-bottom: -55px;"> '.$identidad.'</p>
    <p align="center" style="margin-top: -10px">  __________________________</p>
    <p style="font-size: 14px;margin-bottom: 10px" align="center">Numero de Identidad</p>
</div>   
<!--FIN NUMERO DE INDENTIDAD-->


<!--FECHA DE NACIMIENTO-->
 <div style="border: 1px solid green;  border-radius: 30px;font-size: 16px; width:250px; float: right; margin-right: 210px;margin-top: -15px">
    <p align="center" style="margin-bottom: -55px;"> '.$civil.'</p>
    <p align="center" style="margin-top: -10px">  __________________________</p>
    <p style="font-size: 14px;margin-bottom: 10px" align="center">Estado Civil</p>
</div>   
<!--FIN FECHA DE NACIMIENTO-->

<!--GENERO-->
<div style="border: 1px solid green;  border-radius: 35px;font-size: 16px; width:150px; height: 100px;float: left; margin-top:150px; margin-left: 300px; margin-top: -23px" >
      <p align="center" style="margin-bottom: -55px;"> '.$telefono1.'</p>
    <p align="center" style="margin-top: -10px">  ________________</p>
    <p style="font-size: 14px;margin-bottom: 10px" align="center">Telefono</p>
</div> 
<!--FIN GENERO-->


<!--DIRECCION-->
<div style="border: 1px solid green;  border-radius: 30px;font-size: 16px;margin-top: 85px">
    <p style="margin-left: 10px">Direccion:</p>
    <p align="left" style="margin-bottom: -15px; margin-right: 0px; font-size: 65%"> <a style="margin-left: 50px;">'.$direccion.'</a></p>
    <p align="center" style="margin-top: -25px">  ________________________________________________________________________________</p>
    
 </div>
 <!--FIN DIRECCION-->
 
<div style=" border:  1px solid green; border-radius: 30px; float: right; margin-top: 20px; margin-right: 0px">
 <p align="center" style="margin-bottom: -55px;"> '.$areas.'</p>
    <p align="center" style="margin-top: -10px">  ___________________________________________</p>
    <p style="font-size: 14px;margin-bottom: 10px" align="center">Otras Areas Donde Sirve</p>
</div>




 

 
 
 <div  style="margin-top: 200px;margin-left: -270px">
      '.$foto2.'
</div>



 ';

$dompdf = new DOMPDF();
$dompdf->load_html($Contenido);
$dompdf->render();
//$dompdf->stream("mi_archivo.pdf");3
$dompdf->stream("mi_archivo.pdf",array('Attachment'=>0));
?>