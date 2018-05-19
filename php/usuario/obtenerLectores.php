<?php 


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


	mysqli_close($conn);
?>