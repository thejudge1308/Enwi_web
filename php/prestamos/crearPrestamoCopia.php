<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

$codigoPrestamo = $_POST["codigoPrestamo"];
$codigoCopia = $_POST["codigoCopia"];
$estado = $_POST["estado"];


$foo = new StdClass();


$sql = "INSERT INTO prestamocopia (codigoPrestamo, codigoCopia) VALUES (".$codigoPrestamo.",".$codigoCopia.");"; 
//print_r($sql);

$result = mysqli_query($conn, $sql);

//echo "mensje"; tipo jsons
$foo->mensaje = "true";
echo json_encode($foo);


 ?>