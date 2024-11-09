<?php

function mostRecent($text) 
{
    if (strlen($text) > 1000) {
        return "Text contain over 1000 symbols.";
    }
    $words = str_word_count(strtolower($text), 1);
    $wordsCounts = array_count_values($words);
    arsort($wordsCounts);
    return array_key_first($wordsCounts);
}

// for example
$textOverSymbols = "This is example text, this example contain one same word This is example text, 
this example contain one same word This is example text, this example contain one same word This is example text, this example contain one same word
This is example text, this example";


$textNormalLenght = "This is example text, this example contain one same word";
echo mostRecent($textNormalLenght);