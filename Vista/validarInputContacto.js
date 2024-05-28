var formulario = document.getElementById('formularioContacto');
var nombreCliente = document.getElementById('nombreCliente');
var email = document.getElementById('correoCliente');
var telefono = document.getElementById('telefonoCliente');
var numeroPedido = document.getElementById('numeroPedido');
var mensaje = document.getElementById('notaCliente');
var presionado = document.getElementById('submit');

if(presionado.id == 'submit')
{
	formulario.addEventListener( 'submit', (e) => {
		var nombreError = "";
		var emailError = "";
		var telefonoError = "";
	
		document.getElementById("nombreError").innerHTML = "";
		document.getElementById("emailError").innerHTML = "";
		document.getElementById("telefonoError").innerHTML = "";
	
		var todosLosErrores = [];
	
		nombreCliente.value = String(nombreCliente.value).trim();
		var regNombre = /^[a-zA-Z-' ]*$/;
		   if( !nombreCliente.value.match(regNombre) )
		{
			nombreError = "Solo se permiten letras y espacios";
			document.getElementById( "nombreError" ).innerHTML = nombreError;
			todosLosErrores.push( nombreError );
		}
		
		email.value = String(email.value).trim();
		var regEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
		if( !email.value.match(regEmail) )
		{
			emailError = "Formato de Email Invalido";
			document.getElementById( "emailError" ).innerHTML = emailError;
			todosLosErrores.push( emailError );
		}
	
		if( telefono.value != '' || telefono.value != null )
		{
			telefono.value = String(telefono.value).trim();
			regTel = /^([0-9]{8}|[0-9]{7})*$/;
			if( !telefono.value.match( regTel ) )
			{
				telefonoError = "Introduce un numero de teléfono valido";
				document.getElementById( "telefonoError" ).innerHTML = telefonoError;
				todosLosErrores.push( telefonoError );
			}
		}
	
		if(todosLosErrores.length > 0)
		{
			e.preventDefault();
			document.getElementById( "enviarError" ).innerHTML = "Mensaje no enviado!";
		}
		else
		{
			enviarMensaje();
			document.getElementById( "enviarError" ).innerHTML = "Mensaje enviado!";
			e.preventDefault();
		}
	})
	
	function enviarMensaje() {
		var var_str = "nombreCliente=" + nombreCliente.value + "&clienteEmail=" + email.value + "&clienteMensaje=" + mensaje.value;
	
		if( !telefono.value.length == 0)
		{
			var_str += "&telefonoCliente=" + telefono.value;
		}
	
		if(!numeroPedido.value.length == 0)
		{
			var_str += "&numeroPedido=" + mensaje.numeroPedido;
		}
	
		const xhr = new XMLHttpRequest();
	
		xhr.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200) {
				document.getElementById("enviarError").innerHTML = this.responseText;
			}
		};
	
		xhr.open("POST", "validarInputContacto.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-formulario-urlencoded");
		xhr.send(var_str);
	}
}
