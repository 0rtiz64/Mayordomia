
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    });

});
function  alertifyFunction() {
    alertify.success('INTEGRANTES GRADUADOS!');
   // alertify.alert('Alert Message!', function(){ alertify.success('Ok'); });
}



function subirArchivo() {
    var comprobar= $('#csvFile').val().length;
        if (comprobar>0){
            $('#divArchivo').removeClass('has-error');
            $('#divArchivo').addClass('has-success');
            $('#alertArchivo').slideUp(300);


            var formulario = $('#formularioGraduados');
            var archivos = new FormData();
            var url = 'php/graduadosEstado.php';

            for (var i = 0; i < (formulario.find('input[type=file]').length); i++) {

                archivos.append((formulario.find('input[type="file"]:eq('+i+')').attr("name")),((formulario.find('input[type="file"]:eq('+i+')')[0]).files[0]));

            }


            $.ajax({

                url: url,

                type: 'POST',

                contentType: false,

                data: archivos,

                processData:false,

                beforeSend : function (){

                    $('#resultados').html('<center><img src="myfiles/img/cargando.gif" width="50" heigh="50"></center>');

                },
                success: function(data){

                    if(data == 'OK'){

                        $('#respuesta').html('<label style="padding-top:10px; color:green;">Importacion de CSV exitosa</label>');
                        return false;

                    }else{

                        $('#respuesta').html('<label style="padding-top:10px; color:red;">Error en la importacion del CSV</label>');
                        return false;

                    }


                }

            });

            return false;



        }else{
            $('#divArchivo').addClass('has-error');
            $('#alertArchivo').slideDown(300);
            return false;
        }
}