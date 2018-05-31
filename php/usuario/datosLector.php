<?php 
	include "../db.php";
	header("Content-Type: application/json; charset=UTF-8");
	$rut = $_POST['rut'];
	$sql = "SELECT * FROM lector WHERE rut = '".$rut."'";
	//$sql = "SELECT * FROM lector WHERE rut = 'asdasd'";
	$foo = new StdClass();
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		$foo->mensaje = "true";
		$rows = array();

		while($r = mysqli_fetch_assoc($result)) {
		    $rows[] = $r;
		}

		$foo->datos = $rows;
		echo json_encode($foo);

	} 
	else {

		$foo->mensaje = "false";
		echo json_encode($foo);
	}


	mysqli_close($conn);






 ?>