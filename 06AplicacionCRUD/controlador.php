<?php 
require "vistas.php";
require "modelo.php";

/*
Aplicacion CRUD
PHP tiene 2 métodos de envío de información de datos: POST y GET

'Create' 	afecta BD 		INSERT (SQL)	POST 	Modelo
'Read'		NO afecta BD 	SELECT (SQL)	GET 	Vista
'Update'	afecta BD 		UPDATE (SQL)	POST 	Modelo
'Delete'	afecta BD 		DELETE (SQL)	POST 	Modelo
*/

$transaccion = $_POST['transaccion'];

function ejecutarTransaccion($transaccion)
{
	if ($transaccion == 'alta')
	{
		// Mostrar formulario de alta
		altaHeroe();
	}
	else if($transaccion == 'insertar')
	{
		// Procesar los datos del formulario de alta e insertarlos en MySQL
	}
	else if($transaccion == 'eliminar')
	{
		// Eliminar de MySQL el registro solicitado
	}
	else if($transaccion == 'editar')
	{
		// Traer los datos del registro a modificar en un formulario
	}
	else if($transaccion == 'actualizar')
	{
		// Modificar en MySQL los datos del registro modificado
	}
}

ejecutarTransaccion($transaccion);


?>

