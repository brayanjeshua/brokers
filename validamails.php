<link rel="stylesheet" href="css/estilos.css">
<style media="screen">
  * {
    font-family:'Raleway';
  }
</style>
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

  echo "<div class='validate-mails'>";

      foreach($filas as $email){
          $email= trim($email);

        if (check_email_address($email)) {
           echo "<span class='textomails' style='color:blue'> $email : Good </span>";

           if(emailExiste2($email)){
       			echo "<span class='textomails' style='color:orange'> but It's already subscribed :( </span>";
            $repetidos++;
          }else{


            $registro = registraMail($user,$email);
            if($registro > 0 ) {
              echo "<span class='textomails' style='color:green'> Success </span>";
                $nuevos++;
              } else {
              echo  "<span class='textomails' style='color:red'> It's Wrong </span>";
            }

          }

        }else {
           echo "<span class='textomails' style='color:red'> $email : Incorrect </span>";
           $malos++;
        }

      }
        echo "<p class='textomailsresult'> Wrong=$malos<br> Saved= $nuevos<br> Duplicate=$repetidos</p>";
    echo "</div>";
}
 ?>
 <form class="" action="#" method="post">
   <table class="mails">
     <thead class='thead-dark'>
       <tr>
         <th><h3 class="h3-mails">Check the mails</h3></th>
      </tr>
</thead>
<tbody>
    <tr>
      <td>
   <div class="mails">
<textarea placeholder="name@company.com
name@company.com
name@company.com
name@company.com
name@company.com
name@company.com
name@company.com
name@company.com
name@company.com
   " name="emls" id="emls" rows="6" cols="25"></textarea>
  <br><button class="btnmails-mails btnmails" type="submit" name="button">Validate</button>
      </td>
</tr>
</tbody>
</table>
</div>
 </form>
