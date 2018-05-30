<?php
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$email = $_POST["email"];

$foo = new StdClass();

$sql = "SELECT * FROM trabajador WHERE correoElectronico = '".$email."'"; 

$result = mysqli_query($conn, $sql);



if (mysqli_num_rows($result)>0) 
{

  $foo->tipo = "true";
  $nueva_pass = generateRandomString();

  $sql = "UPDATE trabajador SET contrasena='".$nueva_pass."' WHERE correoElectronico = '".$email."';"; 
  $result = mysqli_query($conn, $sql);

  $message='<html>
      <head>
        <meta charset="UTF-8">
        </head>
        <body>
        <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
        .tg .tg-997y{font-size:16px;background-color:#000000;color:#ffffff;vertical-align:top}
        .tg .tg-yw4l{vertical-align:top}
        .tg .tg-ds4c{background-color:#000000;color:#ffffff;vertical-align:top}
        .p .red{color:#ff0000}
        </style>
        <p>Estimado (a),</p>
        <p>Tu nueva contraseña es: </p>
        <p><b>'.$nueva_pass.'</b></p>
        </body>
      </html>';

      //echo $message;

      require "PHPMailer/src/PHPMailer.php";
      require "PHPMailer/src/OAuth.php";
      require "PHPMailer/src/SMTP.php";
      require "PHPMailer/src/POP3.php";
      require "PHPMailer/src/Exception.php";
      //Crear una instancia de PHPMailer
      $mail = new PHPMailer\PHPMailer\PHPMailer();
      $mail->CharSet = 'UTF-8';
      //Definir que vamos a usar SMTP
      $mail->IsSMTP();
      //Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
      // 0 = off (producción)
      // 1 = client messages
      // 2 = client and server messages
      $mail->IsSMTP(); // enable SMTP
      $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
      $mail->SMTPAuth = true; // authentication enabled
      $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
      $mail->Host = "smtp.gmail.com";
      $mail->Port = 465; // or 587
      $mail->IsHTML(true);
      $mail->Username = "enkibiblioteca@gmail.com";
      $mail->Password = "enki1234";
      $mail->SetFrom("example@gmail.com");
      $mail->Subject = "Cambio de contraseña";
      $mail->Body = $message;
      $mail->AddAddress("".$email."");

      if(!$mail->Send()) {
        //echo "Error: ".$mail->ErrorInfo;
      } else {
        //echo "Enviado!";
      }

  echo json_encode($foo);
}
//else : enviar mensaej de q se ingreso 
else 
{
  $foo->tipo = "false";
  echo json_encode($foo);
}

  mysqli_close($conn);

 ?>
