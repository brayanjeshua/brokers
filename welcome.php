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

	// $sql3 = "SELECT date,nombre,calls,leads,followup,mails,loads
	// 				FROM trabajo t INNER JOIN usuarios u ON t.id_usuario = u.id ORDER BY t.date";
	// $result3 = mysqli_query($mysqli,$sql3);

	$query = "SELECT date,nombre,calls,leads,followup,mails,loads
					FROM trabajo t INNER JOIN usuarios u ON t.id_usuario = u.id ORDER BY t.date";
	$result3 = $mysqli->query($query);

	/*Consulta para Fechas*/
	$sql4 = "SELECT date FROM trabajo";
	$result4 = $mysqli->query($sql4);
	$row4 = $result4->fetch_assoc();

	/*convierto en formato UNIX FECHA para hacer la comparacion fecha de hoy*/
	$fecha_hoy = date("Y-m-d");
?>

<html>
	<head>
		<title>Daily Goals from <?php echo utf8_decode($row['nombre']); ?> in Tradex Logistics</title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"  integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/estilos.css">
	</head>

	<body class="body-custom">

		<div class="container">

			 <nav class='navbar'>

						<ul class='nav nav-tabs justify-content-center'>

							<li class='nav-item'><a class="nav-link active" href='#'>Home</a></li>

						<?php /*Condicion para Validar que tipo de Usuario Entra*/ ?>
						<?php if($_SESSION['tipo_usuario']==1) { ?>

								<li class='nav-item'><a class="nav-link" href='#'>Manage Users</a></li>

								<li class='nav-item'><a class="nav-link" href='logout.php'>Log out</a></li>

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



										while($row = $result3->fetch_array()){	$rows[] = $row;	}
													$fechaw = $rows[0]['date'];


													if ($rows[0]["calls"] == 1 ) {$rows[0]["calls"] = 'SI';} else {$rows[0]["calls"] = 'NO';}
													if ($rows[0]["leads"] == 1 ) {$rows[0]["leads"] = 'SI';} else {$rows[0]["leads"] = 'NO';}
													if ($rows[0]["followup"] == 1 ) {$rows[0]["followup"] = 'SI';} else {$rows[0]["followup"] = 'NO';}
													if ($rows[0]["mails"] == 1 ) {$rows[0]["mails"] = 'SI';} else {$rows[0]["mails"] = 'NO';}
													if ($rows[0]["loads"] == 1 ) {$rows[0]["loads"] = 'SI';} else {$rows[0]["loads"] = 'NO';}

													echo "<tr><td>".$rows[0]['date']."</td>";
													echo "<td>".$rows[0]['nombre']."</td>";
													echo "<td>".$rows[0]['calls']."</td>";
													echo "<td>".$rows[0]['leads']."</td>";
													echo "<td>".$rows[0]['followup']."</td>";
													echo "<td>".$rows[0]['mails']."</td>";
													echo "<td>".$rows[0]['loads']."</td></tr>";

												for ($i=1; $i < sizeof($rows) ; $i++) {

													if ($rows[$i]["calls"] == 1 ) {$rows[$i]["calls"] = 'SI';} else {$rows[$i]["calls"] = 'NO';}
													if ($rows[$i]["leads"] == 1 ) {$rows[$i]["leads"] = 'SI';} else {$rows[$i]["leads"] = 'NO';}
													if ($rows[$i]["followup"] == 1 ) {$rows[$i]["followup"] = 'SI';} else {$rows[$i]["followup"] = 'NO';}
													if ($rows[$i]["mails"] == 1 ) {$rows[$i]["mails"] = 'SI';} else {$rows[$i]["mails"] = 'NO';}
													if ($rows[$i]["loads"] == 1 ) {$rows[$i]["loads"] = 'SI';} else {$rows[$i]["loads"] = 'NO';}

															$fechax = $rows[$i]['date'];

																if ($fechax !== $fechaw) {
																	$fechaw = $rows[$i]['date'];
																	echo "<tr><td colspan='7'>.</td></tr>";
																}

																echo "<tr><td>".$rows[$i]['date']."</td>";
																echo "<td>".$rows[$i]['nombre']."</td>";
																echo "<td>".$rows[$i]['calls']."</td>";
																echo "<td>".$rows[$i]['leads']."</td>";
																echo "<td>".$rows[$i]['followup']."</td>";
																echo "<td>".$rows[$i]['mails']."</td>";
																echo "<td>".$rows[$i]['loads']."</td></tr>";

												}
									?>
								</ul>
								</tbody>

								</table>
						<?php } else {?>

								<li class="nav-item"><a class="nav-link" href="#">View My Profile</a></li>

								<li class="nav-item"><a class="nav-link" href='logout.php'>Log out</a></li>

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
																<td><input class="btn btn-primary btn-sm" type="submit" name="enviar" value="SUBMIT"></td>
															</tr>
												</tbody>
											</form>
											</table>
										<?php } else {?>
										<h1>You are already registered in the Database</h1>
										<h3 style="text-align:center;">No worries ;)</h3>
										<br>
									<?php } ?>
								<?php// } ?>
							<?php } ?>


						<div class="container" id="correos">
							<div class="row">
<div class="col">
	<iframe src="validamails.php?user=<?php echo $idUsuario ?>" frameborder="0" width="300" height="250" align="middle" draggable="auto">Cambia tu Dispositivo, está muy viejo.</iframe>
</div>
<div class="col" id="listamails">
										<?php

										function getData($idUsuario) {
										 $parameters = array();
										 $arr_results = array();

										 $db = new mysqli('localhost', 'root', '', 'works') or die('Database connection failed');
										 $stmt = $db->prepare("SELECT mail FROM mails WHERE id_usuario=$idUsuario ") or die('Something wrong with prepare query');
										 $stmt->execute();

										 $meta = $stmt->result_metadata();

										 while ( $rows = $meta->fetch_field() ) {

											 $parameters[] = &$row[$rows->name];
										 }

										 call_user_func_array(array($stmt, 'bind_result'), $parameters);

										 while ( $stmt->fetch() ) {
												$x = array();
												foreach( $row as $key => $val ) {
													 $x[$key] = $val;
												}
												$arr_results[] = $x;
										 }

										 return $arr_results;
										}

											$arr_results = getData($idUsuario);

									echo "<div class='col' style='width:300px;height:200px;overflow:auto'>";
										echo
									"<table class='table table-borderless table-striped'>
										<thead class='thead-dark'>
											<tr>
												<th>Lastest Mails</th>
											</tr>
										</thead>";
											 foreach ($arr_results as $row) :
												  echo
												"<tbody>
														<tr>
															<td style='text-align:left'>".$row['mail']."</td>
														</tr>
													</tbody>";
											 endforeach;
											echo "</table>";
									echo "</div>"
											 ?>

									</div>


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
</div>

	</body>

	<?php
	//$mysqli = new mysqli("localhost", "mi_usuario", "mi_contraseña", "world");

	/* comprobar la conexión */
	if (mysqli_connect_errno()) {
	    printf("Falló la conexión: %s\n", mysqli_connect_error());
	    exit();
	}



//	$mysqli->close();
	 ?>
</html>
