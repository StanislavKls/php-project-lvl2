<?php

namespace Differ\Render;

use function Differ\Formatters\Stylish\renderStylish;
use function Differ\Formatters\Plain\renderPlain;
use function Differ\Formatters\Json\renderToJson;

function render($data, $format)
{
    switch ($format) {
        case 'stylish':
            return renderStylish($data);
        case 'plain':
            return renderPlain($data);
        case 'json':
            return renderToJson($data);
    }
}
