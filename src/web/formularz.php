<?php session_start(); require 'funkcje.php' ?>
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
		<form action="przeslijfoto.php" method="post" enctype="multipart/form-data">
		Tytuł:</br>
		<input type="text" name="tytul" required/></br>
		Autor:</br>
		<input type="text" name="autor" value="<?php if(isset($_SESSION['zalogowany']))echo $_SESSION['login'] ?>" required/></br>
		Znak wodny:</br>
		<input type="text" name="z_wodny" required /></br></br>
		<input type="file" name="zdjecie" style="font-family: Andalus"/></br>
		<?php pub_pryw(); ?>
		</br><input type="submit" value="Wyślij"/></br>
<?php info_blad(); ?>
	</form>
 </article>
</body>
</html>