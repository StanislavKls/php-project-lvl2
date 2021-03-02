<?php

use function Differ\Differ\genDiff;

require __DIR__ . '/vendor/autoload.php';

$diff = genDiff("c:\\Users\\oper2\\Desktop\\Projects\\Hexlet\\php-project-lvl2\\file1.json", "file2.json");

print_r($diff);