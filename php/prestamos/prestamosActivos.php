<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

$rut = $_POST["rut"];

$sql = "SELECT prestamo.codigo as codigoPrestamo, prestamo.fechaPrestamo as fechaPrestamo, prestamo.fechaDevolucion as fechaDevolucion, libro.titulo as tituloLibro, copia.codigo as codigoCopia, prestamo.estado as estadoPrestamo
	FROM prestamo, prestamoCopia, libro, copia, lector
	WHERE lector.rut = '".$rut."' AND lector.rut = prestamo.refLector AND prestamo.codigo = prestamoCopia.codigoPrestamo AND prestamoCopia.codigoCopia = copia.codigo AND copia.isbnLibro = libro.isbn AND prestamo.estado = 'Pendiente'";

$result = mysqli_query($conn, $sql);

$foo = new StdClass();

if ($result->num_rows > 0) 
{
	$foo->mensaje = "true";
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
		$rows[] = $r;
	}
	
		//$foo=$rows;
	$foo->datos = $rows;
	echo json_encode($foo);
}
else
{
	$foo->mensaje = "false";
	echo json_encode($foo);
}


mysqli_close($conn);
?>