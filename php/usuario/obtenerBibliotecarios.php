<?php 
	include "../db.php";
	header("Content-Type: application/json; charset=UTF-8");

	$tipo = "bib";
	$sql = "SELECT * FROM trabajador WHERE tipo = '".$tipo."'";
	$result = mysqli_query($conn, $sql);
	$foo = new StdClass();

	if ($result->num_rows > 0) 
	{
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