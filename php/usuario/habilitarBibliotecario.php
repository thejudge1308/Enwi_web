<?php 
	include "../db.php";
	header("Content-Type: application/json; charset=UTF-8");
	
	$rut = $_POST["rut"];

	$sql = "SELECT * FROM trabajador WHERE rut='".$rut."'";
	$resultado = mysqli_query($conn, $sql);
	$foo = new StdClass();

	/**
		Pregunta si el usuario existe
	*/
	if ($resultado->num_rows > 0) {
		$sql = "SELECT * FROM trabajador WHERE rut='".$rut."' AND estado = 'true'";
		$resultado = mysqli_query($conn, $sql);
		/**
			Pregunta si el usuario ya esta deshabilitado
		*/
		if($resultado->num_rows > 0){
			$foo->mensaje = "El bibliotecario ya esta habilitado";
			echo json_encode($foo);
			
		}else{
			$sql = "UPDATE trabajador SET estado = 'true' WHERE rut ='".$rut."'";
			$resultado = mysqli_query($conn, $sql);
			$foo->mensaje = "Se ha modificado exitosamente";
			echo json_encode($foo);
		}
		
	} else
	{
		$foo->mensaje = false;
		$foo->mensaje = "El bibliotecario no existe";
		echo json_encode($foo);
	}

	mysqli_close($conn);

 ?>