<?php

	session_start();
	
	require_once 'funkcje.php';
	use MongoDB\BSON\ObjectID;


	$db = get_db();

	$login = $_POST['login'];
	$haslo = $_POST['haslo'];

	$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	
	$query = [
		'login' => $login
	];

	$ilu = $db->uzytkownicy->count($query);
	$uzytkownik = $db->uzytkownicy->findOne($query);

	if(($ilu>0)&&(password_verify($haslo,$uzytkownik['haslo'])))
	{
		$_SESSION['zalogowany']=true;
		$_SESSION['login'] = $uzytkownik['login'];
		unset($_SESSION['blad']);
		exit(header('Location: index.php'));
	}
	else
	{
		$_SESSION['blad']= '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
		exit(header('Location: zaloguj.php'));
	}

	
?>