<?php 
	include "../db.php";
	header("Content-Type: application/json; charset=UTF-8");
	$codigo = $_POST['codigo'];
	$sql = "SELECT * FROM prestamocopia INNER JOIN prestamo WHERE prestamocopia.codigoPrestamo = prestamo.codigo AND prestamocopia.codigoPrestamo = ".$codigo.";";
	
	//$sql = "SELECT * FROM lector WHERE rut = 'asdasd'";
	$foo = new StdClass();
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		$row = mysqli_fetch_array($result);
		//print_r($row);
		$foo->mensaje = "true";
		$foo->prestamo = $row[0];
		$foo->fechaP = $row[6];
		$foo->fechaD = $row[7];
		$foo->refLector = $row[4];
		$foo->refTrabajador = $row[5];
		$foo->estado = $row[8];
		echo json_encode($foo);

	} 
	else {

		$foo->mensaje = "false";
		echo json_encode($foo);
	}


	mysqli_close($conn);





 ?>