<?php

  require 'funcs/conexion.php';
	include 'funcs/funcs.php';

  $user = $_GET['user'];

function check_email_address($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL)
     && preg_match('/@.+\./', $email);
}


if(isset($_POST['emls']) and $_POST['emls']<>""){
  $emails= $_POST['emls'];

  $filas = explode("\n", $emails); $malos=0; $nuevos=0;  $repetidos=0;

  echo "<div style='position:absolute;top:10%;left:48%;
                    width:48%;height:300px;border:thin solid black;overflow: auto'>";

      foreach($filas as $email){
          $email= trim($email);

        if (check_email_address($email)) {
           echo "<br><span style='color:blue'> $email : Buena </span>";

           if(emailExiste2($email)){
       			echo "<span style='color:orange'>  Pero ya existe </span>";
            $repetidos++;
          }else{


            $registro = registraMail($user,$email);
            if($registro > 0 ) {
              echo "<span style='color:green'> Ingreso Satisfactorio </span>";
                $nuevos++;
              } else {
              echo  "<span style='color:red'> Error al Registrar </span>";
            }

          }

        }else {
           echo "<br><span style='color:red'> $email : Mala </span>";
           $malos++;
        }

      }
        echo "<br><hr>Malos=$malos<br> Ingresos= $nuevos<br> Repetidos=$repetidos";
    echo "</div>";
}
 ?>
 <form class="" action="#" method="post">
   <div class="form-group">
   <textarea placeholder="correo@co" name="emls" id="emls" rows="8" cols="40"></textarea>
  <br> <button type="submit" name="button">Validar</button>
</div>
 </form>
