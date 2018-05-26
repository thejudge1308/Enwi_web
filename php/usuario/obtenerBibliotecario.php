<?php 
	include "../db.php";
	header("Content-Type: application/json; charset=UTF-8");

	$rut =  $_POST["rut"];
	$sql = "SELECT * FROM trabajador WHERE rut='".$rut."' AND tipo = 'bib'";
	$resultado = mysqli_query($conn, $sql);

	$foo = new StdClass();

	if ($resultado->num_rows > 0)
	{
		$foo->mensaje = "true";
		$rows = array();

		while($r = mysqli_fetch_assoc($resultado)) {
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