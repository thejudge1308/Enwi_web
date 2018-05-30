<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Este codigo da la autorizacion de crear prestamo por rut
$rut = $_POST["rut"];

$foo = new StdClass();


$sql = "SELECT COUNT(prestamocopia.codigoCopia) FROM prestamocopia INNER JOIN prestamo WHERE prestamocopia.codigoPrestamo = prestamo.codigo AND  prestamocopia.estado = 'Pendiente' AND prestamo.refLector = '".$rut."';";
 


$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$resultado = intval($row[0]);
$foo->salida = $row[0];


if ($resultado<=2) 
{
	$foo->mensaje = "true";
	echo json_encode($foo);
}
//else : enviar mensaej de q se ingreso 
else 
{
	$foo->mensaje = "false";
	echo json_encode($foo);
}

mysqli_close($conn);
 ?>