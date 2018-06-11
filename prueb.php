<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" href="select2/css/select2.css">
    <script src="js/jquery.js"></script>
    <script src="select2/js/select2.js"></script>
</head>
<body>
<?php
require_once 'gold/enlace.php';
 $query = mysqli_query($enlace, "SELECT max(idintegrante) AS NuevoIntegrante FROM integrantes ");
$fila = mysqli_fetch_array($query,MYSQLI_ASSOC);

$numero = $fila["NuevoIntegrante"] + 1;
 echo '<input type="text" class="form-control" value="'.$numero.'">';
?>
<input type="button" value="REGISTRAR" onclick="nuevoNumero();">
</body>

<script>
function nuevoNumero() {

}
</script>
</html>

