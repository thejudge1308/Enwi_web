<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

$codigo = $_POST["codigo"];

$sql = "SELECT * FROM copia INNER JOIN libro WHERE copia.isbnlibro = libro.isbn AND copia.codigo=".$codigo."
;";

$result = mysqli_query($conn, $sql);
$foo = new StdClass();

	if ($result->num_rows > 0) 
	{
	   //echo "true"; ->mensaje tipo json
		$foo->mensaje = "true";
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
			$rows[] = $r;
		}
		
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
