<?php
session_start();
if(!isset($_SESSION['logged'])){
    header("Location: ./login.php");
}

require_once '../database/database.php';
include '../php/functions.php';
if(isset($_GET["void"])){
    if($_GET["void"]=="date"){
        $site = "view('dateid')";
    }else if($_GET["void"]=="list"){
        $site = "view('listid')";
    }
}else{
    $site = "view('seansid')";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch Together - admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/admin.css">
    <style>
    body {
        background: white;
    }
    </style>
</head>
<?php
echo "<body onload=".$site.">";
?>
<div id="container">
    <h1>Strona administracyjna</h1>
    <a href="../php/logout.php" id="logout">Wyloguj się</a>
    <nav>
        <opdiv onclick="view('seansid')">Dodawanie seansu</opdiv>
        <opdiv onclick="view('dateid')">Wybieranie daty</opdiv>
        <opdiv onclick="view('listid')">Lista seansów</opdiv>
    </nav>


    <div id="content">

        <div class="box" id="seansid" style="display: none;">
            <h2>Dodaj nazwę seansu:</h2>
            <form enctype="multipart/form-data" action="../php/addMovie.php" method="post">
                <label>Tytuł: <input type="text" name="title"></label>
                <label>Plakat: <input type="file" name="gpx"></label>
                <label>Gatunek: <input type="text" name="type"></label>
                <label>Produkcja: <input type="text" name="production"></label>
                <input type="submit" value="Dodaj">
            </form>
        </div>

        <div class="box" id="dateid" style="display: none;">
            <h2>Wybieranie daty seansu:</h2>
            <form action="../php/addTime.php" method="post">
                <label>Film: <select name="movie" id="movie">
                        <?php
                                write_Titles($db);
                            ?>
                    </select></label>
                <label>Dzień: <input type="date" name="date"></label>
                <label>Godzina: <select name="time" id="time">
                        <option value="11:00">11:00</option>
                        <option value="14:30">14:30</option>
                        <option value="18:00">18:00</option>
                        <option value="21:30">21:30</option>
                    </select></label>
                <input type="submit" value="Dodaj">
            </form>
            <?php
                if(isset($_SESSION['added'])){
                    echo $_SESSION['added'];
                    unset($_SESSION['added']);
                }
            ?>
        </div>

        <div class="box" id="listid" style="display: none;">
            <h2>Lista seansów:</h2>
            <table>
                <tr>
                    <td>ID</td>
                    <td>Tytuł</td>
                    <td>Data</td>
                    <td>Godzina</td>
                </tr>
                <?php
                        write_Movies($db);
                    ?>
            </table>
        </div>

    </div>
</div>
<script src="../scripts/admin.js"></script>
</body>

</html>