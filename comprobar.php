<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

<?php

$calls =0;
if (isset($_POST['calls'])) {
  $calls =$_POST['calls'];
}

echo $calls;

$leads =0;
if (isset($_POST['leads'])) {
  $leads =$_POST['leads'];
}

echo $leads;

$followup =0;

if (isset($_POST['followup'])) {

  $followup =$_POST['followup'];
}
  echo $followup;

$mails =0;

  if (isset($_POST['mails'])) {

    $mails =$_POST['mails'];
}
    echo $mails;


  $load =0;

    if (isset($_POST['load'])) {

      $load =$_POST['load'];
    }

      echo $load;

?>
</body>
</html>
