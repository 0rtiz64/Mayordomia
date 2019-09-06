<?php
$promocion= $_GET['promocion'];
$fecha= $_GET['fecha'];
$numRecibo1= $_GET['numRecibo'];
$numRecibo = substr($numRecibo1,1,6);
$nombre= $_GET['nombre'];
$expediente= $_GET['expediente'];
$equipo= $_GET['equipo'];
$valor= $_GET['valor'];
$tipo= $_GET['tipo'];
$saldoAnterior= $_GET['anterior'];
$saldoActual= $_GET['actual'];
$nombreServidor= $_GET['nombreServidor'];
$equipoServicio= $_GET['equipoServicio'];
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <script >
        window.print();
    </script>
</head>
<body>
<p align="center" style="font-size: x-small;font-family: 'Arial'">IGLESIA DE CRISTO EBENEZER</p>
<p align="center" style="font-size: x-small;font-family: 'Arial'">ESCUELA DE MAYORDOMIA</p>
<p align="center" style="font-size: x-small;font-family: 'Arial'"><?php echo$promocion.'  -  '.$fecha?></p>
<p align="center" style="font-size: x-small;font-family: 'Arial'">CONTROL INTERNO  RECIBO N.<?php echo $numRecibo ?></p>
<p align="center" style="font-size: x-small;font-family: 'Arial'">RECIBIDO: <?php echo $equipoServicio.' - '.$nombreServidor?></p>
<hr>
<p align="center" style="font-size: x-small;font-family: 'Arial'"><?php echo$nombre?></p>
<p align="center" style="font-size: x-small;font-family: 'Arial'">EXPEDIENTE: <?php echo $expediente.' '.$equipo?></p>
<hr>
<p align="center" style="font-size: xx-small;font-family: 'Arial'"><?php echo $tipo?>  L.<?php echo $valor.".00"?></p>
<hr>
<p align="center" style="font-size: x-small;font-family: 'Arial'">SALDO ANTERIOR ------- L.<?php echo$saldoAnterior.".00" ?></p>
<p align="center" style="font-size: x-small;font-family: 'Arial'">SALDO ACTUAL ------- L. <?php echo$saldoActual.".00"?></p>




</body>
</html>