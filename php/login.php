<?php 
include "db.php";

$usuario = $_POST["correo"];
$contrasena = $_POST["contasena"];

$sql = "SELECT tipo FROM trabajador WHERE correoElectronico = '".$usuario."' AND contrasena = '".$contrasena."' AND estado = 'true';";
$foo = new StdClass();

//$sql="SELECT tipo FROM trabajador WHERE correoElectronico = 'pato@pato.com' AND contrasena = '1234';";
$result = mysqli_query($conn, $sql);
//echo mysqli_num_rows($result);

if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_array($result);
	//print_r($row);
	$foo->mensaje = "true";
	$foo->tipo = $row[0];
	echo json_encode($foo);
} else {
	$foo->mensaje = "false";
	echo json_encode($foo);
}

mysqli_free_result($result);
mysqli_close($conn);



 ?>
