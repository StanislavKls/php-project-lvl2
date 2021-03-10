<?php

namespace Differ\Core;

use Symfony\Component\Yaml\Yaml;

use function Differ\Parsers\buildDiff;
use function Differ\Render\render;

function compareFile(string $file1, string $file2, string $format): string
{
    $fileForCompare1 = fileToData($file1);
    $fileForCompare2 = fileToData($file2);
    return render(buildDiff($fileForCompare1, $fileForCompare2), $format);
}
function fileToData(string $path): object
{
    $file = file_get_contents(realpath($path)); /* @phpstan-ignore-line */
    $extension = pathinfo($path, PATHINFO_EXTENSION);

    if ($extension === 'json') {
        return json_decode($file); /* @phpstan-ignore-line */
    } elseif ($extension === 'yaml' || $extension === 'yml') {
        return Yaml::parse($file, Yaml::PARSE_OBJECT_FOR_MAP);
    }
}
