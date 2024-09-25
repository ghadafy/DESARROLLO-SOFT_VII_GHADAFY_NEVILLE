<?php

$valores = [1, 3, 6, 9, 0, -5, 2, 10, 9, 13];

$res = array_filter($valores, function ($val) {
    if ($val % 2 == 0) {
        return $val;
    }
}, 0);
print_r($res);
echo "<br>";

$valores2 = [2, 7, 4, 0, 1, 3, 5, 2, 7, 5, 4, 2, 7, 5];
$res2 = array_unique($valores2);
print_r($res2);
