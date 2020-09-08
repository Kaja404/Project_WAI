function odliczanie() {
    var dzisiaj = new Date();

    var godziny = dzisiaj.getHours();
    if (godziny < 10) godziny = "0" + godziny;
    var minuty = dzisiaj.getMinutes();
    if (minuty < 10) minuty = "0" + minuty;
    var sekundy = dzisiaj.getSeconds();
    if (sekundy < 10) sekundy = "0" + sekundy;

    document.getElementById("zegar").innerHTML = godziny + ":" + minuty + ":" + sekundy;


    setTimeout("odliczanie()", 1000);
}
function ankieta() {
    const div = document.querySelector("#ankieta");
    const usun = document.querySelector(".naglowek");

    const elementDoUsuniecia = div.querySelector("h2");
    div.removeChild(elementDoUsuniecia);

    var zakonczenie = document.createElement("h2");
    zakonczenie.innerText = "Powodzenia!"

    document.getElementById("ankieta").appendChild(zakonczenie);

    var n_tytul = document.createElement("h2");
    n_tytul.innerText = "Tajski boks (muay thai) - komu jest polecany?";
    n_tytul.className = "naglowek";

    var tresc = document.getElementById("pytania");
    var div_rodzic = tresc.parentNode;

    div_rodzic.insertBefore(n_tytul, tresc);

    document.getElementById("pytania").innerHTML = "Muay thai nie jest prostym sportem - aby uprawiać tę dyscyplinę, nawet w dużo łagodniejszej formule amatorskiej, trzeba być nastawionym na duży wysiłek siłowy oraz psychiczny. Ważne, aby od początku dysponować odpowiednim poziomem siły mięśniowej i mieć motywację do stałego zwiększania swoich możliwości. To dyscyplina odpowiednia dla tych, którzy dobrze czują się w sportach szybkich, dynamicznych, wymagających błyskawicznej reakcji. Dużo korzyści mogą odnieść z niej osoby, które chcą odchudzić i wymodelować swoją sylwetkę, a jednocześnie poprawić wydolność i koordynację ruchową. Warto wspomnieć także o efektach psychologicznych, jakie daje trenowanie tajskiego boksu. Sport ten wyrabia charakter, uczy wytrzymałości psychicznej i wytrwałości w dążeniu do celu. Zgłębiając technikę muay thai, można zwiększyć pewność siebie oraz nauczyć się kontroli nad własnymi odruchami. To także świetny sposób na odreagowanie stresu i negatywnych emocji nagromadzonych w ciągu dnia.";

    document.write(dane);
}
var numer = Math.floor(Math.random() * 5) + 1;

var timer1 = 0;
var timer2 = 0;

function ustaw_slajd(nrslajdu) {

    clearTimeout(timer1);
    clearTimeout(timer2);
    numer = nrslajdu - 1;

    schowaj();
    setTimeout("zmien_slajd()", 500);

}

function schowaj() {
    $("#slajder").fadeOut(500);
}

function zmien_slajd() {
    numer++;
    if (numer > 5) numer = 1;

    var plik = "<img src=\"img/slajd" + numer + ".jpg\"/>";

    document.getElementById("slajder").innerHTML = plik;

    $("#slajder").fadeIn(500);

    timer1 = setTimeout("zmien_slajd()", 5000);
    timer2 = setTimeout("schowaj()", 4500);
}

var hide = 0;
function menu() {


    if (hide == 0) {
        document.getElementById("menu").style.display = "block";
        hide = 1;
    }
    else if (hide == 1) {
        document.getElementById("menu").style.display = "none";
        hide = 0;
    }

}

