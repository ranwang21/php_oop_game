<?php


class Phrase
{
    private $currentPhrase = "";
    private $selected = [];

    /**
     * Phrase constructor.
     * @param string $currentPhrase
     * @param array $selected
     */
    public function __construct($currentPhrase = null, array $selected = null)
    {
        $this->currentPhrase = $currentPhrase;
        $this->selected = $selected;
    }


    public function addPhraseToDisplay(){
        return null;
    }

    public function checkLetter($letter){
        return false;
    }
}