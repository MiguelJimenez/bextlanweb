<!-- 
PASOS PARA CONECTARMEN A MYSQL CON PHP
1) Objeto de conexion: $conexion = conexionMySQL();
2) Consulta SQL: $consulta = "SELECT * FROM ...";
3) Ejecutar consulta: $resultado = $conexion->query($consulta);
4) Mostrar Resultados: $fila = $resultado->fetch_assoc()
5) Cerrar conexion: $conexion->close();
 -->

<?php 
require_once "conexion.php";

function listaEditorialesEditada($id)
{
	// Esta función devuelve el nombre de la editorial del superheroe a editar
	
	$mysql = conexionMySQL();
	$sql = "SELECT * FROM editorial";
	$resultado = $mysql->query($sql);

	$lista = "<select id='editorial' name='editorial_slc' required>";

		$lista .= "<option value=''>- - -</option>";
		while ($fila = $resultado->fetch_assoc())
		{
			$selected = ($id == $fila['id_editorial'])?'selected':'';
			
			$lista .= "<option value='".$fila["id_editorial"]."' $selected>".$fila["editorial"]."</option>";
			
		}

	$lista .= "</select>";

	$resultado->free();
	$mysql->close();

	return $lista;
}


function editarHeroe($idHeroe)
{

	$conexion = conexionMySQL();
	$consulta = "SELECT * FROM heroes WHERE id_heroe=$idHeroe";

	if($resultado = $conexion->query($consulta))
	{
		$fila = $resultado->fetch_assoc();

		// Muestro el form con los datos del registro
		$form = "<form id='editar-heroe' class='formulario' data-editar>";
			$form .= "<fieldset>";
			$form .="<legend>Editar Super Héroe:</legend>";
			$form .="<div>";
				$form .="<label for='nombre'>Nombre</label>";
				$form .="<input type='text' id='nombre' name='nombre_txt' value='".$fila['nombre']."' required>";
			$form .="</div>";
			$form .="<div>";
				$form .="<label for='imagen'>Imagen:</label>";
				$form .="<input type='text' id='imagen' name='imagen_txt' value='".$fila['imagen']."' required>";
			$form .="</div>";
			$form .="<div>";
				$form .="<label for='descripcion'>Descripción:</label>";
				$form .="<textarea id='descripcion' name='descripcion_txa' required>".$fila['descripcion']."</textarea>";
			$form .="</div>";
			$form .="<div>";
				$form .="<label for='editorial'>Editorial:</label>";
				$form .=listaEditorialesEditada($fila['editorial']);
			$form .="</div>";
			$form .="<div>";
				$form .="<input type='submit' id='actualizar' name='actualizar_btn' value='Actualizar'>";
				$form .= "<input type='hidden' id='transaccion' name='transaccion' value='actualizar' />";
				$form .= "<input type='hidden' id='idHeroe' name='idHeroe' value='".$fila['id_heroe']."' />";
			$form .="</div>";
			$form .="</fieldset>";
		$form .="</form>";
	$resultado -> free();
	}
	else
	{
		// Muestro un mensaje de error
		$form =  "<div class='error'>Error: No se ejecutó la consulta a la base de datos</div>";
	}

	
	$conexion -> close();
	return printf($form);
}


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
				$tabla.= "<td><a href='#' class='editar' data-id='".$fila['id_heroe']."'>Editar</a></td>";
				$tabla.= "<td><a href='#' class='eliminar' data-id='".$fila['id_heroe']."'>Eliminar</a></td>";
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