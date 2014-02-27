<?php

header('Content-Type: text/html; charset=iso-8859-15');
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','user_123','FHPT6YteczmeqPUS','worldcup');
//$con = mysqli_connect('localhost','root','root','worldcup');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM  matchs where matchs.id_groupe_matchs=1";


$result = mysqli_query($con,$sql);


$first="true";
 
$donnee ="";
while($row = mysqli_fetch_array($result))
  {

    if($first=="true")
    {
      $first="false";
    $donnee = $donnee .'{"matchs" : [ ';
    }
    else{
      //virgule d'ajout de parametre
      $donnee= $donnee .",";
    }
  $donnee = $donnee .'{ "id" : "' . $row['id'] . '", ';
  $donnee = $donnee .' "date" : "'. $row['date'] . '", ';
   $donnee = $donnee .' "id_groupe_match" : "'. $row['id_groupe_matchs'] . '", ';
  $donnee = $donnee .' "id_equipe1" : "'. $row['id_equipe1'] . '", ';
  $donnee = $donnee .' "id_equipe1" : "'. $row['id_equipe2'] . '" }';
  }
$donnee = $donnee ."]}";
echo  $donnee;

//echo json_encode($donnee);
mysqli_close($con);
?>