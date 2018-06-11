
$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    })


});

//BUSCAR INTEGRANTE POR CEDULA
  function buscarCedula() {
      var identidadjs = $('#num_identidadIntegrar').val();

      if (identidadjs.trim().length ==""){
          $('#identidadDiv').addClass('has-error');
        $('#identidadAlert').slideDown('1000');
        return false;
      }else{
          $('#identidadAlert').hide('1000');
          $('#identidadDiv').removeClass('has-error');
          $('#identidadDiv').addClass('has-success');

      }

    var url = 'php/integrar.php'
      $.ajax({
          type:'POST',
          url:url,
          data:{

              phpCedula:identidadjs

          },
          success: function(datos){


              $('#RegistroExitoso').html(datos);
              //$('#numeroExpedienteRegistrar').val(newId);
              return false;


          }
      });
          return false;
  }

  //TOMAR DATOS PARA INTEGRAR INTEGRANTE
function editarIntegrante(id){
    $('#formulario')[0].reset();
    $("#Mensaje").empty();
    var url = 'php/editarOveja.php';
    $.ajax({
        type:'POST',
        url:url,
        data:'id='+id,
        success: function(valores){
            var datos = eval(valores);

            $('#idInput').val(id);
            $('#identidadInput').val(datos[0]);
            $('#nombreInput').val(datos[1]);
            $('#celInput').val(datos[2]);
            $('#telInput').val(datos[3]);
            $('#scrollingModal').modal({
                show:true,
                backdrop:'static'
            });
            return false;
        }
    });

    return false;
}

//GUARDAR INTEGRNTE
function cambiosIntegrante(){
    var identidad =$('#identidadInput').val();
    var nombre =$('#nombreInput').val();
    var cel = $('#celInput').val();

    var tel = $('#telInput').val();
    var fijo = $('#fijoInput').val();
    var areas1= document.getElementById("inputArea1").value;
    var areas2= document.getElementById("inputArea2").value;
    var areas3= document.getElementById("inputArea3").value;
    var areas4= document.getElementById("inputArea4").value;
    var areas5= document.getElementById("inputArea5").value;


    if(identidad.trim().length == ""){
        $('#alertIdentidadModal').slideDown('1000');
        $('#modalIdentidad').addClass("has-error");
        return false;
    }else{
        $('#alertIdentidadModal').hide('1000');
        $('#modalIdentidad').removeClass('has-error');
        $('#modalIdentidad').addClass('has-success');

        if(nombre.trim().length =="") {
            $('#alertNombreModal').slideDown('1000');
            $('#modalNombre').addClass("has-error");
            return false;
        }else{
            $('#alertNombreModal').hide('1000');
            $('#modalNombre').removeClass('has-error');
            $('#modalNombre').addClass('has-success');

            if(cel.trim().length == ""){
                $('#alertCelModal').slideDown('1000');
                $('#modalCel').addClass("has-error");
                return false;
            }else{
                $('#alertCelModal').hide('1000');
                $('#modalCel').removeClass('has-error');
                $('#modalCel').addClass('has-success');
                if (areas1.trim().length ==""){
                    $('#alertAreaModal').slideDown('1000');
                    $('#modalArea1').addClass("has-error");
                    return false;
                }else {
                    $('#alertAreaModal').hide('1000');
                    $('#modalArea1').removeClass('has-error');
                    $('#modalArea1').addClass('has-success');
                }
            }
        }
    }


    var url = 'php/save_Integrante.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{phpIdentidad:identidad,
            phpNombre:nombre,
            phpCel:cel,
            phpTel: tel,
            phpArea1:areas1,
            phpArea2:areas2,
            phpArea3:areas3,
            phpArea4:areas4,
            phpArea5:areas5,
            phpRF: fijo
            },
        success: function(datos){
            $('#formulario')[0].reset();
            $('#identidadInput').focus();
            $('#Mensaje').html(datos);

            return false;
        }
    });

    return false;

}

//VALIDACION REPORTE
function reporteIntegrados() {
 var area = document.getElementById("inputAreaReporte").value;

if(area.trim().length ==""){
    $('#divReporte').addClass('has-error');
    $('#alertReporte').show('1000');
    return false;
}else{
    $('#alertReporte').hide('1000');
    $('#divReporte').removeClass('has-error');
    $('#divReporte').addClass('has-success');
}


    var url = 'php/reporteIntegrar.php'
    $.ajax({
        type:'POST',
        url:url,
        data:{

            phpArea:area

        },
        success: function(datos){


            $('#RegistroExitoso').html(datos);
            //$('#numeroExpedienteRegistrar').val(newId);
            return false;


        }
    });
}

/*TOMAR DATOS PARA EDITAR INTEGRANTE
function editarOvejas(identidad){

    $('#formularioModal')[0].reset();
    $("#MensajeModal").empty();
    var url = 'php/editarOvejaIntegrada.php';
    $.ajax({
        type:'POST',
        url:url,
        data:'phpIdentidad='+identidad,
        success: function(valores){
            var datos = eval(valores);

            $('#identidadInputMod').val(datos[0]);
            $('#nombreInputMod').val(datos[1]);
            $('#celInputMod').val(datos[2]);
            $('#telInputMod').val(datos[3]);
            $('#inputArea1Mod').val(datos[4]);
            $('#inputArea2Mod').val(datos[5]);
            $('#inputArea3Mod').val(datos[6]);
            $('#inputArea4Mod').val(datos[7]);
            $('#inputArea5Mod').val(datos[8]);
            $('#idInputMod').val(datos[9]);
            $('#fijoInputMod').val(datos[10]);


            $('#scrollingModalModificar').modal({
                show:true,
                backdrop:'static'
            });
            return false;
        }
    });

    return false;
}
*/

/*function miEditarOvejas(id) {
    $('#formularioModal')[0].reset();
    $("#MensajeModal").empty();
    var url = 'php/editarOvejaIntegrada.php';
    $.ajax({
        type:'POST',
        url:url,
        data:'phpRecibo='+recibo,
        success: function(valores){
            var datos = eval(valores);

            $('#identidadInputMod').val(datos[0]);
            $('#nombreInputMod').val(datos[1]);
            $('#celInputMod').val(datos[2]);
            $('#telInputMod').val(datos[3]);
            $('#inputArea1Mod').val(datos[4]);
            $('#inputArea2Mod').val(datos[5]);
            $('#inputArea3Mod').val(datos[6]);
            $('#inputArea4Mod').val(datos[7]);
            $('#inputArea5Mod').val(datos[8]);
            $('#idInputMod').val(datos[9]);
            $('#fijoInputMod').val(datos[10]);


            $('#scrollingModalModificar').modal({
                show:true,
                backdrop:'static'
            });
            return false;
        }
    });
}*/

//GUARDAR  DATOS MODIFICADOS
function cambiosOvejasIntegradas(){
    var  id=$('#idInputMod').val();
    var identidad =$('#identidadInputMod').val();
    var nombre =$('#nombreInputMod').val();
    var cel = $('#celInputMod').val();
    var tel = $('#telInputMod').val();
    var fijo = $('#fijoInputMod').val();
    var areas1= document.getElementById("inputArea1Mod").value;
    var areas2= document.getElementById("inputArea2Mod").value;
    var areas3= document.getElementById("inputArea3Mod").value;
    var areas4= document.getElementById("inputArea4Mod").value;
    var areas5= document.getElementById("inputArea5Mod").value;
    var url = 'php/save_OvejaMod.php';



    if(identidad.trim().length == ""){
        $('#alertIdentidadModalMod').slideDown('1000');
        $('#modalIdentidadMod').addClass("has-error");
        return false;
    }else{
        $('#alertIdentidadModalMod').hide('1000');
        $('#modalIdentidadMod').removeClass('has-error');
        $('#modalIdentidadMod').addClass('has-success');

        if(nombre.trim().length =="") {
            $('#alertNombreModalMod').slideDown('1000');
            $('#modalNombreMod').addClass("has-error");
            return false;
        }else{
            $('#alertNombreModalMod').hide('1000');
            $('#modalNombreMod').removeClass('has-error');
            $('#modalNombreMod').addClass('has-success');

            if(cel.trim().length == ""){
                $('#alertCelModalMod').slideDown('1000');
                $('#modalCelMod').addClass("has-error");
                return false;
            }else{
                $('#alertCelModalMod').hide('1000');
                $('#modalCelMod').removeClass('has-error');
                $('#modalCelMod').addClass('has-success');
                if (areas1.trim().length ==""){
                    $('#alertAreaModalMod').slideDown('1000');
                    $('#modalArea1Mod').addClass("has-error");
                    return false;
                }else {
                    $('#alertAreaModalMod').hide('1000');
                    $('#modalArea1Mod').removeClass('has-error');
                    $('#modalArea1Mod').addClass('has-success');
                }
            }
        }
    }



    $.ajax({
        type:'POST',
        url:url,
        data:{phpIdentidad:identidad,
            phpNombre:nombre,
            phpCel:cel,
            phpTel: tel,
            phpArea1:areas1,
            phpArea2:areas2,
            phpArea3:areas3,
            phpArea4:areas4,
            phpArea5:areas5,
            phpId:id,
            phpFijo:fijo
        },
        success: function(datos){
            $('#formularioModal')[0].reset();
           // $('#identidadInputMod').focus();
            $('#MensajeModal').html(datos);

            return false;
        }
    });

    return false;

}


