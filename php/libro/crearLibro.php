<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Estos datos deben coincidir con el otro lado
$isbn = $_POST["isbn"];
$autor = $_POST["autor"];
$anio = $_POST["anio"];
$dewey = $_POST["dewey"];
$titulo = $_POST["titulo"];
$edicion = $_POST["edicion"];


//crear query para obtener ese libro .. Ojo!, cuando es un text debe estar en ' '
$sql = " SELECT * FROM libro  WHERE isbn = '".$isbn."';";

$result = mysqli_query($conn, $sql);
///mysqli_close($conn);
$foo = new StdClass();


//si la query tiene mas de 1 celda... es porque existe (enviar mensasaje de q no se ingreso)
if (mysqli_num_rows($result)>0) 
{
   //echo "true"; ->mensaje tipo json
	$foo->tipo = "true";
	$foo->mensaje = "El libro ya existe";
	echo json_encode($foo);
}
//else : enviar mensaej de q se ingreso 
else 
{
    //echo "falso"; ->mensaje tipo json
	//Insert
	$sql = "INSERT INTO libro (isbn, autor, anio, dewey, titulo, edicion) VALUES ('".$isbn."','".$autor."',".$anio.",'".$dewey."','".$titulo."','".$edicion."');"; 
	//print_r($sql);

	$result = mysqli_query($conn, $sql);
	
	//echo "mensje"; tipo jsons
	$foo->tipo = "false";
	$foo->mensaje = "Libro creado exitosamente";
	echo json_encode($foo);
}

mysqli_close($conn);
 ?>