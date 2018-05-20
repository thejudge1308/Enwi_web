<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Estos datos deben coincidir con el otro lado
$rut = $_POST["rut"];
$nombre = $_POST["nombre"];
$apaterno = $_POST["apellidoP"];
$amaterno = $_POST["apellidoM"];
$correo = $_POST["correo"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$comentario = $_POST["comentario"];

//crear query para obtener ese lector .. Ojo!, cuando es un text debe estar en ' '
$sql = " SELECT rut FROM lector WHERE rut = '".$rut."'";

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
	$sql = " UPDATE lector SET nombre ='".$nombre."',apellidoPaterno='".$apaterno."', apellidoMaterno='".$amaterno."', direccion ='".$direccion."', telefono='".$direccion."', correoElectronico='".$correo."',observacion='".$comentario."' WHERE rut = '".$rut."'";
	//print_r($sql);

	$result = mysqli_query($conn, $sql);
	
	//echo "mensje"; tipo jsons
	$foo->mensaje = "true";
	//$foo->mensaje = "Lector modificado exitosamente";
	echo json_encode($foo);
}

mysqli_close($conn);
 ?>