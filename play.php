<?php
// start the session
session_start();
require './inc/Game.php';
require './inc/Phrase.php';
// if no phrase in the session, create a new phrase object with a random currentPhrase property
if(!isset($_SESSION['phrase'])){
    $phrase = new Phrase();
    $_SESSION['phrase'] = $phrase->getCurrentPhrase();
    $_SESSION['selected'] = $phrase->getSelected();
} else {
    $phrase = new Phrase($_SESSION['phrase'], $_SESSION['selected']);
}

$game = new Game($phrase);


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
        <?php echo $game->getPhrase()->addPhraseToDisplay(); ?>
        <form action="test.php" method="get">
            <?php  echo $game->displayKeyboard(); ?>
        </form>
        <?php echo $game->displayScore();?>
    </div>
</div>

</body>
</html>
