<?php
	session_start();

	require_once 'funkcje.php';
	use MongoDB\BSON\ObjectID;
	
	$db = get_db();
	unset($_SESSION['error_f']);
	unset($_SESSION['error_r']);
	
	$tytul = $_POST['tytul'];
	$autor = $_POST['autor'];
	$z_wodny = $_POST['z_wodny'];
	if(isset($_POST['widocznosc'])&&($_POST['widocznosc']=='prywatne')){$widocznosc = $_POST['widocznosc'].$_SESSION['login'];}
	else {$widocznosc = 'publiczne';}
	$name = $_FILES['zdjecie']['name'];
	$type = $_FILES['zdjecie']['type'];
	$tmp_name = $_FILES['zdjecie']['tmp_name'];
	$error = $_FILES['zdjecie']['error'];
	$size = $_FILES['zdjecie']['size'];
	
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	$file_name = $_FILES['zdjecie']['tmp_name'];
	$mime_type = finfo_file($finfo, $file_name);
	if (($mime_type !== 'image/jpeg')&&($mime_type !== 'image/png')) 
	{
		$_SESSION['error_f'] = "Niepoprawny format!";
		exit(header('Location: formularz.php'));
	}
	if($_FILES['zdjecie']['size']>1000000)
	{
		$_SESSION['error_r'] = "Zbyt duży rozmiar!";
		exit(header('Location: formularz.php'));
	}
	
	$upload_dir = '/var/www/dev/src/web/images/';
	$file = $_FILES['zdjecie'];
	$file_name = basename($file['name']);
	$target = $upload_dir . $file_name;
	$tmp_path = $file['tmp_name'];
	if(move_uploaded_file($tmp_path, $target))
	{
		$zdjecie = [
				'tytul' => $tytul,
				'autor' => $autor,
				'nazwa' => $name,
				'type' => $type,
				'tmp_name' => $tmp_name,
				'bledy' => $error,
				'rozmiar' => $size,
				'widocznosc' => $widocznosc
			];

		$db->zdjecia->insertOne($zdjecie);

		unset($_SESSION['error_r']);
		unset($_SESSION['error_f']);
		$_SESSION['przeslano'] = "Zdjęcie zostało przesłane! :)";
	}
		
	$img = imagecreatefromjpeg("images/$name");
	$img_znak = imagecreatefromjpeg("images/$name");
	$width  = imagesx($img);
	$height = imagesy($img);
	$width_mini = 125;
	$height_mini = 200;
	$color = imagecolorallocate($img_znak,0,0,0);
	$img_mini = imagecreatetruecolor($width_mini, $height_mini);
	imagecopyresampled($img_mini, $img, 0, 0, 0, 0, $width_mini , $height_mini, $width  , $height);
	imagestring($img_znak,6,10,10, $z_wodny, $color);
	imagejpeg($img_mini, "images/mini_$name", 100);
	imagejpeg($img_znak, "images/znak_$name", 100);
	imagedestroy($img);
	imagedestroy($img_mini);
	imagedestroy($img_znak);
	header('Location: formularz.php');
?>