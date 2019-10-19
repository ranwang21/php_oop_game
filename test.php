<?php
require "./inc/Game.php";
require "./inc/Phrase.php";

$game = new Game(new Phrase());

// var_dump($game->displayKeyboard());

echo $game->displayScore();