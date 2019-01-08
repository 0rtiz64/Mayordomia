$(document).ready(function () {
    $("input:submit").click(function () {
        return false;
    })
//contador();
});

var cont =0;
function contador(){
    console.log(cont);
    cont++;
var url = 'php/contadorIntegracion.php';
    $.ajax({
        type:'POST',
        url:url,
        data: {
            phpDato: 1
        },
        success: function (datos) {
            $('#datos').html(datos);
            return false;
        }
    });
    return false;
}
setInterval('contador()',1000);