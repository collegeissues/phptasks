<?php

function arrayUnique($array) 
{
    return array_values(array_unique($array));
}

//for example
$array = [1, 2, 2, 3, 4, 4, 5];
print_r(arrayUnique($array));