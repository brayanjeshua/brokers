<?php
	session_start();
	require 'funcs/conexion.php';
	include 'funcs/funcs.php';

	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}
	$fecha_hoy = date("Y-m-d");

	$idUsuario = $_SESSION['id_usuario'];
	/*echo $idUsuario;*/

	/*Consulta para datos de el usuario*/
	$sql = "SELECT id, nombre FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();


	/*Consulta para datos de trabajo de los Brokers*/
	//$sql2 = "SELECT id_usuario,date FROM trabajo t INNER JOIN usuarios u ON t.id_usuario = u.id WHERE u.id = '$idUsuario'";
	$sql2 = "SELECT * FROM trabajo WHERE trabajo.id_usuario = '$idUsuario' AND date = '$fecha_hoy'";
	$result2 = $mysqli->query($sql2);
	$row2 = $result2->fetch_assoc();

	/*Consulta para leer base de datos de Trabajo*/
	$sql3 = "SELECT * FROM trabajo t INNER JOIN usuarios u ON t.id_usuario = u.id ORDER BY t.date";
	$result3 = mysqli_query($mysqli,$sql3);


	/*Consulta para Fechas*/
	$sql4 = "SELECT date FROM trabajo";
	$result4 = $mysqli->query($sql4);
	$row4 = $result4->fetch_assoc();

	/*convierto en formato UNIX FECHA para hacer la comparacion fecha de hoy*/
	$fecha_hoy = date("Y-m-d");
?>

<html>
	<head>
		<title>Welcome</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.js" charset="utf-8"></script>

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
						<?php /*Condicion para Validar que tipo de Usuario Entra*/ ?>

						<?php if($_SESSION['tipo_usuario']==1) { ?>
							<ul class='nav navbar-nav'>
								<li><a href='#'>Administrar Usuarios</a></li>
							</ul>
							<ul class='nav navbar-nav navbar-right'>
								<li><a href='logout.php'>Cerrar Sesi&oacute;n</a></li>
							</ul>
							<br>
								<table class="table table-dark container tablita">
									<thead>
										<tr>
											<th scope="col">DATE</th>
											<th scope="col">BROKER</th>
											<th scope="col">100 DAILY CALLS</th>
											<th scope="col">50 DAILY LEADS</th>
											<th scope="col">20 FOLLOW UP</th>
											<th scope="col">25 DAILY MAILS</th>
											<th scope="col">DAILY LOAD</th>
										</tr>
									</thead>
									<tbody>

									<?php
									while($row3 = $result3->fetch_assoc()){

										if ($row3["calls"] == 1 ) {
											$row3["calls"] = 'SI';
										} else {
											$row3["calls"] = 'NO';
										}
										if ($row3["leads"] == 1 ) {
											$row3["leads"] = 'SI';
										} else {
											$row3["leads"] = 'NO';
										}
										if ($row3["followup"] == 1 ) {
											$row3["followup"] = 'SI';
										} else {
											$row3["followup"] = 'NO';
										}
										if ($row3["mails"] == 1 ) {
											$row3["mails"] = 'SI';
										} else {
											$row3["mails"] = 'NO';
										}
										if ($row3["loads"] == 1 ) {
											$row3["loads"] = 'SI';
										} else {
											$row3["loads"] = 'NO';
										}
										echo '<tr>';
												echo'<th scope="col">'.$row3["date"].'</th>';
												echo'<th scope="col">'.$row3["nombre"].'</th>';
												echo'<th scope="col">'.$row3["calls"].'</th>';
												echo'<th scope="col">'.$row3["leads"].'</th>';
												echo'<th scope="col">'.$row3["followup"].'</th>';
												echo'<th scope="col">'.$row3["mails"].'</th>';
												echo'<th scope="col">'.$row3["loads"].'</th>';
										echo '</tr>';
									}
									?>
									</tbody>
								</table>
							</ul>
						<?php } else {?>

								<li><a href="#">Ver mi Perfil</a></li>
							<ul class='nav navbar-nav navbar-right'>
								<li><a href='logout.php'>Cerrar Sesi&oacute;n</a></li>
							</ul>
								<div class="jumbotron">
									<h2><?php echo 'Bienvenid@ '.utf8_decode($row['nombre']).'Today '."El id es: ".$row['id']." La fecha es ".$fecha_hoy; ?></h1>
								<?php /*Condicion de Fecha para Brokers*/ ?>
								<?php	//if (date("Y-m-d") == $fecha_hoy) { ?>

									<?php /*Condicion ¿Se hizo el registro del trabajo? para Brokers*/ ?>
								<?php echo $sql2; ?>
								<?php if (($row2['id_usuario'] <> $idUsuario) OR ($row2['date'] <> $fecha_hoy)) {?>

										<form action="comprobar.php" method="post">
											<table class="table table-dark container tablita">
												<thead>
													<tr>
														<th scope="col">BROKER</th>
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
																<td><input type="checkbox" name="calls" value="1" id="myCheckbox"></td>
																<td><input type="checkbox" name="leads" value="1" id="myCheckbox2"></td>
																<td><input type="checkbox" name="followup" value="1" id="myCheckbox3"></td>
																<td><input type="checkbox" name="mails" value="1" id="myCheckbox4"></td>
																<td><input type="checkbox" name="loads" value="1" id="tc"></td>
																<td><input type="submit" name="enviar" value="SUBMIT"></td>
															</tr>
												</tbody>
											</table>
										<?php } else {?>
										<h1>YA HICISTE TU REGISTRO EN LA BASE DE DATOS</h1>
									<?php } ?>
								<?php// } ?>
							<?php } ?>

					</div>
				</div>
			</nav>

						<script type="text/javascript">
						$('#tc').click(function() {
						if ( $('#myCheckbox').attr('checked')) {
								$('#myCheckbox').attr('checked', false);
								$('#myCheckbox2').attr('checked', false);
								$('#myCheckbox3').attr('checked', false);
								$('#myCheckbox4').attr('checked', false);

						} else {
								$('#myCheckbox').attr('checked', 'checked');
								$('#myCheckbox2').attr('checked', 'checked');
								$('#myCheckbox3').attr('checked', 'checked');
								$('#myCheckbox4').attr('checked', 'checked');
						}
						});
						</script>
					</form>
				<br />
			</div>
		</div>
	</body>
</html>
