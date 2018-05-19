<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Estos datos deben coincidir con el otro lado
$rut = $_POST["rut"];
$nombre = $_POST["nombre"];
$apaterno = $_POST["apellidoPaterno"];
$amaterno = $_POST["apellidoMateno"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$correo = $_POST["correoElectronico"];
$contrasena = $_POST["contrasena"];
$contactoemergencianombre = $_POST["contactoEmergenciaNombre"];
$contactoemergenciatelefono = $_POST["contactoEmergenciaTelefono"];


//crear query para obtener ese lector .. Ojo!, cuando es un text debe estar en ' '
$sql = " SELECT rut FROM trabajador WHERE rut = '".$rut."'";

$result = mysqli_query($conn, $sql);
///mysqli_close($conn);
$foo = new StdClass();


//si la query tiene mas de 1 celda... es porque existe (enviar mensasaje de q no se ingreso)
if (mysqli_num_rows($result)>0) 
{
   //echo "true"; ->mensaje tipo json
	$foo->mensaje = "true";
	$foo->mensaje = "El bibliotecario ya existe";
	echo json_encode($foo);
}
//else : enviar mensaej de q se ingreso 
else 
{
    //echo "falso"; ->mensaje tipo json
	//Insert
	$sql = "INSERT INTO trabajador (rut, nombre, apellidoPaterno, apellidoMaterno, direccion, telefono, correoElectronico, contrasena, contactoEmergenciaNombre,contactoEmergenciaTelefono,tipo) VALUES ('".$rut."','".$nombre."','".$apaterno."','".$amaterno."','".$direccion."','".$telefono."','".$correo."','".$contrasena."','".$contactoemergencianombre."','".$contactoemergenciatelefono."','bib');";
	//print_r($sql);

	$result = mysqli_query($conn, $sql);
	
	//echo "mensje"; tipo jsons
	$foo->mensaje = "false";
	$foo->mensaje = "Bibliotecario registrado exitosamente";
	echo json_encode($foo);
}

mysqli_close($conn);
 ?>