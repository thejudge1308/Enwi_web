<?php 
	include "../db.php";
	header("Content-Type: application/json; charset=UTF-8");
	
	$isbn = $_POST["isbn"];

	$sql = "SELECT * FROM libro WHERE isbn='".$isbn."'";
	$resultado = mysqli_query($conn, $sql);
	$foo = new StdClass();

	/**
		Pregunta si el usuario existe
	*/
	if ($resultado->num_rows > 0) {
		$sql = "SELECT * FROM libro WHERE isbn='".$isbn."' AND estado = 'Habilitado'";
		$resultado = mysqli_query($conn, $sql);
		/**
			Pregunta si el usuario ya esta deshabilitado
		*/
		if($resultado->num_rows > 0){
			$foo->mensaje = "El libro ya esta habilitado";
			echo json_encode($foo);
			
		}else{
			$sql = "UPDATE libro SET estado = 'Habilitado' WHERE isbn ='".$isbn."'";
			$resultado = mysqli_query($conn, $sql);
			$foo->mensaje = "Se ha modificado exitosamente";
			echo json_encode($foo);
		}
		
	} else
	{
		$foo->mensaje = false;
		$foo->mensaje = "El libro no existe";
		echo json_encode($foo);
	}

	mysqli_close($conn);

 ?>