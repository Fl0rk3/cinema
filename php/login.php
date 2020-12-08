<?php

    session_start();

    require_once '../database/database.php';

    $login = $_POST['login'];
    $password = $_POST['password'];

    $statement = $db->prepare("SELECT * FROM cinema.admins WHERE login=:logi AND password=:pass");
    $statement->execute([$login, $password]);
    $count = $statement->rowCount();
    if($count!=0){
        $_SESSION['logged']=true;
        header("Location: ../sites/admin.php");
    }else{
        $_SESSION['errorLogin']="Invalid Token";
        header("Location: ../sites/login.php");
    }