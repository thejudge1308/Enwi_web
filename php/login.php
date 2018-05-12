<?php 
include "db.php";

$usuario = $_POST["correo"];
$contrasena = $_POST["contasena"];

$sql = "SELECT * FROM trabajador WHERE correoElectronico = '".$usuario."' AND contrasena ='".$contrasena."'";

//$sql="SELECT * FROM trabajador WHERE correoElectronico = 'pato@pato.com' AND contrasena ='1234'";
$result = mysqli_query($conn, $sql);
//echo mysqli_num_rows($result);

if ($result->num_rows > 0) {

   echo "true";
} else {
   echo "falso";
}

mysqli_close($conn);



 ?>
