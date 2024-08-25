<?php
    session_start();

    $id = $_GET['id'];
    $json = file_get_contents("../TXT/text.txt");
    $json = json_decode($json);

    $_SESSION['title'] = $json[$id][0];
    $_SESSION['time'] = $json[$id][1];
    $_SESSION['text'] = $json[$id][2];
    $_SESSION['color'] = $json[$id][3];
    $_SESSION['index'] = $id;

    header("location: ../index.php");
?>