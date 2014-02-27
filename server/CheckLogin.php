<?php

	header('Content-Type: text/html; charset=iso-8859-15');

	$data = json_decode(file_get_contents("php://input"));

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

	mysqli_select_db($con,"worldcup");

	$myusername = $data->utilisateur->pseudo;
	$mypassword = $data->utilisateur->pwd;

	// To protect MySQL injection (more detail about MySQL injection)
	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);

	
	$sql="SELECT * FROM utilisateur WHERE pseudo='$myusername' and pwd=MD5('$mypassword')";

	$result=mysqli_query($con,$sql);

	// Mysql_num_row is counting table row
	$count= mysqli_num_rows($result);
	
	mysqli_close($con);
	
	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1){

		echo "OK";
	}
	else {
		
		echo "Le mot de passe ou le nom d'utilisateur est incorrecte.";
		
	}
?>