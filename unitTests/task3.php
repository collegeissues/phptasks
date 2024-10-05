<?php

function ceasarCipher($text, $key)
{
    $result = "";
    $upperAlphabet = 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ';  // Заглавные буквы
    $lowerAlphabet = 'абвгдеёжзийклмнопрстуфхцчшщъыьэюя';  // Строчные буквы

    $upperLength = mb_strlen($upperAlphabet);
    $lowerLength = mb_strlen($lowerAlphabet);

    for ($i = 0; $i < mb_strlen($text); $i++) {
        $char = mb_substr($text, $i, 1);  // Получаем текущий символ

        // Если символ - заглавная буква
        if (mb_strpos($upperAlphabet, $char) !== false) {
            $index = mb_strpos($upperAlphabet, $char);
            $newIndex = ($index + $key) % $upperLength;
            if ($newIndex < 0) {
                $newIndex += $upperLength;  // Коррекция для отрицательных значений
            }
            $result .= mb_substr($upperAlphabet, $newIndex, 1);
        }
        // Если символ - строчная буква
        elseif (mb_strpos($lowerAlphabet, $char) !== false) {
            $index = mb_strpos($lowerAlphabet, $char);
            $newIndex = ($index + $key) % $lowerLength;
            if ($newIndex < 0) {
                $newIndex += $lowerLength;  // Коррекция для отрицательных значений
            }
            $result .= mb_substr($lowerAlphabet, $newIndex, 1);
        }
        // Если символ не является буквой
        else {
            $result .= $char;
        }
    }

    return $result;
}