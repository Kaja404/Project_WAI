<?php

	require 'funkcje.php';
	$db = get_db();

	$query = [
		'tytul' => 'Olejek'
	];

	$db->zdjecia->deleteOne($query);

	$zdjecia = $db->zdjecia->find();
	foreach($zdjecia as $zdjecie)
	{
		echo $zdjecie['tytul'];
	}
?>