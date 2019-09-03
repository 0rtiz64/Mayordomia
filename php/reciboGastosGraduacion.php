<?php
$promocion= $_GET['promocion'];
$fecha= $_GET['fecha'];
$numRecibo= $_GET['numRecibo'];
$nombre= $_GET['nombre'];
$expediente= $_GET['expediente'];
$equipo= $_GET['equipo'];
$valor= $_GET['valor'];
$tipo= $_GET['tipo'];
$saldoAnterior= $_GET['anterior'];
$saldoActual= $_GET['actual'];
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
<p align="center" style="font-size: x-small;font-family: 'Arial'">ESCUELA DE MAYORDOMIA</p>
<p align="center" style="font-size: x-small;font-family: 'Arial'">IGLESIA DE CRISTO EBENEZER</p>
<p align="center" style="font-size: x-small;font-family: 'Arial'"><?php echo $fecha?>  RECIBO# <?php echo $numRecibo ?></p>
<p align="center" style="font-size: x-small;font-family: 'Arial'">------------------------------------------</p>
<p align="center" style="font-size: x-small;font-family: 'Arial'"><?php echo$nombre?></p>
<p align="center" style="font-size: x-small;font-family: 'Arial'">EXPEDIENTE: <?php echo$expediente?></p>
<p align="center" style="font-size: x-small;font-family: 'Arial'"><?php echo$equipo?></p>
<p align="center" style="font-size: x-small;font-family: 'Arial'">------------------------------------------</p>
<p align="center" style="font-size: xx-small;font-family: 'Arial'"><?php echo $tipo?>  L.<?php echo $valor?></p>
<p align="center" style="font-size: x-small;font-family: 'Arial'">------------------------------------------</p>
<p align="center" style="font-size: x-small;font-family: 'Arial'">SALDO ANTERIOR ------- L.<?php echo$saldoAnterior ?></p>
<p align="center" style="font-size: x-small;font-family: 'Arial'">SALDO ACTUAL ------- L. <?php echo$saldoActual?></p>
<p align="center" style="font-size: x-small;font-family: 'Arial'"><?php echo$promocion?></p>


</body>
</html>