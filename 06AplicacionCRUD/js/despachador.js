// Constante
var READY_STATE_COMPLETE = 4;
var OK = 200;

// Variables
var ajax = null;
var btnInsertar = document.querySelector("#insertar");
var precarga = document.querySelector("#precarga");
var respuesta = document.querySelector("#respuesta");

// Funciones
function objetoAJAX()
{
	if (window.XMLHttpRequest)
	{
		return new XMLHttpRequest;
	}
	else if(window.ActiveXObject)
	{
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
}

function enviarDatos()
{
	precarga.style.display = "block";
	precarga.innerHTML = "<img src='img/loader.gif'/>";

	if (ajax.readyState == READY_STATE_COMPLETE)
	{
		if(ajax.status == OK)
		{
			precarga.innerHTML = null;	// Para quitar la imagen de la precarga
			precarga.style.display = "none"	; // Para ocultar el div.
			respuesta.style.display = 'block'; // Para mostrar el div respuesta
			respuesta.innerHTML = ajax.responseText;

			if(ajax.responseText.indexOf("data-insertar")>-1)
			{
				document.querySelector("#alta-heroe").addEventListener("submit", insertarHeroe);
			}

			if(ajax.responseText.indexOf("data-recargar")>-1) // Si se ha insertado conrrectamente el registro
			{
				setTimeout(window.location.reload(),3000); // Para recargar la página pasados 3 segundos
			}

		}
		else
		{
			alert("El servidor no contestó\nError "+ajax.status+": "+ajax.statusText);
		}
		// alert('funciona');
		// console.log(ajax);
	}
}

function ejecutarAJAX(datos)
{
	ajax = objetoAJAX();
	ajax.onreadystatechange = enviarDatos;
	ajax.open('POST', 'controlador.php');
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(datos);
}

function insertarHeroe(evento)
{
	evento.preventDefault();
	
	// console.log(evento);
	// console.log(evento.target);
	// console.log(evento.target.length);

	var nombre = new Array();
	var valor = new Array();
	var hijosForm = evento.target;
	var datos = "";

	for(var i=1; i<hijosForm.length; i++)
	{
		nombre[i] = hijosForm[i].name;
		valor[i] = hijosForm[i].value;

		datos += nombre[i]+"="+valor[i]+"&";
		// console.log(datos);
	}
	ejecutarAJAX(datos);
}

function altaHeroe(evento)
{
	evento.preventDefault();
	// alert("Funciona");
	var datos = "transaccion=alta";
	ejecutarAJAX(datos);
}

function alCargarDocumento()
{
	btnInsertar.addEventListener("click", altaHeroe)
}

// Eventos
window.addEventListener("load", alCargarDocumento);