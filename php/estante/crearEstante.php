<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Estos datos deben coincidir con el otro lado

//Agregar atributos: 

$numero = $_POST["numero"];
$rangoSupDewey = $_POST["rangoSupDewey"];
$rangoInfDewey = $_POST["rangoInfDewey"];
$cantNiveles = $_POST["cantNiveles"];

//crear query para obtener ese estante .. Ojo!, cuando es un text debe estar en ' '
$sql = " SELECT numero FROM estante WHERE numero = ".$numero."";

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
	$sql = "INSERT INTO estante (numero, rangoInfDewey, rangoSupDewey, cantNiveles) VALUES (".$numero.",".$rangoInfDewey.",".$apaterno.",".$amaterno.");";
	$auxiliar=1;
	while ($auxiliar<=$cantNiveles)
	{
		$sql = "INSERT INTO nivel (codigo, codigoestante) VALUES (".$auxiliar.",".$codigoestante.")";
		$auxiliar++;
	}
	//print_r($sql);

	$result = mysqli_query($conn, $sql);
	
	//echo "mensje"; tipo jsons
	$foo->mensaje = false;
	$foo->mensaje = "Estante registrado exitosamente";
	echo json_encode($foo);
}

mysqli_close($conn);
 ?>