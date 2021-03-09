<?php

namespace Differ\Core;

use Symfony\Component\Yaml\Yaml;

use function Differ\Parsers\makeDataForRenderPlaneJSON;
use function Differ\Render\renderPlane;

const STORAGE_DIR = __DIR__ . "/../";

function compareFile(string $file1, string $file2): string
{
    $fileForCompare1 = fileToData($file1);
    $fileForCompare2 = fileToData($file2);
    return renderPlane(makeDataForRenderPlaneJSON($fileForCompare1, $fileForCompare2));
}
function fileToData(string $path): array
{
    $file = file_exists(realpath($path)) ? file_get_contents($path) :
                                           file_get_contents(realpath(STORAGE_DIR .  $path));

    if (pathinfo($path)['extension'] === 'json') {
        $file = json_decode($file, true);
    } elseif (pathinfo($path)['extension'] === 'yaml' || pathinfo($path)['extension'] === 'yml') {
        $file = Yaml::parse($file);
    }
    if ($file === null) {
        throw new \Exception("Data not found");
    }
    return $file;
}
