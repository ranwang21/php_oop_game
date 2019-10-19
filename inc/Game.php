<?php

class Game{
    private $phrase;
    private $lives = 5;

    /**
     * --tested
     * Game constructor
     * @param Phrase $phrase -> an object of class Phrase
     * @param int $lives -> number of lives
     */
    public function __construct(Phrase $phrase, int $lives = 5)
    {
        $this->phrase = $phrase;
        $this->lives = $lives;
    }

    /**
     * @return int
     */
    public function getLives(): int
    {
        return $this->lives;
    }

    /**
     * decrease one live when the letter guessed is wrong
     */
    public function decreaseLive():void
    {
        $this->lives--;
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
            if($this->checkForLose() && !$this->checkForWin()){
                return "Sorry, you lose!";
            }
            if($this->checkForWin() && !$this->checkForLose()){
                return "Congratulations, you win!";
            }
        }
    }

    /**
     * -- Tested
     * @return string -> html for keyboard
     */
    public function displayKeyboard()
    {
        $rows = [
            ["q", "w", "e", "r", "t", "y", "u", "i", "o", "p"],
            ["a", "s", "d", "f", "g", "h", "j", "k", "l"],
            ["z", "x", "c", "v", "b", "n", "m"]
        ];
        $keyboardHtml = "";
        $keyboardHtml = $keyboardHtml . "<div id=\"qwerty\" class=\"section\">";
        for ($i = 0; $i < 3; $i++){
            $keyboardHtml = $keyboardHtml . $this->constructKeyRow($rows[$i]);
        }
        $keyboardHtml = $keyboardHtml . "</div>";
        return $keyboardHtml;
    }

    /**
     * return html of a row of the keyboard with different class name according to its state (unselected, selected-correct, selected-incorrect)
     * @param array $row
     * @return string -> a row of the keyboard
     */
    private function constructKeyRow(array $row):string
    {
        $html = "<div class='keyrow'>";
        foreach ($row as $letter){
            if(in_array($letter , array_map('strtolower', $this->phrase->getSelected())) && in_array($letter, array_map("strtolower", str_split($this->phrase->getCurrentPhrase())))){
                $html = $html . "<button type='submit' name='key' value='" . $letter . "' class='key correct' disabled>$letter</button>";
            }else if(in_array($letter , array_map('strtolower', $this->phrase->getSelected())) && !in_array($letter, array_map("strtolower", str_split($this->phrase->getCurrentPhrase())))){
                $html = $html . "<button type='submit' name='key' value='" . $letter . "' class='key incorrect' disabled>$letter</button>";
            }else if(!in_array($letter , array_map('strtolower', $this->phrase->getSelected()))){
                $html = $html . "<button type='submit' name='key' value='" . $letter . "' class=\"key\">$letter</button>";
            }
        }
        $html = $html . "</div>";
        return $html;
    }

    /**
     * -- TESTED
     * display score (hearts)
     * @return string -> html to display live and lost hearts
     */
    public function displayScore()
    {
        $scoreBoardHtml = "<div id=\"scoreboard\" class=\"section\"><ol>";
        for($i = 0; $i < $this->lives; $i ++){
            $scoreBoardHtml = $scoreBoardHtml . "<li class=\"tries\"><img src='../images/liveHeart.png' height='35px' widght='30px' alt='live-heart-icon'></li>";
        }
        for($i = 0; $i < (5 - $this->lives); $i++){
            $scoreBoardHtml = $scoreBoardHtml . "<li class=\"tries\"><img src='../images/lostHeart.png' height='35px' widght='30px' alt='lost-heart-icon'></li>";
        }
        return $scoreBoardHtml;
    }
}