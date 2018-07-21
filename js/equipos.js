
$(document).ready(function(){


});
//LLAMAR EQUIPOS
function equiposPromocion() {
    var  dato = 1;
    var url = 'php/llamarEquipos.php';
    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpDato: dato
        },
        success: function (datos) {
            $('#equiposActivos').html(datos);
            return false;
        }
    });
    return false;
}

//GUARDAR EQUIPO
function guardarEquipo() {
    var idPromcion = $('#idPromocion').val();
    var numero = $('#numEquipoInput').val();
    var nombre = $('#nombreEquipoInput').val();
    var past1 = $('#idPast1').val();
    var past2 = $('#idPast2').val();


if(past1.trim().length==""){
    $('#past1Div').addClass('has-error');
    $('#alertPastoreador').slideDown(300);
    return false;
}else{
    $('#past1Div').removeClass('has-error');
    $('#past1Div').addClass('has-success');
    $('#alertPastoreador').slideUp(300);


if(numero.trim().length == ""){

$('#numEquipo').addClass('has-error');
$('#alertNumeroEquipo').slideDown(200);
    return false;
}else{
    $('#numEquipo').removeClass('has-error');
    $('#numEquipo').addClass('has-success');
    $('#alertNumeroEquipo').slideUp(300);

        if(nombre.trim().length ==""){
            $('#nombreEquipo').addClass('has-error');
            $('#alertNombreEquipo').slideDown(200);
            return false;
        }else{
            $('#nombreEquipo').removeClass('has-error');
            $('#nombreEquipo').addClass('has-success');
            $('#alertNombreEquipo').slideUp(300);
        }
}
}


    var url = 'php/guardarEquipo.php';
    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpidPromocion: idPromcion,
            phpnumeroEquipo: numero,
            phpnombreEquipo: nombre,
            phpPast1:past1,
            phpPast2:past2
        },
        success: function (datos) {
           // $('#formularioEquipo')[0].reset();
            $('#numEquipoInput').val("");
            $('#nombreEquipoInput').val("");
            $('#pastoreador1').val("");
            $('#pastoreador2').val("");
            $('#idPast1').val("");
            $('#idPast2').val("");
            $('#guardado').html(datos).show(200).delay(2500).hide(200);
            return false;
        }
    });
    return false;
}

//LLAMAR EQUIPO PARA EDITAR
function editarEquipo(id){

    $("#Mensaje").empty();
    var url = 'php/editarEquipo.php';
    $.ajax({
        type:'POST',
        url:url,
        data:'id='+id,
        success: function(valores){
            var datos = eval(valores);

            $('#idEquipo').val(id);
            $('#numEquipoEdit').val(datos[1]);
            $('#nombreEquipoEdit').val(datos[2]);


            $('#modalEditarEquipo').modal({
                show:true,
                backdrop:'static'
            });
            return false;
        }
    });
    return false;
}

//EDITAR EQUIPO
function cambiosEquipo(){
    var id = $('#idEquipo').val();
    var numero = $('#numEquipoEdit').val();
    var nombre = $('#nombreEquipoEdit').val();

if(numero.trim().length ==""){
    $('#divNUMERO').addClass('has-error');
    $('#alertNumeroEditCambios').slideDown(200);
    return false;
}else{
    $('#divNUMERO').removeClass('has-error');
    $('#divNUMERO').addClass('has-success');
    $('#alertNumeroEditCambios').slideUp(300);
     if(nombre.trim().length == ""){
         $('#divNOMBRE').add('has-error');
         $('#alertNombreEditCambios').slideDown(200);
         return false;
     }else{
         $('#divNOMBRE').removeClass('has-error');
         $('#divNOMBRE').addClass('has-success');
         $('#alertNombreEditCambios').slideUp(300);
     }
}



    var url = 'php/cambiosEquipos.php';

    $.ajax({
        type:'POST',
        url:url,
        data:{phpId:id,
            phpNumero:numero,
            phpNombre:nombre
        },
        success: function(datos){
            $('#numEquipoEdit').focus();
            $('#Mensaje').html(datos);

            return false;
        }
    });

    return false;

}

//Abrir Modal Pastoreadores
function abrir() {
    $('#scrollingModalEdit').modal({
        show:true,
        backdrop:'static'
    });

};


$('#buscarPastoreadorInput').on('keyup',function(){
    var dato = $('#buscarPastoreadorInput').val();
    var url = 'php/buscar_Pastoreador.php';

    $.ajax({
        type:'POST',
        url:url,
        data:'nombrePersona='+dato,
        success: function(datos){
            $('#pastEncontrado').html(datos);
        }
    });
    return false;
});

function seleccionar(id,nombre) {
var inicialPast1= $('#pastoreador1').val();
var inicialPast2= $('#pastoreador2').val();

if (inicialPast1.trim().length==""){
    $('#pastoreador1').val(nombre);
    $('#idPast1').val(id);
    $('#past1Div').addClass('has-success');
    $('#alertPastoreadorAsignar1').show(200).delay(2500).hide(200);

}else{
    $('#pastoreador2').val(nombre);
    $('#idPast2').val(id);
    $('#past2Div').addClass('has-success');
    $('#alertPastoreadorAsignar2').show(200).delay(2500).hide(200);

}


}

//REMOVER PAST 2 DE INPUT
function removerPast2() {
    $('#pastoreador2').val("");
}

//REMOVER PAST 2 DE INPUT
function removerPast1() {
    $('#pastoreador1').val("");
}