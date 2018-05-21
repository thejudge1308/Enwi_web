<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

$isbnlibro = $_POST["isbnlibro"];

$sql = "SELECT * FROM copia WHERE isbnlibro = '".$isbnlibro."'";
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
		
			//$foo=$rows;
		$foo->datos = $rows;
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
