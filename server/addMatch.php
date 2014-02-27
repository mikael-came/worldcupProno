<?php

header('Content-Type: application/json');
 
// Ta-da, using $_POST as normal; PHP is able to
// unserialize the AngularJS request no problem


    $id_equipe1 = $_POST['id_equipe1'];
	$id_equipe2 = $_POST['id_equipe2'];
	$id_groupe_Matchs = $_POST['id_groupe_Matchs'];
	 	
	$date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $_POST['date'])));
	
	

$con = mysqli_connect('localhost','user_123','FHPT6YteczmeqPUS','worldcup');
//$con = mysqli_connect('localhost','root','root','worldcup');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }


mysqli_select_db($con,"ajax_demo");

$sql="INSERT INTO `matchs`( `date`, `id_equipe1`, `id_equipe2`, `id_groupe_Matchs`) 
VALUES ( '".$date."', '".$id_equipe1."', '".$id_equipe2."', '".$id_groupe_Matchs."');
";


$result = mysqli_query($con,$sql);
echo "done".$sql;
mysqli_close($con);


?>