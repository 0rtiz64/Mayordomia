$(document).ready(function(){




	$('#num_identidad').focus();
  $('#nombreShared').focus();

    $(".parrafo").dblclick(function(){
        alert("has hecho doble click en el párrafo con id=parrafo");
    });

//Evento Abrir Modal y dentro lo que queremos que haga.
$('#scrollingModal').on('shown.bs.modal', function() {
    $("#ModalInputName").focus();
});

//Evento Cerrar Modal y dentro lo que queremos que haga
$('#scrollingModal').on('hidden.bs.modal', function() {
    $("#num_identidad").focus();
});




$('#btnRegistrar').click(function(){
$('#ModalRegistrar').modal({
      show:true,
      backdrop:'static'
    });
});

$('#cerrarModalRegistrar').click(function cerrarModalRegistrarLimpiar() {
    //alert("Dentro de Funcion Limpiar Modal al Cerrar");
    $('#formularioRegistro')[0].reset();
});

$("input:submit").click(function() {
	  return false; 
 });



/*
Desde el boton de que tiene por id: sharedPerson 
lo que hace es limpiar el input y el div donde 
se muestran los resultados y abre la pantalla modal.
*/
  $('#sharedPerson').on('click',function(){
    $('#ModalInputName').val("");
    $("#agrega-personas").empty();

    $('#scrollingModal').modal({
      show:true,
      backdrop:'static'
    });
  });

//Busca los equipos por su numero de serie 
    $('#ModalInputName').on('keyup',function(){
    var dato = $('#ModalInputName').val();
    var url = 'php/buscar_persona.php';
    $.ajax({
    type:'POST',
    url:url,
    data:'nombrePersona='+dato,
    success: function(datos){
      $('#agrega-personas').html(datos);
    }
  });
  return false;
  });



//Buscar personas en el censo
$('#identidadCenso').on('keyup',function(e){
    
if (e.keyCode == 13){
  
  var dato = $('#identidadCenso').val();

    var url = 'php/BuscarPersonaCenso.php';
    $.ajax({
    type:'POST',
    url:url,
    data:'nombrePersona='+dato,
    dataType: "html",
    beforeSend: function(){
                          //imagen de carga
                          $("#cargar").html("<p align='center'><img src='php/photos/loader.gif' /></p>");
                    },
    error: function(){
                          alert("error petición ajax");
                    },
    success: function(datos){
      $("#cargar").empty();
      var datos1 = eval(datos);

      
      $('#identidadRegistrar').val(datos1[0]);
      $('#NombreRegistro').val(datos1[2]);
      $('#fecha_cumpleRegistro').val(datos1[1]);
      
      var dato = $('#identidadCenso').val("");
      dato.focus();
      
      if(datos.length == 16){
      $('#cargar').html("<div class='alert alert-danger' style='text-align: center;'> <strong> No se han encontrado resultados!!</strong>  </div>");
}else{
  console.log("Datos recibidos correctamente.");
}

    }
  });
  return false;
  
}

  });



  //Busca los integrantes para hacer cambios
    $('#nombreShared').on('keyup',function(){
    var dato = $('#nombreShared').val();
    var url = 'php/cambios_persona.php';
    $.ajax({
    type:'POST',
    url:url,
    data:'nombrePersona='+dato,
    success: function(datos){
      $('#agrega-registros').html(datos);
    }
  });
  return false;
  });




$('#fecha_cumple').datepicker({
    format: "yyyy-mm-dd"
});


$('#generoRegistrar').change(function focus(){
var civil = document.getElementById("estadoCivilRegistrar").value;
var genero = document.getElementById("generoRegistrar").value;
  
  if (civil == "Casado" && genero == "F") {
   $('#ApellidoCasada').toggle('1000');
  }else{
    $('#ApellidoCasada').hide('1000');
  }
});

$('#estadoCivilRegistrar').change(function focus(){
var civil = document.getElementById("estadoCivilRegistrar").value;
var genero = document.getElementById("generoRegistrar").value;
  
  if (civil == "Casado" && genero == "F") {
   $('#ApellidoCasada').toggle('1000');
  }else{
    $('#ApellidoCasada').hide('1000');
  }
});

$('#integradoRegistrar').change(function integrado(){
  var integradoRespuesta = document.getElementById("integradoRegistrar").value;
  if (integradoRespuesta == "Si") {
    $('#areasRegistro').show('1000');
  }else{
    $('#areasRegistro').hide('1000');
  }
});


$("#tabEnlazar").click(function () {
    $("#Registrar").hide('100');
    $("#PDF").hide('100');
    $("#Enlazar").show('100');
});

$("#tabRegistrar").click(function () {
    $("#Enlazar").hide('100');
    $("#PDF").show('100');
    $("#Registrar").show('100');
});


    //Busca los integrantes para enlazar
    $('#buscarEnlazar').on('keyup',function(){
        var dato = $('#buscarEnlazar').val();
        var url = 'php/buscarEnlazar.php';
        $.ajax({
            type:'POST',
            url:url,
            data:'nombrePersonaEnlazar='+dato,
            success: function(datos){
                $('#divIntegranteEnlazar').html(datos);
            }
        });
        return false;
    });


    //Busca Id Integrante


    //Busca los integrantes para enlazar
    $('#corderitosPromocionRegistrar').on('keyup',function(){
        var dato = $('#corderitosPromocionRegistrar').val();
        var url = 'php/buscarIdIntegrante.php';
        $.ajax({
            type:'POST',
            url:url,
            data:'nombrePersonaEnlazar='+dato,
            success: function(datos){
                $('#divIdIntegrante').html(datos);
            }
        });
        return false;
    });
    //Fin Busca Id Integrante



   /* $('#fecha_cumpleRegistro').datepicker({
        format: "yyyy-mm-dd"
    });
*/

	 });//FIN DE DOCUMENT




function EnviarCambios(){
var num_identidad = $('#identidad').val();
var cambios = $('#cambios').val();
var solonumeros = /^([0-9])*$/;


if(num_identidad.trim().length == "" || !solonumeros.test(num_identidad) ){
	$('#ErrorIdentidad').html('Ingresa el numero de identidad.').slideDown(500);
	$('#identidad').focus();
    return false;

}else{
$('#ErrorIdentidad').html('').slideUp(300);
if(cambios.trim().length == ""){
	
	$('#ErrorCambios').html('Realiza los cambios que se realizaran.').slideDown(500);
	$('#cambios').focus();
    return false;
}else{
  $('#ErrorCambios').html('').slideUp(300);
}
	
}

var url = 'php/cambios.php';

$.ajax({
    type:'POST',
    url:url,
    data:{IDENTIDAD1: num_identidad,CAMBIOS1:cambios},
    success: function(datos){
      $('#formulario')[0].reset();
      $('#identidad').focus();
      $('#RegistroExitoso').addClass('bien').html('Datos Encontrados Exitosamente.').show(200).delay(2500).hide(200);
      $('#agrega-registros').html(datos);
      return false;
    }
  });

return false;
}




//Registrar Persona
function guardarPersona(){
var promCorderitos = $('#corderitosPromocionRegistrar').val();
var estadoCivil =document.getElementById("estadoCivilRegistrar").value;
var genero = document.getElementById("generoRegistrar").value;
var transporte = document.getElementById("tranporteRegistrar").value;
var identidad = $('#identidadRegistrar').val();
var nombre = $('#NombreRegistro').val();
var ApeCasada = $('#ApellidoCasada').val();
var fechaCumpleaños = $('#fecha_cumpleRegistro').val();
var tel1= $('#telefono1Registrar').val();
var tel2 = $('#telefono2Registrar').val();
var integradoRes = document.getElementById("integradoRegistrar").value;
var areas = $('#areasRegistroText').val();
var direccion = $('#direccionRegistrar').val();
var id = $('#numeroExpedienteRegistrar').val();
var idNum = parseInt(id);
var newId = idNum+1;

 
//Validar Promocion Corderitos
if(promCorderitos.trim().length == ""){

  $('#divCorderito').addClass('has-error');
  $("#alertPromocion").slideDown('1000');
  return false;
}else{
  
  $("#alertPromocion").hide('1000');
   $('#divCorderito').removeClass('has-error');
   $('#divCorderito').addClass('has-success');
    
    //Validar estado Civil
    if(estadoCivil.trim().length == ""){
      $('#divCivil').addClass('has-error');
      $("#alertEstado").slideDown('1000');
      return false;
    }else{
      $("#alertEstado").hide('1000');
      $('#divCivil').removeClass('has-error');
      $('#divCivil').addClass('has-success');
        //Validar 
        if (genero.trim().length == "") {
           $('#divGenero').addClass('has-error');
           $("#alertGenero").slideDown('1000');
           return false;
         }else{
           $("#alertGenero").hide('1000');
          $('#divGenero').removeClass('has-error');
          $('#divGenero').addClass('has-success');
              if (transporte.trim().length == "") {
                  $('#divTransporte').addClass('has-error');
                   $("#alertTransporte").slideDown('1000');
                   return false;
              }else{
                   $("#alertTransporte").hide('1000');
                   $('#divTransporte').removeClass('has-error');
                  $('#divTransporte').addClass('has-success');

                    if (identidad.trim().length == "") {
                      $('#divIdentidad').addClass('has-error');
                       $("#alertIdentidad").slideDown('1000');
                       return false;
                    }else{
                      $("#alertIdentidad").hide('1000');
                      $('#divIdentidad').removeClass('has-error');
                      $('#divIdentidad').addClass('has-success');

                        if (nombre.trim().length == "") {
                           $('#divNombre').addClass('has-error');
                          $("#alertNombre").slideDown('1000');
                          return false;
                        }else{
                          $("#alertNombre").hide('1000');
                          $('#divNombre').removeClass('has-error');
                          $('#divNombre').addClass('has-success');

                            if (fechaCumpleaños.trim().length == "") {
                              $('#divFecha').addClass('has-error');
                              $("#alertFecha").slideDown('1000');
                              return false;
                            }else{
                              $("#alertFecha").hide('1000');
                              $('#divFecha').removeClass('has-error');
                              $('#divFecha').addClass('has-success');

                                if (tel1.trim().length == "") {
                                  $('#divTelefono1').addClass('has-error');
                                  $("#alertTelefono1").slideDown('1000');
                                  return false;
                                }else{
                                    $("#alertTelefono1").hide('1000');
                                     $('#divTelefono1').removeClass('has-error');
                                    $('#divTelefono1').addClass('has-success');

                                      if (integradoRes.trim().length == "") {
                                        $('#divIntegrado').addClass('has-error');
                                        $("#alertIntegrado").slideDown('1000');
                                        return false;
                                      }else{
                                        $("#alertIntegrado").hide('1000');
                                        $('#divIntegrado').removeClass('has-error');
                                        $('#divIntegrado').addClass('has-success');
                                          
                                          if (direccion.trim().length == "") {
                                            $('#divDireccion').addClass('has-error');
                                            $("#alertDireccion").slideDown('1000');
                                            return false;
                                          }else{
                                             $("#alertDireccion").hide('1000');
                                            $('#divDireccion').removeClass('has-error');
                                            $('#divDireccion').addClass('has-success');
                                          }//Fin Direccion
                                      }//Validar Integrado
                                }//Fin Telefono1
                            }//Fin Fecha
                        }//Fin Nombre
                    }//Fin Identidadd
              }//Fin Transporte
        }//Fin Genero
    }//Fin Estado Civil
 };//FIN IF PRINCIPAL


var url = 'php/guardarIntegrante.php';

$.ajax({
    type:'POST',
    url:url,
    data:{
      phpPromoCordero: promCorderitos,
      phpEstadoCivil: estadoCivil,
      phpGenero:genero,
      phpTransporte: transporte,
      phpIdentidad: identidad,
      phpNombre: nombre,
      phpApeCasada: ApeCasada,
      phpFechaCumpleanos:fechaCumpleaños,
      phpTel1:tel1,
      phpTel2:tel2,
      phpIntegradoRes: integradoRes,
      phpAreas: areas,
      phpDireccion: direccion,
      phpId:id,
      phpnewId:newId
      
    },
  success: function(datos){

      $('#formularioRegistro')[0].reset();

      $('#guardado').html(datos).show('1000').delay('2500').hide('200');
      //$('#numeroExpedienteRegistrar').val(newId);
      return false;
     
      
    }
  });

return false;
}
// Fin Registrar Persona




function recargarNumeroExpediente(id){
  var numero = $('#numeroExpedienteRegistrar').val();
  //console.log(numero);
  $.ajax ({
    type: 'POST',
    url :'php/updateOrden.php',
    data : {numeroNuevo:numero},
    success: function (datos){
      $('#IDorden').html(datos);
      return false;
    }
  });
  return false
}



function BuscarPersona(){

  var num_identidad = $('#num_identidad').val();

  if(num_identidad.trim().length == ""){
    $('#num_identidad').focus();
    return false;
  }else{
  
  }


  var url = 'php/cambios.php';

    $.ajax({
    type:'POST',
    url:url,
    data:{IDENTIDAD1: num_identidad},
    success: function(datos){
      $('#formulario')[0].reset();
      $('#num_identidad').focus();
      $('#agrega-registros').html(datos);
      return false;
    }
  });

return false;

}

function editarIntegrante(id){
  $('#formulario')[0].reset();
  $("#Mensaje").empty();
  var url = 'php/editar_integrante.php';
      $.ajax({
    type:'POST',
    url:url,
    data:'id='+id,
    success: function(valores){
        var datos = eval(valores);
        
        $('#id-prod').val(id);
        document.getElementById('ECC').value = datos[13];
        //$('#ECC').val(datos[13]);
        $('#GFM').val(datos[11]);
        $('#OCT').val(datos[12]);
        $('#numero_I').val(datos[0]);
        $('#nombreI').val(datos[1]);
        $('#fecha_cumple').val(datos[2]);
        $('#num_cel').val(datos[3]);
        $('#num_tel').val(datos[4]);
        $('#estados').val(datos[5]);
        $('#CambioP').val(datos[6]);
        $('#CambioE').val(datos[7]);
        $('#Cargos').val(datos[8]);
        $('#commentEditar').val(datos[9]);
        $('#scrollingModal').modal({
          show:true,
          backdrop:'static'
        });
      return false;
    }
  });

    return false;
}




function Mostrar(idnum){
  
  $('#scrollingModal').modal('toggle');
  $("#num_identidad").val(idnum);
  //alert('Numero de identidad recibio es : '+);
}

//Funcion Enlazar Integrante

function enlazarIntegrante () {
    var integrante =$('#integranteEnlazar').val();
    var idIntegrante =$('#idIntegranteEnlazar').val(); //Se Obtiene del Input Hidden de buscarEnlazar.php
    var equipo =document.getElementById("equipoSelect").value;
    var cargo =document.getElementById("cargoSelect").value;
    var estado=document.getElementById("estadoSelect").value;
    var comentarios = $('#comentario').val();
    var promocion = $('#idPromocion').val();



    if (integrante.trim().length == "") {
        $("#divIntegranteEnlazar").addClass("has-error");
        $("#alertIntegranteEnlazar").slideDown('1000');
        return false;
    }else{
        $("#alertIntegranteEnlazar").hide('1000');
        $("#divIntegranteEnlazar").removeClass("has-error");
        $("#divIntegranteEnlazar").addClass("has-success");

        if (equipo.trim().length == ""){
            $("#divequipoEnlazar").addClass("has-error");
            $("#alertEquipoEnlazar").slideDown('1000');
            return false;
        }else{
            $("#alertEquipoEnlazar").hide('1000');
            $("#divequipoEnlazar").removeClass("has-error");
            $("#divequipoEnlazar").addClass("has-success");


            if (cargo.trim().length==""){
                $("#divCargoEnlazar").addClass("has-error");
                $("#alertCargo").slideDown('1000');
                return false;
            }else{
                $("#alertCargo").hide('1000');
                $("#divCargoEnlazar").removeClass("has-error");
                $("#divCargoEnlazar").addClass("has-success");


                if (estado.trim().length==""){
                    $("#divEstadoEnlazar").addClass("has-error");
                    $("#alertEstadoEnlazar").slideDown('1000');
                    return false;
                }else{
                    $("#alertEstadoEnlazar").hide('1000');
                    $("#divEstadoEnlazar").removeClass("has-error");
                    $("#divEstadoEnlazar").addClass("has-success");
                }
            }
        }
    };


   var url = "php/enlazarIntegrante.php";

    $.ajax({
        type:'POST',
        url:url,
        data:{
            idIntegrante: idIntegrante,
            idEquipo: equipo,
            idCargo:cargo,
            estado: estado,
            comentario: comentarios
        },
        success: function(datos){

            $('#enlazarForm')[0].reset();
            $('#enlazarForm').load();
            $('#guardado').html(datos).show('1000').delay('2500').hide('200');

            return false;


        }
    });

return false;
}


$('#btnNuevaPromocion').click( function () {
    alert("CLICK");
});


//Busca los integrantes para hacer cambios
$('#buscarPromociones').on('keyup',function(){
    var dato = $('#buscarPromociones').val();
    var url = 'php/promociones.php';
    $.ajax({
        type:'POST',
        url:url,
        data:'numeroPromocion='+dato,
        success: function(datos){
            $('#agrega-registros').html(datos);
        }
    });
    return false;
});


$('#btnRegistrar').click(function(){
    $('#ModalRegistrar2').modal({
        show:true,
        backdrop:'static'
    });
});




