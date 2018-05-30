<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

$titulo = $_POST["titulo"];

$sql = "SELECT titulo, autor, edicion, anio , COUNT(copia.codigo) as numeroCopias 
		FROM libro, copia 
		WHERE titulo = '".$titulo."' AND copia.isbnLibro = libro.isbn AND copia.estado = 'habilitado' 
		GROUP BY libro.titulo";
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