<?php

namespace Differ\Core;

use function Differ\PlaneCompare\makeDataForRender;
use function Differ\Render\renderPlane;

const STORAGE_DIR = __DIR__ . "/../";

function compareFile(string $file1, string $file2): string
{
    $fileForCompare1 = fileToData($file1);
    $fileForCompare2 = fileToData($file2);
    return renderPlane(makeDataForRender($fileForCompare1, $fileForCompare2));
}
function fileToData(string $path): array
{
    $file = file_exists(realpath($path)) ? file_get_contents($path) :
                                           file_get_contents(realpath(STORAGE_DIR .  $path));
    $file = json_decode($file, true);
    if ($file === null) {
        throw new \Exception("Data not found");
    }
    return $file;
}
