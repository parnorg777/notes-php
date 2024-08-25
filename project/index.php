<?php 
    session_start();
    $notes = file_get_contents("TXT/text.txt");
    $notes = json_decode($notes);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" type="image" href="IMG/icon.png">
    <title>Заметки</title>
</head>
<body>
<main>
    <form action="SCRIPTS/about.php" method="post">
    <input type="text" placeholder="Название заметки" maxlength="15" name="title" required value="<?=$_SESSION['title'] ?? NULL?>">
    <textarea maxlength="300" placeholder="Текст заметки" name="textarea" required><?=$_SESSION['text'] ?? NULL?></textarea>
    <select name="colors">
    <?php
        $colors = [
            ['FFEBCD', 'Бежевый цвет'], 
            ['C2FF3D', 'Жёлтый цвет'], 
            ['FF3DE8', 'Фиолетовый цвет'], 
            ['3DC2FF', 'Голубой цвет'],
            ['04E022', 'Зелёный цвет'],
            ['EBB328', 'Оранжевый цвет'],
        ];

        $selected = $_SESSION['color'] ?? NULL;

        foreach($colors as $color) {
            if($color[0] == $selected) {
                echo "<option value='$color[0]' selected>$color[1]</option>";
            }
            else {
                echo "<option value='$color[0]'>$color[1]</option>";
            }
        }
    ?>
    </select>
    <button class="btn-form">Отправить</button>
    <input value="<?=$_SESSION['time'] ?? NULL?>" name="time" hidden>
    <input value="<?=$_SESSION['index'] ?? NULL?>" name="index" hidden>
    </form>
</main>
<aside>
<?php
    $i = 0;

    foreach($notes as $note) {?>
    <div class="notes" style="background: #<?=$note[3]?>; text-decoration: <?=Style($i)?>">
            <span>#<?=$note[0]?> | </span><span><?=$note[1]?></span>
            <a href="SCRIPTS/delnote.php?id=<?=$i?>"><button class="btn-notes"><img src="IMG/close.png"></button></a>
            <a href="SCRIPTS/redactnote.php?id=<?=$i?>"><button class="btn-notes"><img src="IMG/redact.png"></button><hr></a>
            <pre><?=$note[2]?></pre>
        </div>
    <? $i++;}

    function Style($i) {
        $index = (isset($_SESSION['index'])) ? intval($_SESSION['index']) : NULL;
        return ($index === $i) ? 'line-through 2px;' : 'none;';
    }

    session_destroy();
?>
</aside>
</body>
</html>