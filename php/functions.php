<?php

    function write_Titles($db){
        $statement = $db->prepare("SELECT title FROM cinema.seans");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_COLUMN);
        for($i=0;$i<count($result);$i++){
            echo "<option value='".($i+1)."'>".$result[$i]."</option>";
        }
    }

    function write_Movies($db){
        $statement = $db->prepare("SELECT cinema.schedule.id, cinema.seans.title, cinema.schedule.date, cinema.schedule.time
        FROM cinema.schedule
        INNER JOIN cinema.seans
        ON cinema.schedule.seans_id = cinema.seans.id
        ORDER BY cinema.schedule.date, cinema.schedule.time");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row){
            echo "<tr><td>".$row['id']."</td><td>".$row['title']."</td><td>".$row['date']."</td><td>".$row["time"]."</td><td><form action=../php/delete.php method='post'><input type='text' name='id' value='".$row['id']."' hidden /><input type='submit' name='delete' value='Usuń'/></form></td></tr>";
        }
    }

    function index_Movies($db){
        $statement = $db->prepare("SELECT *
        FROM cinema.seans");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row){
            echo "<a href='./sites/calendar.php?id=".$row['id']."' class='movie'><div><img src='".$row['src']."' class='movieImage'><br/><span id='title'>".$row['Title']."</span></div></a>";
        }
    }

    function get_title($db, $id){
        $statement = $db->prepare("SELECT Title
        FROM cinema.seans
        WHERE id=$id");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row){
            echo "<title>WT - ".$row['Title']."</title>";
        }
    }

    function info_Movie($db, $id){
        $statement = $db->prepare("SELECT *
        FROM cinema.seans
        WHERE cinema.seans.id = $id");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row){
            echo "<div id='movie'>
                    <div id='info'>
                        <div id='title'>".$row["Title"]."</div>
                        <div><span id='bold'>Gatunek: </span><i>".$row["type"]."</i></div>
                        <div><span id='bold'>Produkcja: </span><i>".$row["production"]."</i></div>
                    </div>
                    <div id='gfx'>
                        <img src='.".$row["src"]."' id='gfxImg'>
                    </div>
                </div>";
        }
    }

    function get_Schedule($db, $id){
        if(is_null($id)){
            $statement = $db->prepare("SELECT schedule.id, schedule.seans_id, seans.Title, schedule.date, schedule.time
            FROM cinema.schedule
            INNER JOIN cinema.seans
            ON cinema.schedule.seans_id=cinema.seans.id
            ORDER BY cinema.schedule.date, cinema.schedule.time");
        }else{
            $statement = $db->prepare("SELECT schedule.id, schedule.seans_id, seans.Title, schedule.date, schedule.time
            FROM cinema.schedule
            INNER JOIN cinema.seans
            ON cinema.schedule.seans_id=cinema.seans.id
            WHERE cinema.schedule.seans_id=$id
            ORDER BY cinema.schedule.date, cinema.schedule.time");
        }
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $date = 0;
        foreach($result as $row){
            $now = $row['date'];
            $time = date("H:i", strtotime($row['time']));
            $day = date("w", strtotime($now));
            $month = date("m", strtotime($now));
            $day_name = ["Niedziela", "Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota"];
            $mont_name = [" ", "stycznia", "lutego", "marca", "kwietnia", "maja", "czerwca", "lipca", "sierpnia", "września", "października","listopada", "grudnia"];
            $now = date("d", strtotime($now));
            if($date!=$now){
                if($date!=0){
                    echo "</div>";
                }
                echo "<div class='day'><h3>".$day_name[$day].", ".$now." ".$mont_name[$month]."</h3>";
            }
            echo "<div class='seans'>
            <div class='field'>";
            if(is_null($id)){
                echo "<a href='?id=".$row['seans_id']."' class='title title_link'>".$row['Title']."</a>";
            }else{
                echo "<span class='title'>".$row['Title']."</span>";
            }
            echo "</div> 
            <div class='field hour''>".$time."</div>
            <div class='field reserv'><a href='../sites/hall.php?id=".$row['id']."' class='reserv_but'>REZERWACJA</a></div>
            </div>";
            $date = $now;
        }
    }

    function get_MovieInfo($db, $id){
        $statement = $db->prepare("SELECT * 
        FROM cinema.schedule 
        INNER JOIN cinema.seans 
        ON cinema.schedule.seans_id=cinema.seans.id 
        WHERE cinema.schedule.id = $id");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            echo "<span id='title'>".$row['Title']."</span><br/><span id='time'>".$row['date']." ".$time = date("H:i", strtotime($row['time']))."</span>";
        }
    }

    function get_Places($db, $id){
        $statement = $db->prepare("SELECT *
        FROM cinema.tickets
        WHERE seans_id=$id
        ORDER BY cinema.tickets.row, cinema.tickets.place");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }