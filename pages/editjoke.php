<?php

/* if (isset($_POST['joketext'])) {

	$record = [
		'joketext' => $_POST['joketext'], 
		'id' => $_POST['id']
	];
	save($pdo, 'joke', $record, 'id');
	//update($pdo, 'joke', $record, 'id');

	header('location: jokes.php');
}
else {

	$results = find($pdo, 'joke', 'id', $_GET['id']);
	$joke = $results[0];

	$output = loadTemplate('../templates/editjoke.html.php', ['joke' => $joke]);

	$title = 'Edit joke';

} */
if (isset($_GET['id'])) {
	$results = $jokesTable->find('id', $_GET['id']);
	$record = $results[0];
}
else {
	$record = false;
	$date = new DateTime();
	$_POST['joke']['jokedate'] = $date->format('Y-m-d H:i:s');
}

if (isset($_POST['joke']['joketext'])) {
	$jokesTable->save($_POST['joke']);
	header('location: /jokes');
}
else {
	$output = loadTemplate('../templates/editjoke.html.php', ['joke' => $record]);
	$title = 'Edit joke';
}


