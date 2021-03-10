<?php

namespace Differ\Formatters\Json;

function renderToJson($data)
{
    if (file_put_contents('result.json', json_encode($data))) {
        return "Data is written in 'result.json'";
    }
    return "Error - Data not written to file";
}
