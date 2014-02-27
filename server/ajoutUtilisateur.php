<?php

header('Content-Type: text/html; charset=iso-8859-15');

$data = json_decode(file_get_contents("php://input"));

$mail = $data->utilisateur->mail;


$pseudo = $data->utilisateur->pseudo;
$about = $data->utilisateur->about;
$pwd = $data->utilisateur->pwd;
// validate the variables ======================================================


$errors         = array();  	// array to hold validation errors
$data 			= array(); 		// array to pass back data

//Appel SQL 			 ======================================================

$con = mysqli_connect('localhost','user_123','FHPT6YteczmeqPUS','worldcup');

/* Vérification de la connexion */
if ($mysqli->connect_errno) {
    printf("Échec de la connexion : %s\n", $mysqli->connect_error);
    exit();
}

if (!$con)
{
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");

$sql="INSERT INTO `worldcup`.`utilisateur` (`id`, `mail`, `pseudo`, `about`, `pwd`)"
	  ."VALUES ('', '".$mail."', '".$pseudo."', '".$about."', MD5('".$pwd."'))";

$result = mysqli_query($con,$sql);

$errors = $mysqli->error;
echo $errors;

mysqli_close($con);

// Retourne une response ===========================================================




	// response if there are errors
	if ( ! empty($errors)) {

		// if there are items in our errors array, return those errors
		$data['success'] = false;
		$data['errors']  = $errors;
	} else {

		// if there are no errors, return a message
		$data['success'] = true;
		$data['message'] = 'Success!';
	}

	// return all our data to an AJAX call
	echo json_encode($data);



echo $result;
?>