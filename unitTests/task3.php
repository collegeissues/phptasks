<?php

function ceasarCipher($text, $key)
{
    $result = "";
    $upperAlphabet = 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ';
    $lowerAlphabet = 'абвгдеёжзийклмнопрстуфхцчшщъыьэюя';

    $upperLength = mb_strlen($upperAlphabet);
    $lowerLength = mb_strlen($lowerAlphabet);

    for ($i = 0; $i < mb_strlen($text); $i++) {
        $char = mb_substr($text, $i, 1);  // Определяем текущий символ

        if (mb_strpos($upperAlphabet, $char) !== false) {
            $index = mb_strpos($upperAlphabet, $char);
            $newIndex = ($index + $key) % $upperLength;
            if ($newIndex < 0) {
                $newIndex += $upperLength;
            }
            $result .= mb_substr($upperAlphabet, $newIndex, 1);
        } elseif (mb_strpos($lowerAlphabet, $char) !== false) {
            $index = mb_strpos($lowerAlphabet, $char);
            $newIndex = ($index + $key) % $lowerLength;
            if ($newIndex < 0) {
                $newIndex += $lowerLength;
            }
            $result .= mb_substr($lowerAlphabet, $newIndex, 1);
        } else {
            // Если это не буква, просто добавляем символ как есть
            $result .= $char;
        }
    }

    return $result;
}