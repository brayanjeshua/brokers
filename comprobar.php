<?php
	session_start();
	require 'funcs/conexion.php';
	include 'funcs/funcs.php';

	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}

	$idUsuario = $_SESSION['id_usuario'];

  //convierto en formato UNIX FECHA para hacer la comparacion fecha de hoy
  $fecha_hoy = date("Y-m-d");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Agregando Datos</title>
  </head>
  <body>

<?php
$loads =0;
if (isset($_POST['loads'])) {
    $loads =$_POST['loads'];
  }

$calls =0;
if (isset($_POST['calls'])) {
  $calls =$_POST['calls'];
}

$leads =0;
if (isset($_POST['leads'])) {
  $leads =$_POST['leads'];
}

$followup =0;
if (isset($_POST['followup'])) {
  $followup =$_POST['followup'];
}

$mails =0;
  if (isset($_POST['mails'])) {
    $mails =$_POST['mails'];
}

/*Comprobacion de load para marcar a todas las opciones*/

    if ($loads == 1) {
      $calls = 1;
      $leads = 1;
      $followup = 1;
      $mails = 1;
    }

/*Llamada de lo que se hizo en el Día*/
$date = $fecha_hoy;
$id_user = $idUsuario;
echo 'TU ID DE USUARIO ES '.$id_user.'<br>';
echo $calls;
echo $leads;
echo $followup;
echo $mails;
echo $loads;
echo $date;

function registrarTrabajo($id_user,$calls,$leads,$followup,$mails,$loads,$date) {

  global $mysqli;

  $stmt = $mysqli->prepare("INSERT INTO trabajo (id_usuario,calls,leads,followup,mails,loads,date) VALUES(?,?,?,?,?,?,?)");
  $stmt->bind_param('iiiiiis',$id_user,$calls,$leads,$followup,$mails,$loads,$date);

  if ($stmt->execute()){
    return $mysqli->insert_id;
    } else {
    return 0;
  }
}

registrarTrabajo($id_user,$calls,$leads,$followup,$mails,$loads,$date);

?>
</body>
</html>
