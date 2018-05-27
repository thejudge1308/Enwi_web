<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Estos datos deben coincidir con el otro lado
$numero = $_POST["numero"];
$cantidadniveles = $_POST["cantidadniveles"];
//crear query para obtener ese lector .. Ojo!, cuando es un text debe estar en ' '
$sql = " SELECT numero FROM estante WHERE numero = ".$numero."";

$result = mysqli_query($conn, $sql);
///mysqli_close($conn);
$foo = new StdClass();


//si la query tiene menos de 0 es porque no existe el usuario
if (mysqli_num_rows($result)<=0) 
{
   //echo "true"; ->mensaje tipo json
	$foo->mensaje = "No se pudo cambiar el nivel";
	//$foo->mensaje = "El lector no existe";
	echo json_encode($foo);
}
//else : enviar mensaej de q se ingreso 
else 
{
    //echo "falso"; ->mensaje tipo json
	//Modifica los datos
	$sql = " UPDATE estante SET cantidadniveles =".$cantidadniveles." WHERE numero = '".$numero."' ;";
	//print_r($sql);

	$result = mysqli_query($conn, $sql);
	/*$codigoestante = mysqli_insert_id($conn);

	$sql = "INSERT INTO nivel (codigo, codigoEstante) VALUES ('".$cantidadniveles."','".$codigoestante."');";
	$result = mysqli_query($conn, $sql);*/
	
	//echo "mensje"; tipo jsons
	$foo->mensaje = "Nivel modificado exitosamente";
	//$foo->mensaje = "Lector modificado exitosamente";
	echo json_encode($foo);
}

mysqli_close($conn);
 ?>