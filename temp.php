<?php
/**
 * -- Tested
 * @return string -> html for keyboard according to the keys' state (correct, incorrect, unselected)
 */
public function displayKeyboard()
{
    $firstRow = ["q", "w", "e", "r", "t", "y", "u", "i", "o", "p"];
    $secondRow = ["a", "s", "d", "f", "g", "h", "j", "k", "l"];
    $thirdRow = ["z", "x", "c", "v", "b", "n", "m"];
    $keyboardHtml = "";

    $keyboardHtml = $keyboardHtml . "<div id=\"qwerty\" class=\"section\"><div class='keyrow'>";

    $keyboardHtml = $keyboardHtml . $this->constructKeyRow($firstRow);
    $keyboardHtml = $keyboardHtml . $this->constructKeyRow($secondRow);
    $keyboardHtml = $keyboardHtml . $this->constructKeyRow($thirdRow);

    $keyboardHtml = $keyboardHtml . "</div>";
    return $keyboardHtml;
}

private function constructKeyRow(array $row):string
{
    $html = '';
    $html = $html . "<div class='keyrow'>";
    foreach ($row as $letter){
        if(in_array($letter , array_map('strtolower', $this->phrase->getSelected())) && in_array($letter, array_map("strtolower", str_split($this->phrase->getCurrentPhrase())))){
            $html = $html . "<button type='submit' class='key correct' disabled>$letter</button>";
        }else if(in_array($letter , array_map('strtolower', $this->phrase->getSelected())) && !in_array($letter, array_map("strtolower", str_split($this->phrase->getCurrentPhrase())))){
            $html = $html . "<button type='submit' class='key incorrect' disabled>$letter</button>";
        }else if(!in_array($letter , array_map('strtolower', $this->phrase->getSelected()))){
            $html = $html . "<button class=\"key\">$letter</button>";
        }
    }

    $html = $html . "</div>";
    return $html;
}