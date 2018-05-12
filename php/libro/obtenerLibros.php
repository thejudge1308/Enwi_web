<?php 
	include "../db.php";
	header("Content-Type: application/json; charset=UTF-8");

	$sql = "SELECT * FROM libro";
	$result = mysqli_query($conn, $sql);
	//echo "<p>".$result."</p>";
	//print_r($result);
	$foo = new StdClass();

	if ($result->num_rows > 0) 
	{
	   //echo "true"; ->mensaje tipo json
		/*$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
			$rows[] = $r;
		}*/
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
		//print_r($rows);
			//$foo=$rows;
		$foo->mensaje=true;
		$foo->datos=$rows;
		//print_r($foo);
		echo "".json_encode($foo);
	}
	//else : enviar mensaej de q se ingreso 
	else 
	{
		$foo->mensaje = false;
		echo json_encode($foo);
	}

	mysqli_close($conn);
?>