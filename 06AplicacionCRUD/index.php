<?php require "vistas.php" ; ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Aplicación CRUD Super Héroes</title>
	<link rel="stylesheet" href="css/super-heroes.css">
</head>
<body>
	<header id="cabecera">
		<h1>Super Héroes</h1>
		<div><img src="img/super-heroes.png" alt="Súper Héroes"></div>
		<a href="#" id="insertar">Insertar</a>
	</header>
	<section id="contenido">
		<!-- <p>Aquí va el contenido</p> -->
		<div id="respuesta"></div>
		<div id="precarga"></div>
		<?php mostrarHeroes(); ?>
	</section>
	<script type="text/javascript" src="js/despachador.js"></script>
</body>
</html>