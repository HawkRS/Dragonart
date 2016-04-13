/* VALIDADOR DE FORMULARIOS */

function estaVacio(txt){
	if(txt.length === 0 || /^\s+$/.test(txt)){
		return true;
	}
	return false;
}

function correoValido(correo){
	var regex = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
	if(!(estaVacio(correo)) && regex.test(correo)){
		return true;
	}
	return false;
}

function contrasenaValida(pass){
	if(!estaVacio(pass) && pass.length >= 8){
		return true;
	}
	return false;
}

function contrasenasIguales(pass, otroPass){
	if((!estaVacio(pass) && !estaVacio(otroPass)) && pass === otroPass){
		return true;
	}
	return false;
}

function validarInputs(inputs){
	
	var bandera = true;
	var temp;
	var tempPass = '';

	for(var i = 0; i < inputs.length && bandera; i++){
		temp = inputs.eq(i);

		switch(temp.attr('id')){
			case 'correo':
				bandera = correoValido(temp.val());
				break;

			case 'password':
				tempPass = temp.val();
				bandera = contrasenaValida(tempPass);
				break;

			case 'passwordConfirmacion':
				bandera = contrasenasIguales(tempPass, temp.val());
				break;

			default:
				bandera = !(estaVacio(temp.val()));
				break;
		}
	}

	return bandera;

}