<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Estos datos deben coincidir con el otro lado
$codigo = $_POST["codigo"];

$foo = new StdClass();

$sql = "SELECT cantidadniveles FROM estante WHERE codigo = ".$codigo.";";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result);
$nivel = intval($row[0]) + 1;

//Insert
$sql = "INSERT INTO nivel (codigo,codigoEstante) VALUES (".$nivel.",".$codigo.");"; 
$result = mysqli_query($conn, $sql);

//echo "mensje"; tipo jsons
$foo->accion = "true";
$foo->mensaje = "Nivel creado exitosamente";
echo json_encode($foo);


mysqli_close($conn);
 ?>