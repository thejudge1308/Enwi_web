<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Estos datos deben coincidir con el otro lado

//Agregar atributos: 

$numero = $_POST["numero"];
$rangoSupDewey = $_POST["rangoSupDewey"];
$rangoInfDewey = $_POST["rangoInfDewey"];

//crear query para obtener ese estante .. Ojo!, cuando es un text debe estar en ' '
$sql = " SELECT numero FROM estante WHERE numero = ".$numero."";

$result = mysqli_query($conn, $sql);
///mysqli_close($conn);
$foo = new StdClass();


//si la query tiene mas de 1 celda... es porque existe (enviar mensasaje de q no se ingreso)
if (mysqli_num_rows($result)<=0) 
{
   //echo "true"; ->mensaje tipo json
	$foo->mensaje = "true";
	$foo->mensaje = "No existen estantes con ese numero";
	echo json_encode($foo);
}
//else : enviar mensaej de q se ingreso 
else 
{
    //echo "falso"; ->mensaje tipo json
	//Insert
	if (is_null($rangoInfDewey)) 
	{
		$sql = "UPDATE estante SET rangoSupDewey = ".$rangoSupDewey." WHERE numero = ".$numero.";";
		$result = mysqli_query($conn, $sql);
	}
	elseif (is_null($rangoSupDewey)) 
	{
		$sql = "UPDATE estante SET rangoInfDewey = ".$rangoInfDewey." WHERE numero = ".$numero.";";
		$result = mysqli_query($conn, $sql);
	}
	elseif (is_null($rangoInfDewey) && is_null($rangoSupDewey))
	{
		$foo->mensaje = "true";
		$foo->mensaje = "Ingrese al menos un rango para modificar";
	}
	else
	{
		$sql = "UPDATE estante SET rangoSupDewey = ".$rangoSupDewey." WHERE numero = ".$numero.";";
		$sql1 = "UPDATE estante SET rangoInfDewey = ".$rangoInfDewey." WHERE numero = ".$numero.";";
		$result = mysqli_query($conn, $sql);
		$result = mysqli_query($conn, $sql1);
	}
	//print_r($sql);

	//$result = mysqli_query($conn, $sql);
	
	//echo "mensje"; tipo jsons
	$foo->mensaje = "false";
	$foo->mensaje = "Estante modificado exitosamente";
	echo json_encode($foo);
}

mysqli_close($conn);
 ?>