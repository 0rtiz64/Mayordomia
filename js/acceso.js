function Ingreso(){

	var nombre = document.getElementById("promo").value;
	var fechajs = $('#password').val();


	if(nombre.trim().length == ""){
            $('#errorUser').html('Selecciona el usuario.').slideDown(500);
            return false;
        }else{
            $('#errorUser').html('').slideUp(300);
            if(fechajs.trim().length == ""){
                    $('#errorContra').html('Ingresa la Contraseña.').slideDown(500);
                    $('#password').focus();
                    return false;
            }else{
                $('#errorContra').html('').slideUp(300);
            }
        }

	return false;
}