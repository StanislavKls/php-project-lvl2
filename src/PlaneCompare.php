<?php

namespace Differ\PlaneCompare;

use function Funct\Collection\union;

function makeDataForRender($data1, $data2)
{
    $keys = union(array_keys($data1), array_keys($data2));
    sort($keys);

    $result = array_map(function($key) use ($data1, $data2) {
        if (!isset($data1[$key])) {
            return [
                'key' => $key,
                'value' => $data2[$key],
                'status' => 'added'
            ];
        }
        if (!isset($data2[$key])) {
            return [
                'key' => $key,
                'value' => $data1[$key],
                'status' => 'deleted'
            ];
        }
        if ($data1[$key] !== $data2[$key]) {
            return [
                    'key' => $key,
                    'valueBefore' => $data1[$key],
                    'valueAfter' => $data2[$key],
                    'status' => 'modifed'
                ];
        }
        if ($data1[$key] === $data2[$key]) {
            return [
                    'key' => $key,
                    'value' => $data1[$key],
                    'status' => 'equally'
                ];
        }
    }, $keys);
    return $result;
}