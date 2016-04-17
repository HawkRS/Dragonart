/* VALIDADOR DE FORMULARIOS */

function estaVacio(txt){
	if(txt.length === 0 || /^\s+$/.test(txt)){
		return true;
	}
	return false;
}

function correoValido(correo){
	var regex = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
	if(regex.test(correo)){
		return true;
	}
	return false;
}

function contrasenaValida(pass){
	if(pass.length >= 8){
		return true;
	}
	return false;
}

function contrasenasIguales(pass, otroPass){
	if(pass === otroPass){
		return true;
	}
	return false;
}

function ponerError(tempId, div, mensaje){
	$('#div-' + div).addClass('has-error');
	$(tempId).removeClass('hidden');
	$(tempId).text(mensaje);
}

function quitarError(tempId, div){
	$('#div-' + div).removeClass('has-error');
	$(tempId).addClass('hidden');
}

function validarTextArea(txtArea){
	var tempId = '#err-';
	var bandera = true;

	if(estaVacio(txtArea.val())){
		tempId = tempId + txtArea.attr('id');
		if(tempId === '#err-descripcion'){
			ponerError(tempId, txtArea.attr('id'), 'Debes escribir un contenido.');
		}
		else{
			ponerError(tempId, txtArea.attr('id'), 'Debes escribir algo sobre tí.');
		}
		bandera = false;
	}
	else{
		tempId = tempId + txtArea.attr('id');
		quitarError(tempId, txtArea.attr('id'));
		bandera = true;
	}

	return bandera;

}

function validarInputs(inputs){
	
	var bandera = true;
	var temp;
	var tempPass = '';
	var tempId = '#err-';

	for(var i = 0; i < inputs.length; i++){
		temp = inputs.eq(i);

		switch(temp.attr('id')){
			case 'correo':
				bandera = !(estaVacio(temp.val()));
				if(!bandera){
					tempId = tempId + temp.attr('id');
					ponerError(tempId, temp.attr('id'), 'Debes escribir un correo.');
				}
				else{
					quitarError(tempId, temp.attr('id'));
					bandera = correoValido(temp.val());
					if(!bandera){
						tempId = tempId + temp.attr('id');
						ponerError(tempId, temp.attr('id'), 'El correo ingresado es inválido.');
					}
					else{
						tempId = tempId + temp.attr('id');
						quitarError(tempId, temp.attr('id'));
					}
				}
				break;

			case 'password':
				tempPass = temp.val();
				bandera = !(estaVacio(temp.val()));
				if(!bandera){
					tempId = tempId + temp.attr('id');
					ponerError(tempId, temp.attr('id'), 'Debes escribir una contraseña (Mínimo 8 caracteres).');
				}
				else{
					quitarError(tempId, temp.attr('id'));
					bandera = contrasenaValida(tempPass);
					if(!bandera){
						tempId = tempId + temp.attr('id');
						ponerError(tempId, temp.attr('id'), 'La contraseña debe ser mínimo de 8 caracteres.');
					}
					else{
						tempId = tempId + temp.attr('id');
						quitarError(tempId, temp.attr('id'));
					}
				}
				break;

			case 'logPass':
				tempPass = temp.val();
				bandera = !(estaVacio(temp.val()));
				if(!bandera){
					tempId = tempId + temp.attr('id');
					ponerError(tempId, temp.attr('id'), 'Debes escribir una contraseña.');
				}
				else{
					quitarError(tempId, temp.attr('id'));
					bandera = contrasenaValida(tempPass);
					if(!bandera){
						tempId = tempId + temp.attr('id');
						ponerError(tempId, temp.attr('id'), 'La contraseña es inválida.');
					}
					else{
						tempId = tempId + temp.attr('id');
						quitarError(tempId, temp.attr('id'));
					}
				}
				break;

			case 'passwordConfirmacion':
				bandera = !(estaVacio(temp.val()));
				if(!bandera){
					tempId = tempId + temp.attr('id');
					ponerError(tempId, temp.attr('id'), 'Debes repetir tu contraseña.');
				}
				else{
					quitarError(tempId, temp.attr('id'));
					bandera = contrasenasIguales(tempPass, temp.val());
					if(!bandera){
						tempId = tempId + temp.attr('id');
						ponerError(tempId, temp.attr('id'), 'La contraseña debe ser igual al del campo anterior.');
					}
					else{
						tempId = tempId + temp.attr('id');
						quitarError(tempId, temp.attr('id'));
					}
				}
				break;

			default:
				bandera = !(estaVacio(temp.val()));
				if(!bandera){
					tempId = tempId + temp.attr('id');
					ponerError(tempId, temp.attr('id'), 'No debes dejar este campo vacío.');
				}
				else{
					tempId = tempId + temp.attr('id');
					quitarError(tempId, temp.attr('id'));
				}
				break;
		}

		tempId = '#err-';
	}

	return bandera;

}