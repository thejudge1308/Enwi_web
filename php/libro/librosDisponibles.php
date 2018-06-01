<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

$titulo = $_POST["titulo"];

$sql = "SELECT libro.titulo AS titulo, libro.autor AS autor, edicion AS edicion , anio AS anio , COUNT(libro.isbn) AS numeroCopias FROM libro INNER JOIN copia WHERE titulo LIKE '".$titulo."' AND copia.isbnlibro = libro.isbn AND libro.estado = 'Habilitado' AND copia.estado = 'Habilitado' GROUP BY isbn";
$result = mysqli_query($conn, $sql);

$foo = new StdClass();

if ($result->num_rows > 0) 
{
	$foo->mensaje = "true";
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
		$rows[] = $r;
	}
	
		//$foo=$rows;
	$foo->datos = $rows;
	echo json_encode($foo);
}
else
{
	$foo->mensaje = "false";
	echo json_encode($foo);
}


mysqli_close($conn);

?>