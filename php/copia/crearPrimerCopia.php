<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Estos datos deben coincidir con el otro lado
$isbnlibro = $_POST["isbnlibro"];
$estado = $_POST["estado"];
$codigoEstante = $_POST["codigoEstante"];
$codigoNivel = $_POST["codigoNivel"];
$numcopia=$_POST["numcopia"];

$numcopia = intval($numcopia);
$codigoEstante= intval($codigoEstante);
$codigoNivel = intval($codigoNivel);

$foo = new StdClass();

$sql = "INSERT INTO copia (isbnlibro,estado,refEstante,refNivel,numerocopia) VALUES ('".$isbnlibro."','".$estado."',".$codigoEstante.",".$codigoNivel.",".$numcopia.")"; 
error_log($sql, 0);
$result = mysqli_query($conn, $sql);
$foo->mensaje = "false";
$foo->mensaje = "Copia registrada exitosamente";
echo json_encode($foo);


mysqli_close($conn);
 ?>