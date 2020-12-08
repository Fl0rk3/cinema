<?php
    session_start();
    
    require_once '../database/database.php';

    $titleid = $_POST['movie'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    echo $titleid;
    echo $date;
    echo $time;

    $statement=$db->prepare("SELECT * FROM cinema.schedule WHERE date=:date AND time=:time");
    $statement->execute([$date, $time]);
    $result = count($statement->fetchALL(PDO::FETCH_ASSOC));

    if($result==0){
        $statement=$db->prepare("INSERT INTO cinema.schedule VALUES (null, :titleid, :date, :time)");
        $statement->execute([$titleid, $date, $time]);
        $_SESSION['added']="Dodano!";
    }else{
        $_SESSION['added']="Data zajęta!";
    }

    header("Location: ../sites/admin.php?void=date");