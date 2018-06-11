<?php
include '../gold/enlace.php';

$area=$_POST["phpArea"];

if($area == 1){
    echo '<a href="php/EXCELreporteOvejasIntegradas.php" type="button" class="btn " style="background-color: #207245; color: #ffffff; float: right;margin-right:23px " >EXPORTAR A EXCEL</a>';

    echo '<div class="table-responsive">';

    echo '<table class="table table-hover" id="example">';

    echo "<thead>";
    echo "<tr >";
    echo "<th>#</th>";
    echo "<th>AREA</th>";
    echo "<th>CANTIDAD</th>";

    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";

        $queryAlabanza = mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'ALABANZA' OR area2 = 'ALABANZA' OR area3='ALABANZA' OR area4= 'ALABANZA' OR area5='ALABANZA'");
        $datosAlabanza = mysqli_fetch_array($queryAlabanza,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>1</td>";
    echo "<td>ALABANZA</td>";
    echo "<td>".utf8_encode($datosAlabanza["cantidad"])."</td>";
    echo "</tr>";

    $queryArca= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'ARCA DE LOS TESOROS' OR area2 = 'ARCA DE LOS TESOROS' OR area3='ARCA DE LOS TESOROS' OR area4= 'ARCA DE LOS TESOROS' OR area5='ARCA DE LOS TESOROS'");
    $datosArca = mysqli_fetch_array($queryArca,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>2</td>";
    echo "<td>ARCA DE LOS TESOROS</td>";
    echo "<td>".utf8_encode($datosArca["cantidad"])."</td>";
    echo "</tr>";

    $queryBernabe= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'BERNABE' OR area2 = 'BERNABE' OR area3='BERNABE' OR area4= 'BERNABE' OR area5='BERNABE'");
    $datosBernabe = mysqli_fetch_array($queryBernabe,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>3</td>";
    echo "<td>BERNABE</td>";
    echo "<td>".utf8_encode($datosBernabe["cantidad"])."</td>";
    echo "</tr>";

    $queryCorrosVarones= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'CORROS VARONES' OR area2 = 'CORROS VARONES' OR area3='CORROS VARONES' OR area4= 'CORROS VARONES' OR area5='CORROS VARONES'");
    $datosCorrosVarones = mysqli_fetch_array($queryCorrosVarones,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>4</td>";
    echo "<td>CORROS VARONES</td>";
    echo "<td>".utf8_encode($datosCorrosVarones["cantidad"])."</td>";
    echo "</tr>";

    $queryCronicas= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'CRONICAS' OR area2 = 'CRONICAS' OR area3='CRONICAS' OR area4= 'CRONICAS' OR area5='CRONICAS'");
    $datosCronicas = mysqli_fetch_array($queryCronicas,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>5</td>";
    echo "<td>CRONICAS</td>";
    echo "<td>".utf8_encode($datosCronicas["cantidad"])."</td>";
    echo "</tr>";

    $queryPandero= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'DANZA PANDERO' OR area2 = 'DANZA PANDERO' OR area3='DANZA PANDERO' OR area4= 'DANZA PANDERO' OR area5='DANZA PANDERO'");
    $datosPandero= mysqli_fetch_array($queryPandero,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>6</td>";
    echo "<td>DANZA PANDERO</td>";
    echo "<td>".utf8_encode($datosPandero["cantidad"])."</td>";
    echo "</tr>";

    $queryCenter= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'EBENECENTER' OR area2 = 'EBENECENTER' OR area3='EBENECENTER' OR area4= 'EBENECENTER' OR area5='EBENECENTER'");
    $datosCenter= mysqli_fetch_array($queryCenter,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>7</td>";
    echo "<td>EBENECENTER</td>";
    echo "<td>".utf8_encode($datosCenter["cantidad"])."</td>";
    echo "</tr>";

    $querySamaritano= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'EL BUEN SAMARITANO' OR area2 = 'EL BUEN SAMARITANO' OR area3='EL BUEN SAMARITANO' OR area4= 'EL BUEN SAMARITANO' OR area5='EL BUEN SAMARITANO'");
    $datosSamaritano= mysqli_fetch_array($querySamaritano,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>8</td>";
    echo "<td>EL BUEN SAMARITANO</td>";
    echo "<td>".utf8_encode($datosSamaritano["cantidad"])."</td>";
    echo "</tr>";

    $queryMayordomia= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'ESC DE MAYORDOMIA' OR area2 = 'ESC DE MAYORDOMIA' OR area3='ESC DE MAYORDOMIA' OR area4= 'ESC DE MAYORDOMIA' OR area5='ESC DE MAYORDOMIA'");
    $datosMayordomia= mysqli_fetch_array($queryMayordomia,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>9</td>";
    echo "<td>ESC DE MAYORDOMIA</td>";
    echo "<td>".utf8_encode($datosMayordomia["cantidad"])."</td>";
    echo "</tr>";

    $queryProfetica= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'ESC PROFETICA' OR area2 = 'ESC PROFETICA' OR area3='ESC PROFETICA' OR area4= 'ESC PROFETICA' OR area5='ESC PROFETICA'");
    $datosProfetica= mysqli_fetch_array($queryProfetica,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>10</td>";
    echo "<td>ESC PROFETICA</td>";
    echo "<td>".utf8_encode($datosProfetica["cantidad"])."</td>";
    echo "</tr>";

    $queryKeruso= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'KERUSSO' OR area2 = 'KERUSSO' OR area3='KERUSSO' OR area4= 'KERUSSO' OR area5='KERUSSO'");
    $datosKeruso= mysqli_fetch_array($queryKeruso,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>11</td>";
    echo "<td>KERUSSO</td>";
    echo "<td>".utf8_encode($datosKeruso["cantidad"])."</td>";
    echo "</tr>";

    $queryCuna= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SALA CUNA' OR area2 = 'SALA CUNA' OR area3='SALA CUNA' OR area4= 'SALA CUNA' OR area5='SALA CUNA'");
    $datosCuna= mysqli_fetch_array($queryCuna,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>12</td>";
    echo "<td>SALA CUNA</td>";
    echo "<td>".utf8_encode($datosCuna["cantidad"])."</td>";
    echo "</tr>";

    $queryA= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES A' OR area2 = 'SERVIDORES A' OR area3='SERVIDORES A' OR area4= 'SERVIDORES A' OR area5='SERVIDORES A'");
    $datosA= mysqli_fetch_array($queryA,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>13</td>";
    echo "<td>SERVIDORES A</td>";
    echo "<td>".utf8_encode($datosA["cantidad"])."</td>";
    echo "</tr>";

    $queryB= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES B' OR area2 = 'SERVIDORES B' OR area3='SERVIDORES B' OR area4= 'SERVIDORES B' OR area5='SERVIDORES B'");
    $datosB= mysqli_fetch_array($queryB,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>14</td>";
    echo "<td>SERVIDORES B</td>";
    echo "<td>".utf8_encode($datosB["cantidad"])."</td>";
    echo "</tr>";

    $queryC= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES C' OR area2 = 'SERVIDORES C' OR area3='SERVIDORES C' OR area4= 'SERVIDORES C' OR area5='SERVIDORES C'");
    $datosC= mysqli_fetch_array($queryC,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>15</td>";
    echo "<td>SERVIDORES C</td>";
    echo "<td>".utf8_encode($datosC["cantidad"])."</td>";
    echo "</tr>";

    $queryD= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES D' OR area2 = 'SERVIDORES D' OR area3='SERVIDORES D' OR area4= 'SERVIDORES D' OR area5='SERVIDORES D'");
    $datosD= mysqli_fetch_array($queryD,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>16</td>";
    echo "<td>SERVIDORES D</td>";
    echo "<td>".utf8_encode($datosD["cantidad"])."</td>";
    echo "</tr>";

    $queryE= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES E' OR area2 = 'SERVIDORES E' OR area3='SERVIDORES E' OR area4= 'SERVIDORES E' OR area5='SERVIDORES E'");
    $datosE= mysqli_fetch_array($queryE,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>17</td>";
    echo "<td>SERVIDORES E</td>";
    echo "<td>".utf8_encode($datosE["cantidad"])."</td>";
    echo "</tr>";

    $queryF= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES F' OR area2 = 'SERVIDORES F' OR area3='SERVIDORES F' OR area4= 'SERVIDORES F' OR area5='SERVIDORES F'");
    $datosF= mysqli_fetch_array($queryF,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>18</td>";
    echo "<td>SERVIDORES F</td>";
    echo "<td>".utf8_encode($datosF["cantidad"])."</td>";
    echo "</tr>";

    $queryG= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES G' OR area2 = 'SERVIDORES G' OR area3='SERVIDORES G' OR area4= 'SERVIDORES G' OR area5='SERVIDORES G'");
    $datosG= mysqli_fetch_array($queryG,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>19</td>";
    echo "<td>SERVIDORES G</td>";
    echo "<td>".utf8_encode($datosG["cantidad"])."</td>";
    echo "</tr>";

    $queryH= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES H' OR area2 = 'SERVIDORES H' OR area3='SERVIDORES H' OR area4= 'SERVIDORES H' OR area5='SERVIDORES H'");
    $datosH= mysqli_fetch_array($queryH,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>20</td>";
    echo "<td>SERVIDORES H</td>";
    echo "<td>".utf8_encode($datosH["cantidad"])."</td>";
    echo "</tr>";

    $queryI= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES I' OR area2 = 'SERVIDORES I' OR area3='SERVIDORES I' OR area4= 'SERVIDORES I' OR area5='SERVIDORES I'");
    $datosI= mysqli_fetch_array($queryI,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>21</td>";
    echo "<td>SERVIDORES I</td>";
    echo "<td>".utf8_encode($datosI["cantidad"])."</td>";
    echo "</tr>";

    $queryJ= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES J' OR area2 = 'SERVIDORES J' OR area3='SERVIDORES J' OR area4= 'SERVIDORES J' OR area5='SERVIDORES J'");
    $datosJ= mysqli_fetch_array($queryJ,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>22</td>";
    echo "<td>SERVIDORES J</td>";
    echo "<td>".utf8_encode($datosJ["cantidad"])."</td>";
    echo "</tr>";

    $queryK= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES K' OR area2 = 'SERVIDORES K' OR area3='SERVIDORES K' OR area4= 'SERVIDORES K' OR area5='SERVIDORES K'");
    $datosK= mysqli_fetch_array($queryK,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>23</td>";
    echo "<td>SERVIDORES K</td>";
    echo "<td>".utf8_encode($datosK["cantidad"])."</td>";
    echo "</tr>";

    $queryL= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SERVIDORES L' OR area2 = 'SERVIDORES L' OR area3='SERVIDORES L' OR area4= 'SERVIDORES L' OR area5='SERVIDORES L'");
    $datosL= mysqli_fetch_array($queryL,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>24</td>";
    echo "<td>SERVIDORES L</td>";
    echo "<td>".utf8_encode($datosL["cantidad"])."</td>";
    echo "</tr>";

    $queryTeatro= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'DOCTRINA EMPRESARIAL' OR area2 = 'DOCTRINA EMPRESARIAL' OR area3='DOCTRINA EMPRESARIAL' OR area4= 'DOCTRINA EMPRESARIAL' OR area5='DOCTRINA EMPRESARIAL'");
    $datosTeatro= mysqli_fetch_array($queryTeatro,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>25</td>";
    echo "<td>DOCTRINA EMPRESARIAL</td>";
    echo "<td>".utf8_encode($datosTeatro["cantidad"])."</td>";
    echo "</tr>";

    $queryPlus= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'JOVENES PLUS' OR area2 = 'JOVENES PLUS' OR area3='JOVENES PLUS' OR area4= 'JOVENES PLUS' OR area5='JOVENES PLUS'");
    $datosPlus= mysqli_fetch_array($queryPlus,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>26</td>";
    echo "<td>JOVENES PLUS</td>";
    echo "<td>".utf8_encode($datosPlus["cantidad"])."</td>";
    echo "</tr>";

    $queryTele= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'TELEVISION' OR area2 = 'TELEVISION' OR area3='TELEVISION' OR area4= 'TELEVISION' OR area5='TELEVISION'");
    $datosTele= mysqli_fetch_array($queryTele,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>27</td>";
    echo "<td>TELEVISION</td>";
    echo "<td>".utf8_encode($datosTele["cantidad"])."</td>";
    echo "</tr>";

    $queryAvanzada= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'DOCTRINA AVANZADA' OR area2 = 'DOCTRINA AVANZADA' OR area3='DOCTRINA AVANZADA' OR area4= 'DOCTRINA AVANZADA' OR area5='DOCTRINA AVANZADA'");
    $datosAvanzada= mysqli_fetch_array($queryAvanzada,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>28</td>";
    echo "<td>DOCTRINA AVANZADA</td>";
    echo "<td>".utf8_encode($datosAvanzada["cantidad"])."</td>";
    echo "</tr>";

    $queryCorrosMujeres= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'CORROS MUJERES' OR area2 = 'CORROS MUJERES' OR area3='CORROS MUJERES' OR area4= 'CORROS MUJERES' OR area5='CORROS MUJERES'");
    $datosCorrosMujeres= mysqli_fetch_array($queryCorrosMujeres,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>29</td>";
    echo "<td>CORROS MUJERES</td>";
    echo "<td>".utf8_encode($datosCorrosMujeres["cantidad"])."</td>";
    echo "</tr>";

    $queryMusica= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'ESCUELA DE MUSICA' OR area2 = 'ESCUELA DE MUSICA' OR area3='ESCUELA DE MUSICA' OR area4= 'ESCUELA DE MUSICA' OR area5='ESCUELA DE MUSICA'");
    $datosMusica= mysqli_fetch_array($queryMusica,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>30</td>";
    echo "<td>ESCUELA DE MUSICA</td>";
    echo "<td>".utf8_encode($datosMusica["cantidad"])."</td>";
    echo "</tr>";

    $queryMiriam= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'DANZA MIRIAM' OR area2 = 'DANZA MIRIAM' OR area3='DANZA MIRIAM' OR area4= 'DANZA MIRIAM' OR area5='DANZA MIRIAM'");
    $datosMiriam= mysqli_fetch_array($queryMiriam,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>31</td>";
    echo "<td>DANZA MIRIAM</td>";
    echo "<td>".utf8_encode($datosMiriam["cantidad"])."</td>";
    echo "</tr>";


    $queryCaleb= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'CALEB' OR area2 = 'CALEB' OR area3='CALEB' OR area4= 'CALEB' OR area5='CALEB'");
    $datosCaleb= mysqli_fetch_array($queryCaleb,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>32</td>";
    echo "<td>CALEB</td>";
    echo "<td>".utf8_encode($datosCaleb["cantidad"])."</td>";
    echo "</tr>";

    $queryShadai= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'SHADAI' OR area2 = 'SHADAI' OR area3='SHADAI' OR area4= 'SHADAI' OR area5='SHADAI'");
    $datosShadai= mysqli_fetch_array($queryShadai,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>33</td>";
    echo "<td>SHADAI</td>";
    echo "<td>".utf8_encode($datosShadai["cantidad"])."</td>";
    echo "</tr>";

    $queryTeens= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'TEENS' OR area2 = 'TEENS' OR area3='TEENS' OR area4= 'TEENS' OR area5='TEENS'");
    $datosTeens= mysqli_fetch_array($queryTeens,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>34</td>";
    echo "<td>TEENS</td>";
    echo "<td>".utf8_encode($datosTeens["cantidad"])."</td>";
    echo "</tr>";

    $queryObreros= mysqli_query($enlace,"SELECT  COUNT(nombre) AS cantidad FROM ovejas
WHERE area1 = 'OBREROS' OR area2 = 'OBREROS' OR area3='OBREROS' OR area4= 'OBREROS' OR area5='OBREROS'");
    $datosObreros= mysqli_fetch_array($queryObreros,MYSQLI_ASSOC);
    echo "<tr >";
    echo "<td>35</td>";
    echo "<td>OBREROS</td>";
    echo "<td>".utf8_encode($datosObreros["cantidad"])."</td>";
    echo "</tr>";




    echo "</tbody>";
    echo '</table>';
    echo '</div>';

}else{

$query_buscar = mysqli_num_rows(mysqli_query($enlace,"SELECT ovejas.nombre,ovejas.area1,ovejas.area2,ovejas.area3,ovejas.area4,ovejas.area5 from ovejas
WHERE area1='$area' OR area2='$area' OR area3='$area' OR area4='$area' OR area5='$area'
"));

if($query_buscar==0){
    echo "<div class='alert alert-danger' style='text-align: center;'> <strong>NO HAY DATOS ENCONTRADOS</strong>  </div>";
}else{


    $queryIntegrantes = mysqli_query($enlace,"SELECT COUNT(ovejas.nombre) AS cantidad from ovejas
WHERE area1='$area' OR area2='$area' OR area3='$area' OR area4='$area' OR area5='$area'");
    $contador = 1;
    $datos = mysqli_fetch_array($queryIntegrantes,MYSQLI_ASSOC);



    echo'<div class="panel panel-default">';
                          echo'<div class="panel-heading">';
                            echo'<h3 class="panel-title">'.$area.'- CANTIDAD : '.$datos["cantidad"].'</h3>';

                          echo '</div>';
                          echo '<div class="panel-body">';



    echo '<div class="table-responsive">';

    echo '<table class="table table-bordered table-striped" id="example">';

    echo "<thead>";
    echo "<tr >";
    echo "<th>#</th>";
    echo "<th>IDENTIDAD</th>";
    echo "<th>NOMBRE</th>";
    echo "<th>CEL</th>";
    echo "<th>TEL</th>";
    echo "<th>FIJO</th>";
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";
        $Integrantes = mysqli_query($enlace,"SELECT ovejas.idOveja,ovejas.identidad, ovejas.nombre, ovejas.cel,ovejas.tel,ovejas.fijo FROM ovejas
WHERE ovejas.area1 = '$area' OR ovejas.area2 = '$area' OR ovejas.area3='$area' OR
ovejas.area4 ='$area' OR ovejas.area5='$area'");
        $contador=1;
    while ($integrantesDatos = mysqli_fetch_array($Integrantes,MYSQLI_ASSOC)) {
        echo "<tr >";
        echo "<td>" . $contador . "</td>";
        echo "<td>" . $integrantesDatos["identidad"]. "</td>";
        echo "<td>" . utf8_encode($integrantesDatos["nombre"]) . "</td>";
        echo "<td>" . $integrantesDatos["cel"]. "</td>";
        echo "<td>" . $integrantesDatos["tel"]. "</td>";
        echo "<td>" . $integrantesDatos["fijo"]. "</td>";
        echo "</tr>";
        $contador++;
    }
    echo "</tbody>";
    echo '</table>';
    echo '</div>';

    echo'</div>';
                echo '</div>';
               echo '</div>';
             echo '</div>';

    echo '<a href="php/EXCELreporteOvejasIntegradasArea.php?area='.$area.'" type="button" class="btn " style="background-color: #207245; color: #ffffff; float: right;margin-right:23px " >EXPORTAR A EXCEL</a>';
}
}
?>