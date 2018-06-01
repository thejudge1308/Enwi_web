<?php 
include "../db.php";
header("Content-Type: application/json; charset=UTF-8");

$codigo = $_POST["codigo"];

$foo = new StdClass();
//Busca el ultimo nivel
$sql = "SELECT cantidadniveles FROM estante WHERE codigo = ".$codigo.";";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$nivel = intval($row[0]);

//Verifica si el ultimo nivel tiene copias
$sql = "SELECT COUNT(codigo) FROM copia WHERE copia.refNivel = ".$nivel." AND copia.refEstante = ".$codigo.";";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$resultado = intval($row[0]);

if ($resultado>0) {
	$foo->accion = "false";
	$foo->mensaje = "El nivel no puede eliminarse ya que tiene: ".$resultado."";
}else{
	$sql ="DELETE FROM nivel WHERE codigo =".$nivel."  AND codigoEstante = ".$codigo."";
	$result = mysqli_query($conn, $sql);
	error_log($sql, 0);
	$foo->accion = "true";
	$foo->mensaje = "El nivel se ha eliminado satisfactoriamente";
}

echo json_encode($foo);


mysqli_close($conn);
 ?>