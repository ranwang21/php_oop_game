<?php


class Phrase
{
    // random phrases
    private $phrases = [
        "my cat is sleeping",
        "weather is good",
        "knock knock",
        "hello world",
        "PHP is the best language"
    ];
    private $currentPhrase = "";
    private $selected = [];

    /**
     * --tested
     * Phrase constructor.
     * @param string $phrase
     * @param array $selected
     */
    public function __construct(string $phrase = null, array $selected = [])
    {
        if(!empty($phrase) && empty($selected)){
            $this->currentPhrase = $phrase;
        } else if(empty($phrase) && !empty($selected)){
            $randKey = array_rand($this->phrases);
            $this->currentPhrase = $this->phrases[$randKey];
            $this->selected = $selected;
        } else if(empty($phrase) && empty($selected)){
            $randKey = array_rand($this->phrases);
            $this->currentPhrase = $this->phrases[$randKey];
        } else if(!empty($phrase) && !empty($selected)){
            $this->currentPhrase = $phrase;
            $this->selected = $selected;
        }
    }

    /**
     * --tested
     * @return string|null
     */
    public function getCurrentPhrase(): ?string
    {
        return $this->currentPhrase;
    }

    /**
     * --tested
     * @return array
     */
    public function getSelected(): array
    {
        return $this->selected;
    }

    /**
     * --Tested
     * get the html of the phrase
     * @return string -> html of a splited phrase
     */
    public function addPhraseToDisplay(): string
    {
        $phraseHtml = "";
        $phraseHtml = $phraseHtml . "<div id='phrase' class='section'><ul>";
        foreach (str_split($this->currentPhrase) as $letter){
            if($letter == " "){
                $phraseHtml = $phraseHtml . "<li class='hide space'>" . $letter . "</li>";
            } else if(!in_array($letter, $this->selected)){
                $phraseHtml = $phraseHtml . "<li class='hide letter " . $letter . "'>" . $letter . "</li>";
            } else {
                $phraseHtml = $phraseHtml . "<li class='show letter " . $letter . "'>" . $letter . "</li>";
            }
        }
        $phraseHtml = $phraseHtml . "</ul></div>";
        return $phraseHtml;
    }

    /**
     * --Tested
     * check if a letter is in the phrase
     * @param $letter -> letter to check
     * @return bool -> true => match; false => not match
     */
    public function checkLetter($letter): bool
    {
        // check match
        foreach (array_map('strtolower', str_split($this->currentPhrase)) as $character){
            if(strtolower($letter) == $character){
                return true;
            }
        }
        return false;
    }
}