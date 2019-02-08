<?php
	require 'funcs/conexion.php';
	include 'funcs/funcs.php';

	session_start(); //Iniciar una nueva sesión o reanudar la existente

	if(isset($_SESSION["id_usuario"])){ //En caso de existir la sesión redireccionamos
		header("Location: welcome.php");
	}

	$errors = array();

	if(!empty($_POST))
	{
		$usuario = $mysqli->real_escape_string($_POST['usuario']);
		$password = $mysqli->real_escape_string($_POST['password']);

		if(isNullLogin($usuario, $password))
		{
			$errors[] = "Debe llenar todos los campos";
		}

		$errors[] = login($usuario, $password);
	}
?>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"  integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/estilos.css">
	</head>

	<body class="body-custom">
		<div class="container main">

			<div class="col-12 imagen">
				<img src="img/miami-login.png" class="col-lg-6 col-4 rounded float-right">
			</div>

			<div class="mainbox col-lg-6 col-12">

					<div class="panel-heading">
						<img width="150px" src="img/logo-tradex.png" class="rounded float-left">
					</div>
					<div style="padding-top:30px" class="panel-body" >

						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="fas fa-user"></i></span>
								<input type="text" class="form-control" name="usuario" value="" placeholder="Email or Username" required>
							</div>

							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="fas fa-lock"></i></span>
								<input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
							</div>

							<div class="form-group">
								<div class="col-lg-12">
									<button type="submit" class="btn btn-primary btn-block btn-sm">Sign In</button>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12 control">
									<div style="border-top: 1px solid#888;"></div>
									<br>
										Create an account <a href="registro.php">Sign Up</a>
									<br>
									<div class="col-12">
										<a href="recupera.php"> Forgot your password?</a>
									</div>
								</div>
							</div>
							<br>

						</form>

						<?php echo resultBlock($errors); ?>
					</div>

			</div>

		</div>

	</body>
</html>
