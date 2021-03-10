<?php

namespace Differ\Render;

use function Differ\Formatters\Stylish\finallyRender;
use function Differ\Formatters\Plain\renderPlain;

function render($data, $format)
{
    switch ($format) {
        case 'stylish':
            return finallyRender($data);
        case 'plain':
            return renderPlain($data);
    }
}
