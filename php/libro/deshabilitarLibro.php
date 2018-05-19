<?php 
	include "../db.php";
	header("Content-Type: application/json; charset=UTF-8");
	
	$codigo = $_POST["codigo"];

	$sql = "SELECT * FROM copia WHERE codigo=".$codigo.";";
	$resultado = mysqli_query($conn, $sql);
	$foo = new StdClass();

	/**
		Pregunta si el libro (copia) está habilitado
	*/
	if ($resultado->num_rows > 0) {
		$sql = "SELECT * FROM copia WHERE codigo=".$codigo." AND estado = "false";";
		$resultado = mysqli_query($conn, $sql);
		/**
			Pregunta si el libro (copia) ya esta deshabilitado
		*/
		if($resultado->num_rows > 0){
			$foo->mensaje = false;
			$foo->mensaje = "La copia ya esta deshabilitada";
			echo json_encode($foo);
			
		}else{
			$sql = "UPDATE copia SET estado = \"false\" WHERE codigo = ".$codigo.";";
			$resultado = mysqli_query($conn, $sql);
			$foo->mensaje = true;
			$foo->mensaje = "Se ha modificado exitosamente";
			echo json_encode($foo);
		}
		
	} else
	{
		$foo->mensaje = false;
		$foo->mensaje = "La copia no existe";
		echo json_encode($foo);
	}

	mysqli_close($conn);

 ?>