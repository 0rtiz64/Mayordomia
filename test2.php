<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="DataTables/dataTable.css">
</head>
<body>
<table id="tablaTest">
    <thead>
    <tr>


        <th>Nombre</th>
        <th>Numero</th>
    </tr>
    </thead>

    <tbody>
    <tr>
        <td>A</td>
        <td>1</td>
    </tr>

    <tr>
        <td>B</td>
        <td>2</td>
    </tr>

    <tr>
        <td>C</td>
        <td>3</td>
    </tr>

    <tr>
        <td>D</td>
        <td>4</td>
    </tr>
    </tbody>
</table>
</body>
<script src="myfiles/js/jquery-3.2.1.min%20(2).js"></script>
<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="DataTables/dataTable.js"></script>

<script src="js/jquery.tablesorter.min.js"></script>

<script>
$(document).on("ready",function () {
    $("#tablaTest").tablesorter();
})

    var listar =function () {
        $('#tablaTest').DataTable({
"ajax":{
    "method": "POST",
                "url":"php/test2query.php"
        },
        "columns":[


            {"data":"nombre_equipo"},
            {"data":"num_equipo"}
        ]

        });
    }
</script>
</html>