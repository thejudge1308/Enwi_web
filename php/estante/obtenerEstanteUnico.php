<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");
$numero = $_POST["codigo"];
$sql = " SELECT numero FROM estante WHERE codigo = ".$numero."";
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