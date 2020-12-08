<?php
session_start();

require_once '../database/database.php';
include '../php/functions.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        if(isset($_GET['id'])){
            get_title($db, $_GET['id']);
            
        }else{
            echo "<title>WT - Kalendarz </title>";
        }
    ?>
    <title>Watch Together</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/layout.css">
    <link rel="stylesheet" href="../css/calendar.css">
    <link rel="stylesheet" href="../css/text.css">
</head>

<body>
    <header>
        <a href="../index.php" id="logo">WATCH <br /> TOGETHER</a>
        <div id="nav">
            <span id="place">
                <img src="https://www.cinema-city.pl/xmedia/img/10103/locationpicker-map-marker.svg" />
                Wybierz swoje Kino
            </span>
            <a href="./sites/login.php" id="admin">Admin</a>
            <input type="search" id="search" placeholder="Szukaj..." />
        </div>
    </header>
    <div id="bar">
        <h1 class="ml15">
            <span class="word">Jesteśmy</span>
            <span class="word">otwarci!</span>
        </h1>
    </div>
    <div id="container">
        <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    info_Movie($db, $id);
                }
            ?>
        <div id="kalendarz">
            <h1>Terminarz seansów</h1>
            <div id="terminy">
                <?php
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        
                    }else{
                        $id = null;
                    }
                    get_Schedule($db, $id);
                ?>
            </div>
        </div>
    </div>
    <footer>
        Wszystkie prawa zastrzeżone Watch Together 2020 &copy; spółka zależna Together Inc.
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="../scripts/index.js"></script>
</body>

</html>