<?php

	
require_once 'funkcje.php';
use MongoDB\BSON\ObjectID;


$db = get_db();

	if(isset($_POST['email']))
	{
		$walidacja = true;
		
		$login = $_POST['login'];
		$email = $_POST['email'];
		$email_s = filter_var($email,FILTER_SANITIZE_EMAIL);
		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];
		
		$query = [
		'login' => $login
		];

		$ilu = $db->uzytkownicy->count($query);

		if($ilu>0){
			$walidacja = false;
			$_SESSION['e_login']="Login jest zajęty!";
		}
		if((strlen($login)<3)||(strlen($login)>20))
		{
			$walidacja = false;
			$_SESSION['e_login']="Login musi posiadać od 3 do 20 znaków!";
		}
		if(ctype_alnum($login)==false)
		{
			$walidacja=false;
			$_SESSION['e_login']="Login może składać się tylko z cyfr i liter (bez polskich znaków)!";
		}
		if((filter_var($email_s,FILTER_VALIDATE_EMAIL)==false)||($email_s!=$email))
		{
			$walidacja=false;
			$_SESSION['e_email']="Podaj poprawny e-mail!";
		}
		if((strlen($haslo1)<8)||(strlen($haslo1)>20))
		{
			$walidacja = false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków!";
		}
		if($haslo1!=$haslo2)
		{
			$walidacja = false;
			$_SESSION['e_haslo']="Hasła muszą być jednakowe!";
		}
		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);		
		if($walidacja==true)
		{
			$uzytkownik = [
				'login' => $login,
				'email' => $email,
				'haslo' => $haslo_hash
			];

			$db->uzytkownicy->insertOne($uzytkownik);
			exit(header('Location: zaloguj.php'));
		}
	}	
	
?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8" />
    <title>Muay Thai</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="Stylesheet" href="style.css" type="text/css" />
    <script type="text/javascript" src="javascript.js"></script>
    <script src="jquery.js"></script>
</head>
<body onload="odliczanie()">
    <header>
        <a href="index.html"><h1>Muay Thai</h1></a>
    </header>
    <menu>
        <a href="#" class="expand" onclick="menu()">&equiv;</a>
        <nav id="menu">
            <ol>

                <li><a href="specyfika.html" class="link">Historia</a></li>
                <li><a href="specyfika.html#wspolczesnie" class="link">Współcześnie</a></li>
                <li><a href="specyfika.html#techniki" class="link">Technika</a></li>
                <li><a href="specyfika.html#efekty" class="link">Efekty</a></li>
                <li><a href="index.php" class="link">Galeria</a></li>
                <li>
                    <a href="#" id="opcja_5">Zacznij już dziś!</a>
                    <ul>
                        <li><a href="kontakt.html">Kontakt</a></li>
                        <li><a href="https://www.google.com/maps/search/muay+thai/@54.373558,18.6067542,14z/data=!3m1!4b1" target="_blank">Kluby w pobliżu</a></li>
                        <li><a href="kwestionariusz.html">Kwestionariusz</a></li>
                    </ul>
                </li>
            </ol>
        </nav>
        <br />
        <br />
    </menu>
    <br />
    <article style="text-align:center">
		<div style="font-size: 30px">Rejestracja</div>
		<form method="post">
		
		Login:</br><input type="text" name="login" required/></br>
<?php
	if(isset($_SESSION['e_login']))
	{
		echo '<div style="color:red">'.$_SESSION['e_login'].'</div>';
		unset($_SESSION['e_login']);
	}
?>
		E-mail:</br><input type="text" name="email" required/></br>
<?php
	if(isset($_SESSION['e_email']))
	{
		echo '<div style="color:red">'.$_SESSION['e_email'].'</div>';
		unset($_SESSION['e_email']);
	}
?>
		Hasło:</br><input type="password" name="haslo1" required/></br>
<?php
	if(isset($_SESSION['e_haslo']))
	{
		echo '<div style="color:red">'.$_SESSION['e_haslo'].'</div>';
		unset($_SESSION['e_haslo']);
	}
?>
		Powtórz hasło:</br><input type="password" name="haslo2" required/></br>
		</br><input type="submit" value="Zarejestruj się">
		
	</form>

    </article>
</body>
</html>