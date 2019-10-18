<?php

class Game{
    private $phrase;
    private $lives = 5;

    /**
     * --tested
     * Game constructor
     * @param $phrase -> an object of class Phrase
     */
    public function __construct(Phrase $phrase)
    {
        $this->phrase = $phrase;
    }

    /**
     * @return Phrase
     */
    public function getPhrase(): Phrase
    {
        return $this->phrase;
    }





    /**
     * --tested
     * compare the selected letters with current phrase to check if player has win
     * @return bool -> true => win; false => not yet win
     */
    public function checkForWin(){
        // pop out spaces and lowercase the phrase
        $arrayToBeCompared = array_map('strtolower' ,array_diff(str_split($this->phrase->getCurrentPhrase()), [" "]));
        // selected letters
        $arrayToCompare = array_map('strtolower' , $this->phrase->getSelected());
        $undiscoveredLetters = array_diff($arrayToBeCompared, $arrayToCompare);
        if(count($undiscoveredLetters) == 0){
            return true;
        } else {
            return false;
        }
    }

    /**
     * --tested
     * Check if player has guessed too many wrong answers
     * @return bool -> true => death; false => alive
     */
    public function checkForLose()
    {
        if($this->lives <= 0){
            return true;
        } else {
            return false;
        }
    }

    /**
     * --tested
     * check if game is over
     * @return bool -> false => not yet over; true => gameover
     */
    public function gameOver()
    {
        if(!$this->checkForLose() && !$this->checkForWin()){
            return false;
        } else {
            return true;
        }
    }

    /**
     * -- Underconstruction
     * -- Tested
     * @return string -> html for keyboard according to the keys' state (correct, incorrect, selected)
     */
    public function displayKeyboard()
    {
        $firstRow = ["q", "w", "e", "r", "t", "y", "u", "i", "o", "p"];
        $secondRow = ["a", "s", "d", "f", "g", "h", "j", "k", "l"];
        $thirdRow = ["z", "x", "c", "v", "b", "n", "m"];
        $keyboardHtml = "";

        $keyboardHtml = $keyboardHtml . "<div id=\"qwerty\" class=\"section\"><div class='keyrow'>";

        foreach ($firstRow as $letter){
            if(in_array($letter , array_map('strtolower', $this->phrase->getSelected())) && in_array($letter, array_map("strtolower", str_split($this->phrase->getCurrentPhrase())))){
                $keyboardHtml = $keyboardHtml . "<button type='submit' class='key correct' disabled>$letter</button>";
            }
        }

        $keyboardHtml = $keyboardHtml . "</div>";

        $keyboardHtml = $keyboardHtml . "<div class=\"keyrow\">";

        foreach ($secondRow as $letter){
            if(in_array($letter , array_map('strtolower', $this->phrase->getSelected())) && in_array($letter, array_map("strtolower", str_split($this->phrase->getCurrentPhrase())))){

                $keyboardHtml = $keyboardHtml . "<button type='submit' class='key correct' disabled>$letter</button>";
            }
        }

        $keyboardHtml = $keyboardHtml . "</div>";

        $keyboardHtml = $keyboardHtml . "<div class=\"keyrow\">";

        foreach ($thirdRow as $letter){
            if(in_array($letter , array_map('strtolower', $this->phrase->getSelected())) && in_array($letter, array_map("strtolower", str_split($this->phrase->getCurrentPhrase())))){
                $keyboardHtml = $keyboardHtml . "<button type='submit' class='key correct' disabled>$letter</button>";
            }
        }

        $keyboardHtml = $keyboardHtml . "</div></div>";

        return $keyboardHtml;

    }

    public function displayScore()
    {}
}