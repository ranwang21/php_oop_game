<?php
// start the session
session_start();
require './inc/Game.php';
require './inc/Phrase.php';
// get the parameter if exists
$phrase = new Phrase();
$game = new Game($phrase);
$arrayToBeCompared = array_map('strtolower' ,array_diff(str_split($game->getPhrase()->getCurrentPhrase()), [" "]));
$arrayToCompare = array_map('strtolower' , $game->getPhrase()->getSelected());

$undiscoveredLetters = array_diff($arrayToBeCompared, $arrayToCompare);

var_dump(count($undiscoveredLetters) == 0);