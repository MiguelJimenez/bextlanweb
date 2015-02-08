<?php 
require_once "conexion.php";

function mostrarHeroes()
{
	$mysql = conexionMySQL();	
	$sql = "SELECT * FROM heroes ORDER BY id_heroe DESC";

	if($resultado = $mysql->query($sql))
	{
		$tabla = "<table id='tabla-heroes' class='tabla'>";
			$tabla.= "<thead>";
				$tabla.= "<tr>";
					$tabla.= "<th>Id Héroe</th>";
					$tabla.= "<th>Nombre</th>";
					$tabla.= "<th>Imagen</th>";
					$tabla.= "<th>Descripción</th>";
					$tabla.= "<th>Editorial</th>";
					$tabla.= "<th></th>";
					$tabla.= "<th></th>";
				$tabla.= "</tr>";
			$tabla.= "</thead>";
			$tabla.= "<tbody>";

			$tabla.= "</tbody>";
		$tabla.= "</table>";

		$respuesta = $tabla;
	}
	else
	{
		$respuesta = "<div class='error'>Error: No se ejecutó la consulta a la base de datos</div>";
	}
	return printf($respuesta);
}
?>