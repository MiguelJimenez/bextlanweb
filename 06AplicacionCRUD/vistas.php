<?php 
require_once "conexion.php";

function listaEditoriales()
{
	// Esta función generará el select de las editoriales
	$mysql = conexionMySQL();
	$sql = "SELECT * FROM editorial";

	$resultado = $mysql->query($sql);

	$lista = "<select id='editorial' name='editorial_slc' required>";

		$lista .= "<option value=''>- - -</option>";
		while ($fila = $resultado->fetch_assoc())
		{
			$lista .= "<option value='".$fila["id_editorial"]."'>".$fila["editorial"]."</option>";
			// $lista .= $fila["id_editorial"]."-".$fila["editorial"];
		}

	$lista .= "</select>";

	$resultado->free();
	$mysql->close();

	return $lista;
}

function altaHeroe()
{
	$form = "<form id='alta-heroe' class='formulario' data-insertar>";
		$form .= "<fieldset>";
			$form .="<legend>Alta de Super Héroe:</legend>";
			$form .="<div>";
				$form .="<label for='nombre'>Nombre</label>";
				$form .="<input type='text' id='nombre' name='nombre_txt' required>";
			$form .="</div>";
			$form .="<div>";
				$form .="<label for='imagen'>Imagen:</label>";
				$form .="<input type='text' id='imagen' name='imagen_txt' required>";
			$form .="</div>";
			$form .="<div>";
				$form .="<label for='descripcion'>Descripción:</label>";
				$form .="<textarea id='descripcion' name='descripcion_txa' required></textarea>";
			$form .="</div>";
			$form .="<div>";
				$form .="<label for='editorial'>Editorial:</label>";
				$form .=listaEditoriales();
			$form .="</div>";
			$form .="<div>";
				$form .="<input type='submit' id='insertar-btn' name='insertar_btn' value='Insertar'>";
				$form .= "<input type='hidden' id='transaccion' name='transaccion' value='insertar' />";
			$form .="</div>";
		$form .="</fieldset>";
	$form .="</form>";

	return printf($form);
}

function catalogoEditoriales()
{
	$editoriales = Array();

	$mysql = conexionMySQL();
	$sql = "SELECT * FROM editorial";

	if($resultado = $mysql->query($sql))
	{
		while($fila = $resultado->fetch_assoc())
		{
			$editoriales[$fila['id_editorial']] = $fila['editorial'];
		}
		$resultado->free();
	}
	$mysql->close();

	return $editoriales;
	// print_r($editoriales);

}
 // catalogoEditoriales();

function mostrarHeroes()
{
	$editorial = catalogoEditoriales();
	$mysql = conexionMySQL();	
	$sql = "SELECT * FROM heroes ORDER BY id_heroe DESC";

	if($resultado = $mysql->query($sql))
	{
		if(mysqli_num_rows($resultado) == 0)
		{
			$respuesta = "<div class='error'>No existen registros de Super Héroes. La base de datos está vacía</div>";
		}
		else
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
			while($fila = $resultado->fetch_assoc())
			{
				$tabla.= "<tr>";
				$tabla.= "<td>".$fila['id_heroe']."</td>";
				$tabla.= "<td><h2>".$fila['nombre']."</h2></td>";
				$tabla.= "<td><img src='img/".$fila['imagen']."' /></td>";
				$tabla.= "<td><p>".$fila['descripcion']."</p></td>";
				$tabla.= "<td><h3>".$editorial[$fila["editorial"]]."</h3></td>";
				$tabla.= "<td>Botón editar</td>";
				$tabla.= "<td>Botón eliminar</td>";
				$tabla.= "</tr>";
			}
			$resultado->free(); // Para liberar memoria una vez mostrados los datos
			$tabla.= "</tbody>";
			$tabla.= "</table>";

			$respuesta = $tabla;
		}
	}
	else
	{
		$respuesta = "<div class='error'>Error: No se ejecutó la consulta a la base de datos</div>";
	}
	$mysql->close();
	return printf($respuesta);
}
?>