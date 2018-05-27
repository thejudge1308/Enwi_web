<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Estos datos deben coincidir con el otro lado

//Agregar atributos: 

$numero = $_POST["numero"];
$rangoSup = $_POST["intervalosup"];
$rangoInf = $_POST["intervaloinf"];
$cantidadniveles = $_POST["cantidadniveles"];

//crear query para obtener ese estante .. Ojo!, cuando es un text debe estar en ' '
$sql = " SELECT * FROM estante WHERE numero = ".$numero.";";

$result = mysqli_query($conn, $sql);
///mysqli_close($conn);
$foo = new StdClass();


//si la query tiene mas de 1 celda... es porque existe (enviar mensasaje de q no se ingreso)
if (mysqli_num_rows($result)>0) 
{
   //echo "true"; ->mensaje tipo json
	$foo->mensaje = true;
	$foo->mensaje = "El estante ya existe";
	echo json_encode($foo);
}
//else : enviar mensaej de q se ingreso 
else 
{
    //echo "falso"; ->mensaje tipo json
	//Insert
	$sql = "INSERT INTO estante (numero, intervaloInf, intervaloSup , cantidadniveles) VALUES (".$numero.",".$rangoInf.",".$rangoSup.",".$cantidadniveles.");";
	$result = mysqli_query($conn, $sql);
	$codigoestante = mysqli_insert_id($conn);
	$auxiliar=1;
	while ($auxiliar<=$cantidadniveles)
	{
		$sql = "INSERT INTO nivel (codigo, codigoEstante) VALUES (".$auxiliar.",".$codigoestante.")";
		$result = mysqli_query($conn, $sql);
		$auxiliar++;
	}
	
	//echo "mensje"; tipo jsons
	$foo->mensaje = false;
	$foo->mensaje = "Estante registrado exitosamente";
	echo json_encode($foo);
}

mysqli_close($conn);
 ?>