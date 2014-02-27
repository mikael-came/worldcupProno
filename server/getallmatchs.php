<?php

header('Content-Type: text/html; charset=iso-8859-15');

$data = json_decode(file_get_contents("php://input"));
$id_Competition =$data->id_Competition;

$con = mysqli_connect('localhost','user_123','FHPT6YteczmeqPUS','worldcup');

if (!$con)
  {
  die('Could not connect: ' . mysqli_error($con));
  }

mysqli_select_db($con,"ajax_demo");
$sql='SELECT matchs.id, grp.id as id_groupe_matchs, grp.nom_groupe, matchs.date,equipe1.id as id_equipe1, equipe2.id as id_equipe2,
equipe1.nom_equipe as equipe1,equipe2.nom_equipe as equipe2
FROM  `matchs` 
LEFT JOIN  `groupe_matchs` AS grp ON grp.id = matchs.id_groupe_matchs
LEFT JOIN  `equipes` equipe1 ON matchs.id_equipe1 = equipe1.ID
LEFT JOIN  `equipes` equipe2 ON matchs.id_equipe2 = equipe2.ID
left JOIN `competition` competition on competition.id=grp.id_competition
where competition.id ='. $id_Competition;



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
  $donnee = $donnee .'"id_groupe_match" : "'. $row['id_groupe_matchs'] . '", ';
  $donnee = $donnee .'"nom_groupe" : "'. $row['nom_groupe'] . '", ';
  $donnee = $donnee .' "id_equipe1" : "'. $row['id_equipe1'] . '", ';
  $donnee = $donnee .' "equipe1" : "'. $row['equipe1'] . '", ';
  $donnee = $donnee .' "equipe2" : "'. $row['equipe2'] . '", '; 
  $donnee = $donnee .' "id_equipe2" : "'. $row['id_equipe2'] . '" }';
  }
  if($donnee !=""){
    $donnee = $donnee ."]}";
  }

echo  $donnee;

//echo json_encode($donnee);
mysqli_close($con);
?>