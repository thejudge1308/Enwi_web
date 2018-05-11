<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

$rut = $_POST["rut"];
$nombre = $_POST["nombre"];
$apaterno = $_POST["apellidoPaterno"];
$amaterno = $_POST["apellidoMateno"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$correo = $_POST["correoElectronico"];
$observacion = $_POST["observacion"];

//crear query para obtener ese lector
$sql = "SELECT * FROM lector WHERE rut=".$rut;
$result = mysqli_query($conn, $sql);

$foo = new StdClass();

//si la query tiene mas de 1 celda... es porque existe (enviar mensasaje de q no se ingreso)
if ($result->num_rows > 0) 
{
   //echo "true"; ->mensaje tipo json
	$foo->mensaje = true;
	$foo->mensaje = "El lector ya existe";
	echo json_encode($foo);
}
//else : enviar mensaej de q se ingreso 
else 
{
    //echo "falso"; ->mensaje tipo json
	//Insert
	$sql = "INSERT INTO lector (rut, nombre, apellidoPaterno, apellidoMaterno, direccion, telefono, correoElectronico, observacion) VALUES (".$rut.",".$nombre.",".$apaterno.",".$amaterno.",".$direccion.",".$telefono.",".$correo.",".$observacion.")";
	$result = mysqli_query($conn, $sql);
	//echo "mensje"; tipo jsons
	$foo->mensaje = false;
	$foo->mensaje = "Lector registrado exitosamente"
	echo json_encode($foo);
}

mysqli_close($conn);
 ?>