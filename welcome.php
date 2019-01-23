<?php
	session_start();
	require 'funcs/conexion.php';
	include 'funcs/funcs.php';

	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}

	$idUsuario = $_SESSION['id_usuario'];

	$sql = "SELECT id, nombre FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sql);

	$row = $result->fetch_assoc();
?>

<html>
	<head>
		<title>Welcome</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>

		<style>
			body {
			padding-top: 20px;
			padding-bottom: 20px;
			}
			.tablita {
			  max-width:70%;
			  margin-top:50px;
				text-align:center;
				margin: auto;
			}
		</style>
	</head>

	<body>
		<div class="container">

			<nav class='navbar navbar-default'>
				<div class='container-fluid'>
					<div class='navbar-header'>
						<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
							<span class='sr-only'>Men&uacute;</span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
						</button>
					</div>

					<div id='navbar' class='navbar-collapse collapse'>
						<ul class='nav navbar-nav'>
							<li class='active'><a href='welcome.php'>Inicio</a></li>
						</ul>

						<?php if($_SESSION['tipo_usuario']==1) { ?>
							<ul class='nav navbar-nav'>
								<li><a href='#'>Administrar Usuarios</a></li>
							</ul>
						<?php } ?>

						<ul class='nav navbar-nav navbar-right'>
							<li><a href='logout.php'>Cerrar Sesi&oacute;n</a></li>
						</ul>
					</div>
				</div>
			</nav>

			<div class="jumbotron">
				<h2><?php echo 'Bienvenid@ '.utf8_decode($row['nombre']); ?></h1>

					<form action="comprobar.php" method="post">
						<table class="table table-dark container tablita">
							<thead>
								<tr>
									<th scope="col">BROKERS</th>
									<th scope="col">100 DAILY CALLS</th>
									<th scope="col">50 DAILY LEADS</th>
									<th scope="col">20 FOLLOW UP</th>
									<th scope="col">25 DAILY MAILS</th>
									<th scope="col">DAILY LOAD</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row"><?php echo utf8_decode($row['nombre']); ?></th>
											<td><input type="checkbox" name="calls" value="1"></td>
											<td><input type="checkbox" name="leads" value="1"></td>
											<td><input type="checkbox" name="followup" value="1"></td>
											<td><input type="checkbox" name="mails" value="1"></td>
											<td><input type="checkbox" name="load" value="1"></td>
										</tr>
							</tbody>
						</table>
						<input type="submit" name="enviar" value="Send">
					</form>
				<br />
			</div>
		</div>
	</body>
</html>
