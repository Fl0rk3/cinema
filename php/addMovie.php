<?php
session_start();

require_once '../database/database.php';

$title = $_POST['title'];
$gpx = $_FILES["gpx"];
$type = $_POST['type'];
$production = $_POST['production'];

$source = '../gfx/titles/' . $gpx['name'];
$dbsrc = './gfx/titles/' . $gpx['name'];

if (is_uploaded_file($gpx['tmp_name'])) {
    if (!move_uploaded_file($gpx['tmp_name'], $source)) {
        echo 'Error';
    } else {
        $statement = $db->prepare("INSERT INTO cinema.seans VALUES (null, :title, :src, :type, :production)");
        $statement->bindValue(':title', $title);
        $statement->bindValue(':src', $dbsrc);
        $statement->bindValue(':type', $type);
        $statement->bindValue(':production', $production);
        $statement->execute();
        header("Location: ../sites/admin.php");
    }
} else {
    echo 'Error';
}