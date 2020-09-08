<?php

require '../../vendor/autoload.php';
use MongoDB\BSON\ObjectID;


function get_db()
{
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]);

    $db = $mongo->wai;

    return $db;
}

function wyswietl_zdjecia($wybor = "wszystkie"){

	$db = get_db();
	$i=0;
	$limit = 6;
	$ile_zdj = $db->zdjecia->count();
	if(isset($_GET['str']))
	{
		$strona = $_GET['str'];
	}
	else $strona=1;

	$opts = [
		'skip' => ($strona-1)*$limit,
		'limit' => $limit
	];

	if($wybor=='wszystkie') {$zdjecia = $db->zdjecia->find([],$opts);}
	else {$zdjecia = $db->zdjecia->find();}
?>
<table>
<form method="post" action="">
<tr>
<?php
foreach($zdjecia as $zdjecie){
	
	if((($wybor=="wszystkie")&&((!isset($zdjecie['widocznosc']))||($zdjecie['widocznosc']=='publiczne')||((isset($_SESSION['zalogowany']))&&($zdjecie['widocznosc']=="prywatne".$_SESSION['login']))))||(($wybor=="wybrane")&&(isset($_SESSION[''.$zdjecie['_id'].''])))){
	$i++;
?>
<td style="padding: 100px; border-style:none;font-size: 20px;text-align:center">
<a href="images/znak_<?=$zdjecie['nazwa']?>"><image src="images/mini_<?=$zdjecie['nazwa']?>"/></a>
</br>"<?=$zdjecie['tytul']?>"</br> ~ <?=$zdjecie['autor']?> </br>
<input type="checkbox" name="<?=$zdjecie['_id']?>" <?php if((isset($_SESSION[''.$zdjecie['_id'].'']))&&($wybor=="wszystkie")) echo $_SESSION[''.$zdjecie['_id'].'']; ?> />
<?php if((isset($_SESSION['zalogowany']))&&(isset($zdjecie['widocznosc']))&&($zdjecie['widocznosc']=="prywatne".$_SESSION['login'])) echo "</br>PRYWATNE"; ?>
</td>
<?php
}
if($i==3)
{
	echo '</tr><tr>';
	$i=0;
}
}
?>
</tr>
</table>
</form>
<?php
if($wybor=='wszystkie'){
for($j=1;$j<=ceil($ile_zdj/$limit);$j++)
{
	if ($strona==$j){
	echo "<a href=\"?str=$j\"><b>$j</b>  </a>";
	}
	else {
	echo "<a href=\"?str=$j\"> $j</a>";
	}

}
}
}

function czy_zalogowany()
{
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)){
		echo '<div><a href="wyloguj.php" style="font-size: 20px; float: right">'.$_SESSION['login'].' [WYLOGUJ]</a></div>';
	}
	else{
		echo '<div><a href="zaloguj.php" style="font-size: 20px; float: right">ZALOGUJ</a></div>';
	}
}

function info_blad()
{
	if(isset($_SESSION['error_f']))	echo '<span style="color:red">'.$_SESSION['error_f'].'</span></br>';
	if(isset($_SESSION['error_r']))	echo '<span style="color:red">'.$_SESSION['error_r'].'</span></br>';
	if(isset($_SESSION['przeslano']))	echo '<span>'.$_SESSION['przeslano'].'</span></br>';
	unset($_SESSION['przeslano']);
}

function zaznacz()
{
	$db = get_db();
	$zdjecia = $db->zdjecia->find();

	foreach($zdjecia as $zdjecie)
	{
		if(isset($_POST[''.$zdjecie['_id'].'']))
		{
			$_SESSION[''.$zdjecie['_id'].''] = 'checked';
		}
	}
}
function odznacz()
{
	
	$db = get_db();
	$zdjecia = $db->zdjecia->find();

	foreach($zdjecia as $zdjecie)
	{
		if(isset($_POST[''.$zdjecie['_id'].'']))
		{
			unset($_SESSION[''.$zdjecie['_id'].'']);
		}
	}
}

function pub_pryw()
{
	if(isset($_SESSION['zalogowany']))
	{
		?><input type="radio" name="widocznosc" value="publiczne" required >Publiczne</br> 
		<input type="radio" name="widocznosc" value="prywatne">Prywatne</br><?php
	}



}

?>