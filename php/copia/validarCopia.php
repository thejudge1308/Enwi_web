<?php 
	include "../db.php";
	header("Content-Type: application/json; charset=UTF-8");
	$codigo = $_POST['codigo'];
	$sql = "SELECT * FROM copia WHERE copia.codigo = ".$codigo.";";
	
	//$sql = "SELECT * FROM lector WHERE rut = 'asdasd'";
	$foo = new StdClass();
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {

		$row = mysqli_fetch_array($result);
		$foo->mensaje = "true";
		$foo->estado =  $row[3];;

		echo json_encode($foo);

	} 
	else {

		$foo->mensaje = "false";
		echo json_encode($foo);
	}


	mysqli_close($conn);





 ?>