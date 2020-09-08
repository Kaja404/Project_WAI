<?php 
	session_start();
	include 'funkcje.php';
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
<body>
    <header>
        <a href="index.html"><h1>Muay Thai</h1></a>
    </header>
<?php 
	czy_zalogowany();
?>
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
    <article>
		<h4 style="text-align:right;margin:0px" ><form method="post"><input type="submit" value="Usuń zaznaczone z zapamietanych" name="submit"/></h4>

<?php
if(isset($_POST['submit']))
{
   odznacz();
} 
	wyswietl_zdjecia('wybrane');
?>
</form>
    </article>

</body>
</html>