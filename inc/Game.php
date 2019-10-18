<?php

class Game{
    private $phrase;
    private $lives = 5;

    /**
     * Game constructor.
     * @param $phrase -> an object of class Phrase
     */
    public function __construct($phrase)
    {
        $this->phrase = $phrase;
    }

    public function checkForWin(){}

    public function checkForLose(){}

    public function gameOver(){
        return false;
    }

    public function displayKeyboard(){

    }

    public function displayScore(){}
}