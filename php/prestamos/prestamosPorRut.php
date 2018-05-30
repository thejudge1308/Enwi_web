<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Este codigo da la autorizacion de crear prestamo por rut
$rut = $_POST["rut"];

$foo = new StdClass();

$sql = "SELECT COUNT(copia.codigo) AS numero FROM copia INNER JOIN (SELECT prestamocopia.codigoCopia AS pcopia FROM prestamocopia INNER JOIN prestamo WHERE prestamo.codigo = prestamocopia.codigoPrestamo AND prestamo.estado = 'Pendiente' AND prestamo.refTrabajador = '".$rut."') AS p WHERE p.pcopia =copia.codigo AND copia.estado = 'Prestado'; "; 

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$resultado = intval($row[0]);

if ($resultado<=2) 
{
	$foo->mensaje = "true";
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