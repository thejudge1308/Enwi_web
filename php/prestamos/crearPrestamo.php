<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

$refLector = $_POST["refLector"];
$refTrabajador = $_POST["refTrabajador"];
$fechaPrestamo = $_POST["fechaPrestamo"];
$fechaDevolucion = $_POST["fechaDevolucion"];

$foo = new StdClass();
$sql ="SELECT * FROM lector WHERE rut = '".$refLector."';";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {

	$sql = "SELECT rut FROM trabajador WHERE correoElectronico = '".$refTrabajador."';";
 	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);

	$resultado = $row[0];

	$sql = "INSERT INTO prestamo (refLector, refTrabajador, fechaPrestamo, fechaDevolucion) VALUES ('".$refLector."','".$resultado."','".$fechaPrestamo."','".$fechaDevolucion."');"; 
	$result = mysqli_query($conn, $sql);

	 $codigo= mysqli_insert_id($conn);
	 //error_log("codigo". $codigo, 0);

	$foo->mensaje = "true";
	$foo->codigo = $codigo."";
	//$foo->mensaje = "Préstamo registrado exitosamente";

}else{
	$foo->mensaje = "false";
	//$foo->mensaje = "EL lector no esta habilitado";
}


echo json_encode($foo);


 ?>