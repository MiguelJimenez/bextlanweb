<meta charset="utf-8">
<?php 
// include('config.php');
require_once "config.php";

function conexionMySQL()
{
	// echo "Hola, por favor no usen echo's para imprimir en pantalla";
	$conexion = new mysqli(SERVER, USER, PASS, DB);

	if ($conexion->connect_error)
	{
		$error = "<div class='error'>";
		$error.="Error de Conexión Nº <b>".$conexion->connect_errno."</b> Mensaje del error: <mark>".$conexion->connect_error."</mark>";
		$error.="</div>";
		die($error);
	}
	else
	{
		// $formato = "<div class='mensaje'>Conexión exitosa: <b>".$conexion->host_info."</b></div>";

		// echo($formato);

		// $formato = "<div class='mensaje'>Conexión exitosa: <b>%s</b></div>";
		// printf($formato, $conexion->host_info);
	}
	$conexion->query("SET CHARACTER SET UTF8");
	return $conexion;
	
}
// conexionMySQL();
?>