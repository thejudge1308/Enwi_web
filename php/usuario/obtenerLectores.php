<?php 
<<<<<<< Updated upstream
=======
	include "../db.php";
	header("Content-Type: application/json; charset=UTF-8");
>>>>>>> Stashed changes


<<<<<<< Updated upstream
include "../db.php";
//header("Content-Type: application/json; charset=UTF-8");

$sql = "SELECT * FROM lector";
$result = mysqli_query($conn, $sql);
$foo = new StdClass();


if ($result->num_rows > 0) 
{
    //echo "true"; 
	$foo = true;
	$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
			
		    $rows[] = $r;
		}
		echo json_encode($rows);
}
else 
{
	//echo "false";
	echo json_encode(null);
}

=======
	$foo = new StdClass();

	if ($result->num_rows > 0) 
	{
	   //echo "true"; ->mensaje tipo json
		$foo->mensaje = "true";
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
			$rows[] = $r;
		}
		
			//$foo=$rows;
		$foo->datos = $rows;
		echo json_encode($foo);
	}
	//else : enviar mensaej de q se ingreso 
	else 
	{
		$foo->mensaje = "false";
		echo json_encode($foo);
	}
>>>>>>> Stashed changes

	mysqli_close($conn);
?>