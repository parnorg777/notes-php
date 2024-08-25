<?php
    $id = $_GET['id'];

    $json = file_get_contents("../TXT/text.txt");
    $json = json_decode($json);

    unset($json[$id]);
    $json = array_values($json);
    $json = json_encode($json);

    if(!is_dir("../TXT")) mkdir("../TXT");
    file_put_contents("../TXT/text.txt", $json);
    header("location: ../index.php");
?>