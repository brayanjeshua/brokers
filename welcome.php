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

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"  integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/estilos.css">
	</head>

	<body>

		<div class="container">

			<nav class='navbar'>

						<ul class='nav nav-tabs justify-content-center'>

							<li class='nav-item'><a class="nav-link active" href='welcome.php'>Inicio</a></li>

						<?php /*Condicion para Validar que tipo de Usuario Entra*/ ?>
						<?php if($_SESSION['tipo_usuario']==1) { ?>

								<li class='nav-item'><a class="nav-link" href='#'>Administrar Usuarios</a></li>

								<li class='nav-item'><a class="nav-link" href='logout.php'>Cerrar Sesi&oacute;n</a></li>

								<table class="table table-hover table-striped">
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
												echo'<th id="nombre" scope="col">'.$row3["nombre"].'</th>';
												echo'<th scope="col">'.$row3["calls"].'</th>';
												echo'<th scope="col">'.$row3["leads"].'</th>';
												echo'<th scope="col">'.$row3["followup"].'</th>';
												echo'<th scope="col">'.$row3["mails"].'</th>';
												echo'<th scope="col">'.$row3["loads"].'</th>';
										echo '</tr>';
									}
									?>
								</ul>
								</tbody>

								</table>
						<?php } else {?>

								<li class="nav-item"><a class="nav-link" href="#">Ver mi Perfil</a></li>

								<li class="nav-item"><a class="nav-link" href='logout.php'>Cerrar Sesi&oacute;n</a></li>

								<div class="jumbotron brokers">

									<!--h4><?php //echo 'Bienvenid@ '.$row['nombre'] ?></h4-->

									<?php /*Condicion ¿Se hizo el registro del trabajo? para Brokers*/ ?>
								<?php if (($row2['id_usuario'] <> $idUsuario) OR ($row2['date'] <> $fecha_hoy)) {?>
											<h1>Daily Goals! from <?php echo utf8_decode($row['nombre']); ?></h1>
											<br>
											<table id="redondeo" class="table table-responsive table-borderless table-striped table-light">
												<form action="comprobar.php" method="post">
												<thead>
													<tr>
														<th scope="col">100 DAILY CALLS</th>
														<th scope="col">50 DAILY LEADS</th>
														<th scope="col">20 FOLLOW UP</th>
														<th scope="col">25 DAILY MAILS</th>
														<th scope="col">DAILY LOAD</th>
													</tr>
												</thead>
													<tr>
														<!--th scope="row" id="nombre"><?php // echo utf8_decode($row['nombre']); ?></th-->
																<td>
																	<div class="custom-control custom-switch">
																	<input type="checkbox" name="calls" value="1" class="custom-control-input" id="myCheckbox">
																	<label class="custom-control-label" for="myCheckbox">Done</label>
																	</div>
																</td>
																<td>
																	<div class="custom-control custom-switch">
																	<input type="checkbox" name="leads" value="1" class="custom-control-input" id="myCheckbox2">
																	<label class="custom-control-label" for="myCheckbox2">Done</label>
																	</div>
																</td>
																<td>
																	<div class="custom-control custom-switch">
																	<input type="checkbox" name="followup" value="1" class="custom-control-input" id="myCheckbox3">
																	<label class="custom-control-label" for="myCheckbox3">Done</label>
																	</div>
																</td>
																<td>
																	<div class="custom-control custom-switch">
																	<input type="checkbox" name="mails" value="1" class="custom-control-input" id="myCheckbox4">
																	<label class="custom-control-label" for="myCheckbox4">Done</label>
																	</div>
																</td>
																<td>
																	<div class="custom-control custom-switch">
																	<input type="checkbox" name="loads" value="1" class="custom-control-input" id="tc">
																	<label class="custom-control-label" for="tc">Done</label>
																	</div>
																</td>
																<!--td><input type="checkbox" name="leads" value="1" id="myCheckbox"></td>
																<td><input type="checkbox" name="leads" value="1" id="myCheckbox2"></td>
																<td><input type="checkbox" name="followup" value="1" id="myCheckbox3"></td>
																<td><input type="checkbox" name="mails" value="1" id="myCheckbox4"></td>
																<td><input type="checkbox" name="loads" value="1" id="tc"></td-->
																<td><input class="btn btn-primary btn-sm" type="submit" name="enviar" value="SUBMIT"></td>
															</tr>
												</tbody>
											</form>
											</table>
										<?php } else {?>
										<h1>YA HICISTE TU REGISTRO EN LA BASE DE DATOS</h1>
									<?php } ?>
								<?php// } ?>
							<?php } ?>
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
				<br />
		</div>
	</body>
</html>
