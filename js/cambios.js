function cambiosPersona(){
  var civil = document.getElementById("ECC").value;
  var genero = document.getElementById("GFM").value;
  var transporte = document.getElementById("OCT").value;

  var num_integrante = $('#id-prod').val();
  var num_identidad = $('#numero_I').val();
  var nombreI = $('#nombreI').val();
  var direccion1 = $('#commentEditar').val();

  var cumplea = $('#fecha_cumple').val();

  var cel1 = $('#num_cel').val();
  var tel1 = $('#num_tel').val();
  var est = document.getElementById("estados").value;

  var equipo = document.getElementById("CambioE").value;
  var cargos= document.getElementById("Cargos").value;
  var promo= document.getElementById("CambioP").value;



  if(civil.trim().length == ""){
    $('#alertEstadoCambios').slideDown('1000');
    $('#divCivil1').addClass("has-error");
    return false;
  }else{
   $('#alertEstadoCambios').hide('1000');
   $('#divCivil1').removeClass('has-error');
   $('#divCivil1').addClass('has-success');

    if(genero.trim().length =="") {
        $('#alertGeneroCambios').slideDown('1000');
        $('#divGenero1').addClass("has-error");
        return false;
      }else{
        $('#alertGeneroCambios').hide('1000');
        $('#divGenero1').removeClass('has-error');
        $('#divGenero1').addClass('has-success');

        if(transporte.trim().length == ""){
            $('#alertTransporteCambios').slideDown('1000');
            $('#divTransporte1').addClass("has-error");
            return false;
        }else{
            $('#alertTransporteCambios').hide('1000');
            $('#divTransporte1').removeClass('has-error');
            $('#divTransporte1').addClass('has-success');
            if (num_identidad.trim().length ==""){
                $('#alertIdentidadCambios').slideDown('1000');
                $('#identidadCambios').addClass("has-error");
                return false;
            }else{
                $('#alertIdentidadCambios').hide('1000');
                $('#identidadCambios').removeClass('has-error');
                $('#identidadCambios').addClass('has-success');

                if(nombreI.trim().length ==""){
                    $('#alertNombreCambios').slideDown('1000');
                    $('#nombreCambio').addClass("has-error");
                    return false;
                }else{
                    $('#alertNombreCambios').hide('1000');
                    $('#nombreCambio').removeClass('has-error');
                    $('#nombreCambio').addClass('has-success');

                     if (cumplea.trim().length ==""){
                         $('#alertFechaCambios').slideDown('1000');
                         $('#fechaCambios').addClass("has-error");
                         return false;
                     }else{
                         $('#alertFechaCambios').hide('1000');
                         $('#fechaCambios').removeClass('has-error');
                         $('#fechaCambios').addClass('has-success');

                          if (cel1.trim().length ==""){
                              $('#alertTelCambios').slideDown('1000');
                              $('#celCambios').addClass("has-error");
                              return false;
                          }else{
                              $('#alertTelCambios').hide('1000');
                              $('#celCambios').removeClass('has-error');
                              $('#celCambios').addClass('has-success');

                                if (est.trim().length == ""){
                                    $('#alertEstadoIntCambios').slideDown('1000');
                                    $('#estadoCambios').addClass("has-error");
                                    return false;
                                }else{
                                    $('#alertEstadoIntCambios').hide('1000');
                                    $('#estadoCambios').removeClass('has-error');
                                    $('#estadoCambios').addClass('has-success');

                                      if (promo.trim().length ==""){
                                          $('#alertPromocionCambios').slideDown('1000');
                                          $('#CambioP').addClass("has-error");
                                          return false;
                                      }else {
                                          $('#alertPromocionCambios').hide('1000');
                                          $('#CambioP').removeClass('has-error');
                                          $('#CambioP').addClass('has-success');

                                            if (equipo.trim().length ==""){
                                                $('#alertEquipoCambios').slideDown('1000');
                                                $('#CambioE').addClass("has-error");
                                                return false;
                                            }else{
                                                $('#alertEquipoCambios').hide('1000');
                                                $('#CambioE').removeClass('has-error');
                                                $('#CambioE').addClass('has-success');

                                                  if (cargos.trim().length ==""){
                                                      $('#alertCargoCambios').slideDown('1000');
                                                      $('#Cargos').addClass("has-error");
                                                      return false;
                                                  }else{
                                                      $('#alertCargoCambios').hide('1000');
                                                      $('#Cargos').removeClass('has-error');
                                                      $('#Cargos').addClass('has-success');
                                                  }
                                            }
                                      }
                                }
                          }
                     }
                }
            }
        }
    }
  }


  var url = 'php/save_cambios.php';

    $.ajax({
    type:'POST',
    url:url,
    data:{ECIVIL:civil,EGENERO:genero,ETRANSPORTE:transporte,IDENTIDAD1: num_identidad,INTEGRANTE:num_integrante,NOMBREI:nombreI,CUMPLE:cumplea,CEL1:cel1,TEL1:tel1,ESTADO1:est,DIRECCION:direccion1,EQUIPO:equipo,CARGOS:cargos},
    success: function(datos){
      $('#formulario')[0].reset();
      $('#num_identidad').focus();
      $('#Mensaje').html(datos);
    
      return false;
    }
  });

return false;

}