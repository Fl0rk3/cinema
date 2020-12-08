<?php
    session_start();
    
    require_once '../database/database.php';

    $personal = json_decode($_POST['personal'], true);
    $tickets = json_decode($_POST['tickets'], true);
    $movie_id = json_decode($_POST['movie'], true);
 
    $imie = $personal["imie"];
    $nazwisko = $personal["nazwisko"];
    $mail = $personal["mail"];
    $phone = $personal["phone"];
    

    $statement = $db->prepare("SELECT *
    FROM cinema.customers
    WHERE cinema.customers.Name = '$imie'
    AND cinema.customers.Surename = '$nazwisko'
    AND cinema.customers.phone_number = $phone
    AND cinema.customers.email = '$mail'");
    $statement->execute();
    $count = $statement->rowCount();
    
    if($count==0){
        $statement = $db->prepare("INSERT INTO cinema.customers
        VALUES (null,'$imie','$nazwisko',$phone,'$mail')");
        if($statement->execute()){
            $idn = $db->lastInsertId();
            add_ticket($db,$tickets, $idn, $movie_id);
            echo 1;
            die();
        }else{
            echo 0;
            die();
        }
    }else{
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $ido = $row['id'];
        }
        add_ticket($db,$tickets, $ido, $movie_id);
        echo 1;
        die();
    }

    function add_ticket($db,$tickets, $id,$movie_id){
        foreach($tickets as $place){
            $row = $place['row'];
            $col = $place['column'];
            $statement = $db->prepare("INSERT INTO cinema.tickets (row,place,seans_id,customer_id)
            VALUES ($row,$col,$movie_id,$id)");
            $statement->execute();
        }
    }

    die();