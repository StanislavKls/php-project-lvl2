<?php

namespace Differ\Core;

use Symfony\Component\Yaml\Yaml;

use function Differ\Parsers\buildDiff;
use function Differ\Render\render;

const STORAGE_DIR = __DIR__ . "/../";

function compareFile(string $file1, string $file2, $format)//: string
{
    $fileForCompare1 = fileToData($file1);
    $fileForCompare2 = fileToData($file2);
    return render(buildDiff($fileForCompare1, $fileForCompare2), $format);
}
function fileToData(string $path)
{
    $file = file_exists(realpath($path)) ? file_get_contents($path) :
                                           file_get_contents(realpath(STORAGE_DIR .  $path));

    if (pathinfo($path)['extension'] === 'json') {
        $file = json_decode($file);
    } elseif (pathinfo($path)['extension'] === 'yaml' || pathinfo($path)['extension'] === 'yml') {
        $file = Yaml::parse($file, Yaml::PARSE_OBJECT_FOR_MAP);
    }
    if ($file === null) {
        throw new \Exception("Data not found");
    }
    return $file;
}
