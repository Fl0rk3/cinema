<?php
        session_start();

        require_once "../database/database.php";

        $id = $_POST['id'];

        $statement = $db->prepare("DELETE FROM cinema.schedule WHERE cinema.schedule.id=:id");
        $statement->execute([$id]);
        header("Location: ../sites/admin.php?void=list");