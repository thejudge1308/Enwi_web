<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Estos datos deben coincidir con el otro lado
$codigoEstante = $_POST["codigoEstante"];
$codigoNivel = $_POST["codigoNivel"];
$codigoCopia = $_POST["codigoCopia"];
//crear query para obtener ese lector .. Ojo!, cuando es un text debe estar en ' '
$sql = " SELECT codigo FROM copia WHERE codigo = '".$codigo."'";

$result = mysqli_query($conn, $sql);
///mysqli_close($conn);
$foo = new StdClass();


//si la query tiene menos de 0 es porque no existe el usuario
if (mysqli_num_rows($result)<=0) 
{
   //echo "true"; ->mensaje tipo json
	$foo->mensaje = "false";
	//$foo->mensaje = "El lector no existe";
	echo json_encode($foo);
}
//else : enviar mensaej de q se ingreso 
else 
{
    //echo "falso"; ->mensaje tipo json
	//Modifica los datos
	$sql = " UPDATE copia SET refEstante ='".$codigoEstante."' ,refNivel='".$codigoNivel."'WHERE codigo = '".$codigoCopia."'";
	//print_r($sql);

	$result = mysqli_query($conn, $sql);
	
	//echo "mensje"; tipo jsons
	$foo->mensaje = "Estado cambiado exitosamente";
	//$foo->mensaje = "Lector modificado exitosamente";
	echo json_encode($foo);
}

mysqli_close($conn);
 ?>