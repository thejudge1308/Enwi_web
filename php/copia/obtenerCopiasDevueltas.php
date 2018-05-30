<?php 
	include "../db.php";
	header("Content-Type: application/json; charset=UTF-8");
	$codigo = $_POST['codigo'];

	$sql = "SELECT prestamocopia.codigoCopia, libro.titulo FROM prestamocopia INNER JOIN copia INNER JOIN libro WHERE libro.isbn = copia.isbnlibro AND prestamocopia.estado = 'Finalizado' AND copia.codigo = prestamocopia.codigoCopia AND prestamocopia.codigoPrestamo = ".$codigo.";";

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