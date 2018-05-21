<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Estos datos deben coincidir con el otro lado
$codigo = $_POST["codigo"];
$isbnlibro = $_POST["isbnlibro"];
$numerocopia = $_POST["numerocopia"];
$estado = $_POST["estado"];
$ubicacion = $_POST["ubicacion"];


//crear query para obtener ese libro .. Ojo!, cuando es un text debe estar en ' '
$sql = " SELECT codigo FROM copia  WHERE codigo = '".$codigo."';";

$result = mysqli_query($conn, $sql);
///mysqli_close($conn);
$foo = new StdClass();


//si la query tiene mas de 1 celda... es porque existe (enviar mensasaje de q no se ingreso)
if (mysqli_num_rows($result)>0) 
{
   //echo "true"; ->mensaje tipo json
	$foo->mensaje = true;
	$foo->mensaje = "La copia ya existe";
	echo json_encode($foo);
}
//else : enviar mensaej de q se ingreso 
else 
{
    //echo "falso"; ->mensaje tipo json
	//Insert
	$sql = "INSERT INTO copia (codigo, isbnlibro, numerocopia,estado,ubicacion) VALUES ('".$codigo."','".$isbnlibro."','".$numerocopia."','".$estado."','".$ubicacion."');"; 
	//print_r($sql);

	$result = mysqli_query($conn, $sql);
	
	//echo "mensje"; tipo jsons
	$foo->mensaje = false;
	$foo->mensaje = "Copia registrada exitosamente";
	echo json_encode($foo);
}

mysqli_close($conn);
 ?>