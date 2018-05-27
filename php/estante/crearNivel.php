<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Estos datos deben coincidir con el otro lado
$isbn = $_POST["codigo"];
$autor = $_POST["codigoEstante"];


//crear query para obtener ese libro .. Ojo!, cuando es un text debe estar en ' '
/*$sql = " SELECT * FROM nivel  WHERE codigo = '".$codigo."';";

$result = mysqli_query($conn, $sql);
///mysqli_close($conn);
$foo = new StdClass();*/



//Insert
$sql = "INSERT INTO nivel (codigo,codigoEstante) VALUES (".$codigo.",".$codigoEstante.");"; 
//print_r($sql);

$result = mysqli_query($conn, $sql);

//echo "mensje"; tipo jsons
$foo->mensaje = false;
$foo->mensaje = "Nivel creado exitosamente";
echo json_encode($foo);


mysqli_close($conn);
 ?>