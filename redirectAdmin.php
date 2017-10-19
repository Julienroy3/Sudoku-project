<?php 

// define variables and set to empty values
$dateErr = $timeStartErr = $timeEndErr = "";
$date = $timeStart = $timeEnd = "";

//Vérification des données saisies

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	# code...
	if (empty($_POST["dateContest"])) {
		# code...
		$dateErr = "A date is required !";

	} else {
		# code...
		$date = test_input($_POST["dateContest"]);
	}

	if (empty($_POST["timeStart"])) {
		# code...
		$timeStartErr = "A time to start is required !";
	} else {
		# code...
		$timeStart = test_input($_POST["timeStart"]);
	}

	if (empty($_POST["timeEnd"])) {
		# code...
		$timeEndErr = "A time to end is required !";

	} elseif ($_POST["timeStart"] >= $_POST["timeEnd"]) {
		# code...
		$timeEndErr = "The end time must be after the start time !";

	} else {
		# code...
		$timeEnd = test_input($_POST["timeEnd"]);
	}
	
	

} else {
	echo "WTF !";
	die();
}

//TODO Création et stockage de la grille de sudoku


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>