<?php 
	include "../db.php";
	header("Content-Type: application/json; charset=UTF-8");
	$codigo = $_POST['codigo'];

	$sql = "SELECT * FROM prestamocopia INNER JOIN copia WHERE prestamocopia.estado = 'Pendiente' AND copia.codigo = prestamocopia.codigoCopia AND prestamocopia.codigoCopia = ".$codigo.";";


	
	//$sql = "SELECT * FROM lector WHERE rut = 'asdasd'";
	$foo = new StdClass();
	$result = mysqli_query($conn, $sql);


	if ($result->num_rows > 0) 
	{
	   //echo "true"; ->mensaje tipo json
		$foo->mensaje = "true";
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
			$rows[] = $r;
		}
		
			//$foo=$rows;
		$foo->datos = $rows;
		echo json_encode($foo);
	}
	//else : enviar mensaej de q se ingreso 
	else 
	{
		$foo->mensaje = "false";
		echo json_encode($foo);
	}


	mysqli_close($conn);





 ?>