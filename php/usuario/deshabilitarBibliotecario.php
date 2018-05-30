<?php 
	include "../db.php";
	header("Content-Type: application/json; charset=UTF-8");
	$rut = $_POST["rut"];

	$sql = "SELECT * FROM trabajador WHERE rut='".$rut."'";
	//$sql=
	$resultado = mysqli_query($conn, $sql);
	$foo = new StdClass();

	/**
		Pregunta si el usuario existe
	*/
	if ($resultado->num_rows > 0) {
		$sql = "SELECT * FROM trabajador WHERE rut='".$rut."' AND estado = 'false'";
		$resultado = mysqli_query($conn, $sql);
		/**
			Pregunta si el usuario ya esta deshabilitado
		*/
		if($resultado->num_rows > 0){
			$foo->mensaje = "false";
			$foo->mensaje = "El lector ya esta deshabilitado";
			echo json_encode($foo);
			
		}else{
			$sql = "UPDATE trabajador SET estado = 'false' WHERE rut = '".$rut."'";
			$resultado = mysqli_query($conn, $sql);
			$foo->mensaje = "true";
			$foo->mensaje = "Se ha modificado exitosamente";
			echo json_encode($foo);
		}
		
	} else
	{
		$foo->mensaje = "false";
		$foo->mensaje = "El lector no existe";
		echo json_encode($foo);
	}

	mysqli_close($conn);

 ?>