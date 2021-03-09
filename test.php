<?php

use function Differ\Differ\genDiff;
use Symfony\Component\Yaml\Yaml;
require __DIR__ . './vendor/autoload.php';

$diff = genDiff("file1.json", "file2.json");
//$diff = genDiff("plane_1_yml.yml", "plane_2_yml.yml");
//$diff = Yaml::parse(file_get_contents("plane_1_yml.yml"), Yaml::PARSE_OBJECT_FOR_MAP);
print_r($diff);