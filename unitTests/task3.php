<?php

function ceasarCipher($text, $key)
{
    $result = "";
    $upperAlphabet = 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ';
    $lowerAlphabet = 'абвгдеёжзийклмнопрстуфхцчшщъыьэюя';

    $upperLenght = mb_strlen($upperAlphabet);
    $lowerLenght = mb_strlen($lowerAlphabet);

    for ($i = 0; $i < mb_strlen($text); $i++)
    {
        if (mb_strpos($upperAlphabet, $char) !== false)
        {
            $index = mb_strpos($upperAlphabet, $char);
            $newIndex = ($index + $key) % $upperLenght;
            if ($newIndex < 0) 
            {
                $newIndex += $upperLenght;
            }
            $result .= mb_substr($upperAlphabet, $newIndex, 1);
        }
        elseif(mb_strpos($lowerAlphabet, $char) !== false)
        {
            
        }
    }
}

//for example
$text = "Пример текста";
$key = 4;
echo ceasarCipher($text, $key);