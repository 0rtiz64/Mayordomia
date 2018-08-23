$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });

});

$('#selectReporteEnlazados').on('change',function () {
   var equipo = document.getElementById('selectReporteEnlazados').value;

   if(equipo ==0){
       var url = 'php/reporteEnlazadosModel.php';
       $.ajax({
           type:'POST',
           url:url,
           data:'equipo='+equipo,
           success: function(tabla){
               $('#tablaResultados').html(tabla);
           }
       });
   }else{
       var url ='php/listadosEquipos.php';

       $.ajax({
           type:'POST',
           url:url,
           data:{
               phpEquipoL: equipo
           },
           success: function(datos){


               $('#tablaResultados').html(datos);

               return false;


           }
       });
   }


   return false;
});