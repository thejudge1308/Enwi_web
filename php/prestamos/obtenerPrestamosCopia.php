<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");


$codigo = $_POST["codigo"];

$foo = new StdClass();

$sql = "SELECT * FROM prestamo INNER JOIN (SELECT codigoPrestamo AS cod FROM prestamocopia INNER JOIN copia WHERE ".$codigo."= prestamocopia.codigoCopia) AS p WHERE prestamo.codigo = p.cod AND prestamo.estado = 'Pendiente';"; 

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)>0) 
{
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
		$rows[] = $r;
	}

	$foo->tipo = "true";
	$foo->datos = $rows;
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