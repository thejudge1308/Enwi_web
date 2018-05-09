<?php 
include "db.php";

$usuario = $_POST["correo"];
$contrasena = $_POST["contasena"];

$sql = "SELECT * FROM users WHERE email = '".$usuario."' AND contrasena ='".$contrasena."'";

//$sql="SELECT * FROM users WHERE email = 'pquezada12@alumnos.utalca.cl'AND contrasena ='s'";
$result = mysqli_query($conn, $sql);
//echo mysqli_num_rows($result);

if ($result->num_rows > 0) {

   echo "true";
} else {
   echo "falso";
}

mysqli_close($conn);



 ?>