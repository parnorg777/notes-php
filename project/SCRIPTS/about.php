<?php
    $json = file_get_contents("../TXT/text.txt");
    $json = json_decode($json);

    $title = $_POST['title'];
    $text = $_POST['textarea'];
    $color = $_POST['colors'];
    $index = $_POST['index'];

    if($index == '') {
        $time = date("d.m.y | H:i", strtotime("+2 Hours"));
        $json[count($json)] = [$title, $time, $text, $color];
    }
    else {
        $time = $_POST['time'];
        $json[$index] = [$title, $time, $text, $color];
    }

    $json = json_encode($json);

    if(!is_dir("../TXT")) mkdir("../TXT");
    file_put_contents("../TXT/text.txt", $json);
    header("location: ../index.php");
?>