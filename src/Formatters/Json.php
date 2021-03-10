<?php

namespace Differ\Formatters\Json;

function renderToJson($data): string
{
    $result = json_encode($data);
    if ($result !== false) {
        return $result;
    }
}
