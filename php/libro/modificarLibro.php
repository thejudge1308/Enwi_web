<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

//Estos datos deben coincidir con el otro lado
$isbn = $_POST["isbn"];
$autor = $_POST["autor"];
$anio = $_POST["anio"];$titulo = $_POST["titulo"];
$edicion = $_POST["edicion"];


//crear query para obtener ese lector .. Ojo!, cuando es un text debe estar en ' '
$sql = " SELECT isbn FROM libro  WHERE isbn = '".$isbn."'";

$result = mysqli_query($conn, $sql);
///mysqli_close($conn);
$foo = new StdClass();


//si la query tiene mas de 1 celda... es porque existe (enviar mensasaje de q no se ingreso)
if (mysqli_num_rows($result)>0) 
{
     //echo "falso"; ->mensaje tipo json
	//Insert
	$sql="UPDATE libro SET autor = '".$autor."',anio =  '".$anio."',titulo = '".$titulo."',edicion = '".$edicion."' WHERE isbn = '".$isbn."';";

	//$sql = "INSERT INTO libro (isbn, autor, anio, dewey, titulo, edicion) VALUES ('".$isbn."','".$autor."','".$anio."','".$dewey."','".$titulo."','".$edicion."');"; 
	//print_r($sql);

	$result = mysqli_query($conn, $sql);
	
	//echo "mensje"; tipo jsons
	$foo->mensaje = "Libro registrado exitosamente";
	echo json_encode($foo);
}
else{
	$foo->mensaje = "No se puede modificar";
	echo json_encode($foo);
}

mysqli_close($conn);
 ?>