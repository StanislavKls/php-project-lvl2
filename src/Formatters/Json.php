<?php

namespace Differ\Formatters\Json;

function renderToJson($data): string
{
    return json_encode($data);
}
