<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");


$codigo = $_POST["codigo"];
$refLector = $_POST["refLector"];
$refTrabajador = $_POST["refTrabajador"];
$fechaPrestamo = $_POST["fechaPrestamo"];
$fechaDevolucion = $_POST["fechaDevolucion"];

$foo = new StdClass();


//echo "falso"; ->mensaje tipo json
//Insert
$sql = "INSERT INTO prestamo (codigo, refLector, refTrabajador, fechaPrestamo, fechaDevolucion) VALUES ('".$codigo."','".$refLector."',".$refTrabajador.",'".$fechaPrestamo."','".$fechaDevolucion."');"; 
//print_r($sql);

$result = mysqli_query($conn, $sql);

//echo "mensje"; tipo jsons
$foo->mensaje = false;
$foo->mensaje = "Préstamo registrado exitosamente";
echo json_encode($foo);


 ?>