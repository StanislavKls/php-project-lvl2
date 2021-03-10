<?php

namespace Differ\Differ;

use function Differ\Core\compareFile;

function genDiff($file1, $file2, $format = 'stylish'): string
{
    return compareFile($file1, $file2, $format);
}
