<?php
require './inc/Game.php';
require './inc/Phrase.php';

$game = new Game(new Phrase());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Phrase Hunter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body>
<div class="main-container">
    <div id="banner" class="section">
        <h2 class="header">Phrase Hunter</h2>
        <form action="play.php" method="get">
            <?php  echo $game->displayKeyboard(); ?>
        </form>
    </div>
</div>

</body>
</html>
