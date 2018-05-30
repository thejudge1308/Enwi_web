<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");


$refLector = $_POST["refLector"];
$refTrabajador = $_POST["refTrabajador"];
$fechaPrestamo = $_POST["fechaPrestamo"];
$fechaDevolucion = $_POST["fechaDevolucion"];

$foo = new StdClass();


//echo "falso"; ->mensaje tipo json
//Insert
$sql2 = "SELECT rut FROM trabajador WHERE trabajador.correoElectronico ='".$refTrabajador."'";

$result2 = mysqli_query($conn, $sql2);

$row = mysqli_fetch_array($result2);
$rut = $row[0];

$sql = "INSERT INTO prestamo (refLector, refTrabajador, fechaPrestamo, fechaDevolucion) VALUES ('".$refLector."','".$rut."','".$fechaPrestamo."','".$fechaDevolucion."');"; 


$result = mysqli_query($conn, $sql);

//echo "mensje"; tipo jsons
$foo->mensaje = "true";
$foo->codigo = mysqli_insert_id($conn);
echo json_encode($foo);


 ?>