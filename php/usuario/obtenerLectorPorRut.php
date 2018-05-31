<?php 
	include "../db.php";
	header("Content-Type: application/json; charset=UTF-8");
	$rut = $_POST['rut'];
	$sql = "SELECT * FROM lector WHERE rut = '".$rut."'";
	//$sql = "SELECT * FROM lector WHERE rut = 'asdasd'";
	$foo = new StdClass();
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		$row = mysqli_fetch_array($result);
		//print_r($row);
		$foo->mensaje = "true";
		$foo->nombre = $row[1];
		$foo->ap = $row[2];
		$foo->am = $row[3];
		$foo->dir = $row[4];
		$foo->cor = $row[6];
		echo json_encode($foo);

	} 
	else {

		$foo->mensaje = "false";
		echo json_encode($foo);
	}


	mysqli_close($conn);






 ?>