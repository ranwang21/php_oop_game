<?php
// start the session
session_start();
require './inc/Game.php';
require './inc/Phrase.php';
// if no phrase in the session, create a new phrase object with a random currentPhrase property
// if no phrase in the session, create a new phrase object with a random currentPhrase property
if(!isset($_SESSION['phrase'])){
    $phrase = new Phrase();
    $game = new Game($phrase);
    $_SESSION['phrase'] = $game->getPhrase()->getCurrentPhrase();
    $_SESSION['selected'] = $game->getPhrase()->getSelected();
    $_SESSION['lives'] = $game->getLives();
} else if(isset($_GET['key'])){
        // get the key pressed from the get request parameter
        $keyPressed = trim(filter_input(INPUT_GET, 'key', FILTER_SANITIZE_STRING));
        $selected = $_SESSION['selected'];
        // push the key to the session as selected if the guess is correct
        array_push($selected, $keyPressed);
        // update selected session
        $_SESSION['selected'] = $selected;
        // construct new phrase with the updated array
        $phrase = new Phrase($_SESSION['phrase'], $selected);
        // check if selected key match phrase
        if($phrase->checkLetter($_GET['key'])){
            $game = new Game($phrase, $_SESSION['lives']);
            if($game->gameOver() == "Congratulations, you win!"){
                session_destroy();
                header("location:index.php?message=" . $game->gameOver());
            }
        } else {
            $game = new Game($phrase, $_SESSION['lives']);
            // decrease lives then update session
            $game->decreaseLive();
            $_SESSION['lives'] = $game->getLives();
            if($game->gameOver() == "Sorry, you lose!"){
                session_destroy();
                header("location:index.php?message=" . $game->gameOver());
            }
        }
  // when user visit the url without giving a key parameter
} else {
    $phrase = new Phrase($_SESSION['phrase'], $_SESSION['selected']);
    $game = new Game($phrase, $_SESSION['lives']);
}

include './inc/header.php';
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
        <form action="play.php" method="get">
            <?php  echo $game->displayKeyboard(); ?>
        </form>
        <?php echo $game->displayScore();?>
    </div>
</div>

<?php include './inc/footer.php'; ?>

