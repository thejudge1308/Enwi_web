
<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Este codigo obtiene las copias de los prestamos
//Codigo del prestamo
$codigo = $_POST["codigo"];

$foo = new StdClass();

$sql = "SELECT * FROM copia INNER JOIN (SELECT prestamocopia.codigoCopia AS codcopia FROM prestamocopia INNER JOIN prestamo WHERE "$codigo" = prestamocopia.codigoPrestamo) AS p WHERE p.codcopia = copia.codigo;"; 

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