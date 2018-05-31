<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Estos datos deben coincidir con el otro lado
$isbnlibro = $_POST["isbnlibro"];
$estado = $_POST["estado"];
$codigoEstante = $_POST["codigoEstante"];
$codigoNivel = $_POST["codigoNivel"];

///mysqli_close($conn);
$foo = new StdClass();

$sql = "SELECT COUNT(codigo) FROM copia WHERE isbnlibro = '".$isbnlibro."' GROUP BY codigo;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$numerocopia = intval($row[0]) + 1;

$sql = "INSERT INTO copia (isbnlibro,numerocopia,estado,refEstante,refNivel) VALUES ('".$isbnlibro."',".$numerocopia.",'".$estado."',".$codigoEstante.",".$codigoNivel.");"; 

$result = mysqli_query($conn, $sql);
$foo->mensaje = "false";
$foo->mensaje = "Copia registrada exitosamente";
echo json_encode($foo);


mysqli_close($conn);
 ?>