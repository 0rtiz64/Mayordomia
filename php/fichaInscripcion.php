<?php 
include '../gold/enlace.php';
	require_once 'dompdf/autoload.inc.php';
 	use Dompdf\Dompdf;


$ficha =$_GET["numero"];


$queryIntegranteF = mysqli_query($enlace, "Select idintegrante,promo_cordero,num_identidad,nombre_integrante,fecha_cumple,cel,tel,
estado_civil,sexo,trasporte,direccion,areas,CAST(fecha_registro AS DATE) AS REGISTRO,apellidoCasada,correlativo,documentosPendientes
 from integrantes
WHERE integrantes.idintegrante='".$ficha."'");
$resultadosF=  mysqli_fetch_array($queryIntegranteF,MYSQLI_ASSOC);

//INICIO RUTA IMAGEN
$rutaImg1F="../Fotos/";
$finRutaF=".jpg";
$identidadF =$resultadosF["num_identidad"];
$rutaImg2F=$rutaImg1F.$identidadF.$finRutaF;
//FIN RUTA IMAGEN

if(file_exists($rutaImg2F)){
    $foto='<p style="margin-left: 578px;margin-top: -93px;position: absolute;font-size: 16px; width: 120px; height: 140px;border: 1px solid green; border-radius: 50%; text-align: center;">
    <img src="'.$rutaImg2F.'" style="width: 110px; height: 135px">
    </p>';
}else{
    $foto='<p style="margin-left: 578px;margin-top: -93px;position: absolute;font-size: 16px; width: 120px; height: 140px;border: 1px solid green; border-radius: 50%; text-align: center;">
     <p style="margin-left: 578px;margin-top: -93px;position: absolute;font-size: 16px; width: 120px; height: 140px;border: 1px solid green; border-radius: 50%; text-align: center;">FOTO</p>
    </p>';
}



$queryIntegrante = mysqli_query($enlace, "Select idintegrante,promo_cordero,num_identidad,nombre_integrante,fecha_cumple,cel,tel,
estado_civil,sexo,trasporte,direccion,areas,CAST(fecha_registro AS DATE) AS REGISTRO,apellidoCasada,correlativo,documentosPendientes,integrantes.bautizado,integrantes.registradoPor
 from integrantes
WHERE integrantes.idintegrante='".$ficha."'");
$resultados =  mysqli_fetch_array($queryIntegrante,MYSQLI_ASSOC);

$nombreRegistrado = $resultados["registradoPor"];
$bautizado = $resultados["bautizado"];
$queryPromocion = mysqli_query($enlace, "Select num_promocion from promociones
WHERE `status` = 1");
$resultadosPromocion = mysqli_fetch_array($queryPromocion, MYSQLI_ASSOC);

$corr =$resultados["correlativo"];


if($resultados["documentosPendientes"]==""){
    $documentosPendientes = "<a style='color: white'>.</a>";
}else{
    $documentosPendientes = $resultados["documentosPendientes"];
}



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
$nombre = $resultados["nombre_integrante"];

if($resultados["apellidoCasada"] ==""){
    $apellido = "<a style='color: white'>.</a>";
}else{
    $apellido = $resultados["apellidoCasada"];
}
$identidad = $resultados["num_identidad"];


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
$telefono1 = $resultados["cel"];

if($resultados["tel"] ==""){
    $telefono2 ="<a style='color: white'>.</a>";
}else{
    $telefono2 = $resultados["tel"];
}

if($resultados["promo_cordero"]==""){
    $promoCorederitos ="<a style='color: white'>.</a>";
}else{
    $promoCorederitos=$resultados["promo_cordero"];
}


if ($resultados["estado_civil"] == "Casado"){
    $civil ='
    <p style="margin-left: 4px;margin-top: 28px">
<label>Soltero(a) <input type="checkbox" ></label> 
  <label style="float: right;margin-left: 95px;margin-top:-22px;" >Casado(a) <input type="checkbox" checked></label>
  <label style="float: right;margin-left: 195px;margin-top:-22px;" >Union Libre <input type="checkbox" ></label>
  <label style="float: right;margin-left: 305px;margin-top:-22px;" > Divorciado(a) <input type="checkbox"></label>
  <label style="float: right;margin-left: 425px;margin-top:-22px;" > Viudo(a) <input type="checkbox"></label>

  </p>
    ';
}elseif ($resultados["estado_civil"] == "Soltero"){
    $civil ='
    <p style="margin-left: 4px;margin-top: 28px"> 
  <label>Soltero(a) <input type="checkbox" checked></label> 
  <label style="float: right;margin-left: 95px;margin-top:-22px;" >Casado(a) <input type="checkbox"></label>
  <label style="float: right;margin-left: 195px;margin-top:-22px;" >Union Libre <input type="checkbox" ></label>
  <label style="float: right;margin-left: 305px;margin-top:-22px;" > Divorciado(a) <input type="checkbox"></label>
  <label style="float: right;margin-left: 425px;margin-top:-22px;" > Viudo(a) <input type="checkbox"></label>
  </p>
    ';
}elseif ($resultados["estado_civil"] == "Divorciado"){
    $civil ='
    <p style="margin-left: 4px;margin-top: 28px"> 
  <label>Soltero(a) <input type="checkbox" ></label> 
 <label style="float: right;margin-left: 95px;margin-top:-22px;" >Casado(a) <input type="checkbox"></label>
  <label style="float: right;margin-left: 195px;margin-top:-22px;" >Union Libre <input type="checkbox" ></label>
  <label style="float: right;margin-left: 305px;margin-top:-22px;" > Divorciado(a) <input type="checkbox" checked></label>
  <label style="float: right;margin-left: 425px;margin-top:-22px;" > Viudo(a) <input type="checkbox"></label>
  </p>
    ';
}elseif ($resultados["estado_civil"] == "Union"){
    $civil ='
    <p style="margin-left: 4px;margin-top: 28px">
  <label>Soltero(a) <input type="checkbox" ></label> 
  <label style="float: right;margin-left: 95px;margin-top:-22px;" >Casado(a) <input type="checkbox"></label>
  <label style="float: right;margin-left: 195px;margin-top:-22px;" >Union Libre <input type="checkbox" checked></label>
  <label style="float: right;margin-left: 305px;margin-top:-22px;" > Divorciado(a) <input type="checkbox"></label>
  <label style="float: right;margin-left: 425px;margin-top:-22px;" > Viudo(a) <input type="checkbox"></label>
  </p>
    ';
}elseif ($resultados["estado_civil"] == ""){
    $civil ='
    <p style="margin-left: 4px;margin-top: 28px">
  <label>Soltero(a) <input type="checkbox" ></label> 
 <label style="float: right;margin-left: 95px;margin-top:-22px;" >Casado(a) <input type="checkbox"></label>
  <label style="float: right;margin-left: 195px;margin-top:-22px;" >Union Libre <input type="checkbox" ></label>
  <label style="float: right;margin-left: 305px;margin-top:-22px;" > Divorciado(a) <input type="checkbox"></label>
  <label style="float: right;margin-left: 425px;margin-top:-22px;" > Viudo(a) <input type="checkbox"></label>
  </p>
    ';
}elseif ($resultados["estado_civil"] == "Viudo"){
    $civil ='
    <p style="margin-left: 4px;margin-top: 28px">
  <label>Soltero(a) <input type="checkbox" ></label> 
 <label style="float: right;margin-left: 95px;margin-top:-22px;" >Casado(a) <input type="checkbox"></label>
  <label style="float: right;margin-left: 195px;margin-top:-22px;" >Union Libre <input type="checkbox" ></label>
  <label style="float: right;margin-left: 305px;margin-top:-22px;" > Divorciado(a) <input type="checkbox"></label>
  <label style="float: right;margin-left: 425px;margin-top:-22px;" > Viudo(a) <input type="checkbox" checked></label>
  </p>
    ';
};


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


if($resultados["areas"] ==""){
    $integrado= '
         <p style="margin-left: 15px" >¿Esta integrado?
        <label style="font-size: 16px; margin-left: 20px">Si<input type="checkbox" ></label>
        <label style=" float: right; font-size: 16px; margin-left: 175px; margin-top:-22px;">No <input type="checkbox"checked ></label>
      </p>
      
    ';

    $areas = "<a style='color: white'>.</a>";
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
    <div style="text-align: right; font-size: 30px;color: red; margin-right:25px ">'.$corr.' </div>

 <table>
    <tr>
        <td><img src="../myfiles/img/logo2.png" width="70" height="70"></td>    
        <td><h2>FICHA DE INSCRIPCION</h2></td>    
        <td><img src="../myfiles/img/logo.png" width="70" height="70"></td>    
    </tr>
    
    <tr>
        <td colspan="3" align="center">PROMOCION DE MAYORDOMIA N'.$resultadosPromocion["num_promocion"].' </td>
    </tr>
</table>

<div>
    '.$foto.'    
</div>
<br>
<div style="border: 1px solid green;  border-radius: 30px;font-size: 16px; width:250px; float: left;margin-top: -13px">
    <p align="center" style="margin-bottom: -55px;"> '.$fCompleta.'</p>
    <p align="center" style="margin-top: -10px">  __________________________</p>
    <p style="font-size: 14px;margin-bottom: 10px" align="center">Fecha de Inscripcion</p>
</div>   
<!--FIN NUMERO DE INDENTIDAD-->


<!--FECHA DE NACIMIENTO-->
 <div style="border: 1px solid green;  border-radius: 30px;font-size: 16px; width:250px; float: right; margin-right: 210px;margin-top: -13px">
    <p align="center" style="margin-bottom: -55px; margin-left: -5%"> '.$promoCorederitos.'  <a style="color: white">----------------------</a> '.$bautizado.' </p>
    <p align="center" style="margin-top: -10px;margin-left: -2%">  ____________ <a style="color: white">-------</a> ____________</p>
    <p style="font-size: 14px;margin-bottom: 10px;margin-left: -12%" align="center">Promocion Corderitos. <a style="color: white">----</a> Bautizado </p>
    
    
      
   
    
  
   
</div>   
<!--FIN FECHA DE NACIMIENTO-->
<br>
<br>
<br>
<br>
<br>
<!--NOMBRE  COMPLETO APELLIDO CASADA-->
<div style="border: 1px solid green;  border-radius: 30px;font-size: 16px; margin-top: -15px; width: 450px; float: left">
    
    <p align="center" style="margin-bottom: -15px; margin-right: 45px;"> '.utf8_encode($nombre).'</p>
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
    <p align="center" style="margin-bottom: -55px;"> '.$fCompletaN.'</p>
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
    <p style="margin-left: 10px">Informacion Adicional: <a style="font-size: 65%">'.$direccion.'</a></p>
      <p style="margin-left: 10px">Documentos: <a style="font-size: 65%">'.$documentosPendientes.'</a></p>
    
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

 <div style="font-size: 5px; float:left; margin-top: 150px; width: 300px;">

 <p style="font-size: 65%;">REGISTRADO POR: '.$nombreRegistrado.'</p>
</div>

 ';


//INICIO RUTA IMAGEN
$queryIdentidad= mysqli_query($enlace,"SELECT * from integrantes where  idintegrante =$ficha");
$dIdentidad = mysqli_fetch_array($queryIdentidad,MYSQLI_ASSOC);
$identidadD = $dIdentidad["num_identidad"];
$rutaImg1D="../documentos/";
$finRutaD1=".jpg";
$finRutaD2=".jpeg";

//$diploma=$rutaImg1D.$identidadD.$finRutaD;
$diploma=$rutaImg1D.$identidadD.$finRutaD1;
$diploma2=$rutaImg1D.$identidadD.$finRutaD2;
//FIN RUTA IMAGEN




if(file_exists($diploma)){
    $Contenido.='
    <br><br><br><br><br>
    <br><br><br><br><br>
   <div>
    <img src="'.$diploma.'" style="width: 750px; height: 900px">
   </div>
    ';
}else{
    if(file_exists($diploma2)){
        $Contenido.='
    <br><br><br><br><br>
    <br><br><br><br><br>
    <div>
    <img src="'.$diploma2.'" style="width: 750px; height: 900px">
    </div>  ';

    }else{
        $Contenido.='<p></p>';
    }
}





$queryIdentidad2= mysqli_query($enlace,"SELECT * from integrantes where  idintegrante =$ficha");
$dIdentidad2 = mysqli_fetch_array($queryIdentidad2,MYSQLI_ASSOC);
$identidadD2 = $dIdentidad2["num_identidad"];
$rutaImg1I="../documentos/";
$finRutaDI1=".jpg";
$finRutaDI2=".jpeg";


$identidades1=$rutaImg1I.$identidadD2."D".$finRutaDI1;
$identidades2=$rutaImg1I.$identidadD2."D".$finRutaDI2;
//FIN RUTA IMAGEN


if(file_exists($identidades1)){
    $Contenido.='
   <div>
    <img src="'.$identidades1.'" style="width: 750px; height: 900px">
   </div>
    ';
}else{
    if(file_exists($identidades2)){
        $Contenido.='
  <div>
    <img src="'.$identidades2.'" style="width: 750px; height: 900px">
   </div>
    ';
    }else{
        $Contenido.='<p></p>';
    }
}



//IDENTIDADES FINAL




$dompdf = new DOMPDF();
	$dompdf->load_html($Contenido);
	$dompdf->render();
	//$dompdf->stream("mi_archivo.pdf");3
	$dompdf->stream("mi_archivo.pdf",array('Attachment'=>0));
 ?>