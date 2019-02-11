<?php

	require 'funcs/conexion.php';
	require 'funcs/funcs.php';

	$errors = array();

	if(!empty($_POST))
	{
		$nombre = $mysqli->real_escape_string($_POST['nombre']);
		$usuario = $mysqli->real_escape_string($_POST['usuario']);
		$password = $mysqli->real_escape_string($_POST['password']);
		$con_password = $mysqli->real_escape_string($_POST['con_password']);
		$email = $mysqli->real_escape_string($_POST['email']);

		$activo = 0;
		$tipo_usuario = 2;

		if(isNull($nombre, $usuario, $password, $con_password, $email))
		{
			$errors[] = "Must fill all the fields";
		}

		if(!isEmail($email))
		{
			$errors[] = "Invalid e-mail address";
		}

		if(!validaPassword($password, $con_password))
		{
			$errors[] = "Passwords do not match";
		}

		if(usuarioExiste($usuario))
		{
			$errors[] = "User name $usuario already exists";
		}

		if(emailExiste($email))
		{
			$errors[] = "The email address $email already exists";
		}

		if(count($errors) == 0)
		{
				$pass_hash = hashPassword($password);
				$token = generateToken();

				$registro = registraUsuario($usuario, $pass_hash, $nombre, $email, $activo, $token, $tipo_usuario);

				if($registro > 0 )
				{

					$url = 'https://'.$_SERVER["SERVER_NAME"].'/dailygoals/activar.php?id='.$registro.'&val='.$token;

					$asunto = 'Activate Account - Daily Goals';
					$cuerpo = "Hi $nombre: <br /><br />To complete the process it is important that you make click here <a href='$url'>Activate Account</a>";

					if(enviarEmail($email, $nombre, $asunto, $cuerpo)){

					echo "To finish the registration process, follow the instructions that we have sent to your email: $email";

					echo "<br><a href='index.php' >Sign In</a>";
					exit;

					} else {
						$erros[] = "Error to sent message";
					}

					} else {
					$errors[] = "Error to Register";
				}

		}

	}

?>
<html>
	<head>
		<title>Register</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"  integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	</head>

	<body>
		<div class="container">
			<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="h1">User Register</div>
					</div>

					<div class="panel-body" >

						<form id="signupform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

							<div id="signupalert" style="display:none" class="alert alert-danger">
								<p>Error:</p>
								<span></span>
							</div>

							<div class="form-group">
								<div class="col-md-9">
									<input type="text" class="form-control" name="nombre" placeholder="Your Name" value="<?php if(isset($nombre)) echo $nombre; ?>" required >
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-9">
									<input type="text" class="form-control" name="usuario" placeholder="User" value="<?php if(isset($usuario)) echo $usuario; ?>" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-9">
									<input type="password" class="form-control" name="password" placeholder="Password" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-9">
									<input type="password" class="form-control" name="con_password" placeholder="Confirm Password" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-9">
									<input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email; ?>" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-offset-3 col-md-9">
									<button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Register</button>
									<div>Already have an Account? <a id="signinlink" href="index.php">Sign In</a></div>
								</div>
							</div>
						</form>
						<?php echo resultBlock($errors); ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
