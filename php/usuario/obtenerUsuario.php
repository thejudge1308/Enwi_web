<?php  
	include "../db.php";
	header("Content-Type: application/json; charset=UTF-8");

	$correo = $_POST["correo"];

 	$sql = "SELECT rut FROM trabajor WHERE correoElectronico = '".$correo."'";
 	$result = mysqli_query($conn, $sql);
	///mysqli_close($conn);
	$foo = new StdClass();
	if(mysqli_num_rows($result)>0){

		$row = mysqli_fetch_array($result);
		$resultado = $row[0];
		$foo->tipo="true";
		$foo->mensaje=$resultado;
	}else{
		$foo->tipo="false";
	}
	echo json_encode($foo);
	mysqli_close($conn);
 ?>