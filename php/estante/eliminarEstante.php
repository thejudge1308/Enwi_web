<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Estos datos deben coincidir con el otro lado

//Agregar atributos: 

$numero = $_POST["numero"];

//crear query para obtener ese estante .. Ojo!, cuando es un text debe estar en ' '
$sql = " SELECT numero FROM estante WHERE numero = ".$numero.";";

$result = mysqli_query($conn, $sql);
///mysqli_close($conn);
$foo = new StdClass();


//si la query tiene mas de 1 celda... es porque existe (enviar mensasaje de q no se ingreso)
if (mysqli_num_rows($result)<=0) 
{
   //echo "true"; ->mensaje tipo json
	$foo->mensaje = "true";
	$foo->mensaje = "No existen estantes con ese código";
	echo json_encode($foo);
}
//else : enviar mensaej de q se ingreso 
else 
{
    //echo "falso"; ->mensaje tipo json
	//Insert
	$sql = "DELETE FROM estante WHERE ".$numero" = ".$numero.";";
	$sql2 = "DELETE FROM nivel WHERE ".$codigoestante" = ".$numero.";";
	$sql3 = "UPDATE copia SET nivel = -1 WHERE nivel = ".$NULL.";";
	//print_r($sql);

	$result = mysqli_query($conn, $sql);
	$result = mysqli_query($conn, $sql2);
	$result = mysqli_query($conn, $sql3);
	
	//echo "mensje"; tipo jsons
	$foo->mensaje = "false";
	$foo->mensaje = "Estante eliminado exitosamente";
	echo json_encode($foo);
}

mysqli_close($conn);
 ?>