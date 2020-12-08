<?php
session_start();

require_once '../database/database.php';
include '../php/functions.php';

$result = get_Places($db, $_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WT - Rezerwacja</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/reserv.css">
    <script>
    var places = <?php echo json_encode($result);?>;
    var movie_id = <?php echo json_encode($_GET['id']);?>;
    console.log(movie_id, places)
    </script>
</head>

<body onload="start(movie_id)">
    <header>
        <div id="logoR">WATCH <br /> TOGETHER</div>
        <div id="nav">
        </div>
    </header>
    <div id="progress">
        <div class="field" id="p1">1. Regulamin</div>
        <div class="field" id="p2">2. Wybór Biletów</div>
        <div class="field" id="p3">3. Zamówienie</div>
        <div class="field" id="p4">4. Potwierdzenie</div>
    </div>
    <div id="container">
        <div class="box" id="b1">
            <h2>Bilety</h2>
            <div><span style="color: red">*</span>pole wymagane</div>

            <br /><br />

            <h3>Wybierz<span style="color: red">*</span></h3>

            <label><input type="radio" name="type" id="zar" checked><span id="tit">Zarezerwuj</span><br />
                <span id="par">Zarezerwuj teraz i kup bilet w kasie kina nie później niż 30 minut przed rozpoczęciem
                    seansu.</span>
            </label>

            <hr style="border-top: 2px solid black;" />

            <label><input type="radio" name="type" id="kup" disabled><span id="tit">Kup bilety</span><br />
                <span id="par">Dostępne wkrótce!</span>
            </label>

            <label><input type="checkbox" name="regIn" id="regCheck"><span id="reg"><span
                        style="color: red">*</span>Przeczytałam(em)
                    i akceptuję
                    <span style="color: #f5821e;">Regulamin rezerwacji biletów
                        on-line Watch Together.</span></span>
            </label>

            <div id="alert1" class="alert"></div>

            <hr style="border-top: 2px solid orange;" />

            <button onclick="button1()">Dalej</button>
        </div>
        <div class="box" id="b2">
            <div id="flex">
                <div id="info">
                    <?php
                    get_MovieInfo($db, $_GET['id']);
                ?>
                </div>
                <div id="tickets">
                    <h2>Wybierz bilet</h2>
                    <div id="alert2" class="alert"></div>
                    <div id="table">
                        <div class="row">
                            <div class="column1 title">Rodzaj</div>
                            <div class="column title">Cena</div>
                            <div class="column title">Ilość</div>
                        </div>
                        <hr style="border-top: 2px solid orange" />
                        <div class="row">
                            <div class="column1 title">Normalny</div>
                            <div class="column normal">34.00 zł</div>
                            <div class="column normal">
                                <select name="normalny" id="normalny">
                                    <option value="0" default>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                        </div>
                        <hr style="border-top: 1px dashed gray" />
                        <div class="row">
                            <div class="column1 title">Studencki</div>
                            <div class="column normal">26.00 zł</div>
                            <div class="column normal">
                                <select name="studencki" id="studencki">
                                    <option value="0" default>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                        </div>
                        <hr style="border-top: 1px dashed gray" />
                        <div class="row">
                            <div class="column1 title">Ulgowy</div>
                            <div class="column normal">25.00 zł</div>
                            <div class="column normal">
                                <select name="ulgowy" id="ulgowy">
                                    <option value="0" default>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                        </div>
                        <hr style="border-top: 1px dashed gray" />
                        <div class="row">
                            <div class="column1 title">Seniorski</div>
                            <div class="column normal">26.00 zł</div>
                            <div class="column normal">
                                <select name="seniorski" id="seniorski">
                                    <option value="0" default>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                        </div>
                        <hr style="border-top: 2px solid orange" />
                    </div>
                    <button onclick="button2(places)">Wybierz miejsca</button>
                </div>
            </div>
        </div>
        <div class="box" id="b3">
            <div id="flex">
                <div id="info">
                    <?php
                    get_MovieInfo($db, $_GET['id']);
                ?>
                </div>
                <div id="sala">
                    <h2>Wybierz miejsca</h2>
                    <div id="liczbaM"></div>
                    <hr style="border-top: 1px solid gray" />
                    <div id="colors">
                        <div id="colorsBox">
                            <div class="cBox green"></div> DOSTĘPNE
                        </div>
                        <div id="colorsBox">
                            <div class="cBox gray"></div> NIEDOSTĘPNE
                        </div>
                        <div id="colorsBox">
                            <div class="cBox orange"></div> TWÓJ WYBÓR
                        </div>
                    </div>
                    <div id="mapa">
                    </div>
                    <div id="alert3" class="alert"></div>
                    <div id="buttons">
                        <button onclick="box2()">Wstecz</button>
                        <button onclick="button3()">Dalej</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="box" id="b4">
            <h2>Twoje dane</h2>
            <div id="dane">
                <div class="row">
                    <label><span style="color: red">*</span>Imię<br />
                        <input type="text" name="imie" id="imie" placeholder="Imię">
                    </label>
                    <label><span style="color: red">*</span>Nazwisko<br />
                        <input type="text" name="nazwisko" id="nazwisko" placeholder="Nazwisko">
                    </label>
                </div>
                <div class="row">
                    <label><span style="color: red">*</span>E-mail<br />
                        <input type="email" name="mail" id="mail" placeholder="E-mail">
                    </label>
                    <label><span style="color: red">*</span>Numer telefonu<br />
                        <input type="tel" id="phone" name="phone" placeholder="Numer telefonu"
                            pattern="[0-9]{3}[0-9]{3}[0-9]{3}">
                    </label>
                </div>
            </div>
            <span style="color: red">*</span> = Pola wymagane<br />
            <div class="alert" id="alert4"></div>
            <div id="buttons">
                <button onclick="back_button4()">Wstecz</button>
                <button onclick="button4()">Dalej</button>
            </div>
        </div>
        <div class="box" id="b5">
            <h2>Podsumowanie rezerwacji</h2>
            <div id="up">
                <div id="dane">
                    <h3>Dane osobowe</h3>
                    <div class="dBox">Imię: <span id="imiePod" class="personal"></span></div>
                    <div class="dBox">Nazwisko: <span id="nazwiskoPod" class="personal"></span></div>
                    <div class="dBox">E-mail: <span id="mailPod" class="personal"></span></div>
                    <div class="dBox">Numer telefonu: <span id="phonePod" class="personal"></span></div>
                </div>
                <div id="movie">
                    <h3>Informacje o filmie</h3>
                    <?php
                        get_MovieInfo($db, $_GET['id']);
                    ?>
                </div>
            </div>
            <div id="bilety">
                <h3>Zarezerwowane bilety</h3>
                <div id="table">
                    <div class="row">
                        <div class="column1 title">Rodzaj</div>
                        <div class="column title">Ilość</div>
                        <div class="column title">Cena</div>
                    </div>
                    <hr style="border-top: 2px solid orange" />
                    <div class="row">
                        <div class="column1 title">Normalny</div>
                        <div class="column normal" id="normalnyIlosc"></div>
                        <div class="column normal" id="normalnyCena"></div>
                    </div>
                    <hr style="border-top: 1px dashed gray" />
                    <div class="row">
                        <div class="column1 title">Studencki</div>
                        <div class="column normal" id="studenckiIlosc"></div>
                        <div class="column normal" id="studenckiCena"></div>
                    </div>
                    <hr style="border-top: 1px dashed gray" />
                    <div class="row">
                        <div class="column1 title">Ulgowy</div>
                        <div class="column normal" id="ulgowyIlosc"></div>
                        <div class="column normal" id="ulgowyCena"></div>
                    </div>
                    <hr style="border-top: 1px dashed gray" />
                    <div class="row">
                        <div class="column1 title">Seniorski</div>
                        <div class="column normal" id="seniorskiIlosc"></div>
                        <div class="column normal" id="seniorskiCena"></div>
                    </div>
                    <hr style="border-top: 2px solid orange" />
                    <div class="row">
                        <div class="column1 title">Suma</div>
                        <div class="column normal" id="sumaBiletow"></div>
                        <div class="column normal" id="cenaBiletow"></div>
                    </div>
                </div>
                <div id="buttons">
                    <button onclick="box4()">Wstecz</button>
                    <button onclick="button5()">Zarezerwuj</button>
                </div>
            </div>
        </div>
        <div class="box" id="b6">
            <div id="flex">
                <h2>Rejestracja dokonana</h2>
                <img src="../gfx/succes.png" alt="success">
                <div id="opis">Rejestracja została pomyślnie dokonana!</div>
                <button onclick="button6()">Wróć do strony głównej</button>
            </div>
        </div>
    </div>
    <script src="../scripts/reserv.js">
    </script>
</body>

</html>