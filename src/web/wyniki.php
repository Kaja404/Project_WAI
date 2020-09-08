<?php
	session_start();
	use MongoDB\BSON\ObjectID;
	require_once 'funkcje.php';
	
	$db = get_db();

	$zdjecia = $db->zdjecia->find();
	$q = $_REQUEST["q"];
	$wynik = "";

	if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($zdjecia as $zdjecie) {
        if ((stristr($q, substr($zdjecie['tytul'], 0, $len)))&&(((isset($zdjecie['widocznosc']))&&($zdjecie['widocznosc']=='publiczne'))||((isset($zdjecie['widocznosc']))&&(isset($_SESSION['login']))&&($zdjecie['widocznosc']=='prywatne'.$_SESSION['login']))||(!isset($zdjecie['widocznosc'])))) {
            if ($wynik === "") {
				echo '<image src="images/mini_'.$zdjecie['nazwa'].'"/> ';
                $wynik = $zdjecie['nazwa'];
            } else {
                echo '<image src="images/mini_'.$zdjecie['nazwa'].'"/> ';
				$wynik = $zdjecie['nazwa'];
            }
        }
    }
}

if ($wynik=="") echo "brak wyników";


?>