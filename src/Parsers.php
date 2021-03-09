<?php

namespace Differ\Parsers;

use function Funct\Collection\union;

function buildDiff($data1, $data2)
{
    $keys = union(array_keys(get_object_vars($data1)), array_keys(get_object_vars($data2)));
    sort($keys);

    return array_map(function ($key) use ($data1, $data2) {
        if (!isset($data1->$key)) {
            return [
                'key' => $key,
                'value' => $data2->$key,
                'status' => 'added'
            ];
        }
        if (!isset($data2->$key)) {
            return [
                'key' => $key,
                'value' => $data1->$key,
                'status' => 'deleted'
            ];
        }
        if (is_object($data1->$key) && is_object($data2->$key)) {
            return [
                'key' => $key,
                'value' => buildDiff($data1->$key, $data2->$key),
                'status' => 'nested'
            ];           
        }
        if ($data1->$key !== $data2->$key) {
            return [
                    'key' => $key,
                    'valueBefore' => $data1->$key,
                    'valueAfter' => $data2->$key,
                    'status' => 'modifed'
                ];
        }
        if ($data1->$key === $data2->$key) {
            return [
                    'key' => $key,
                    'value' => $data1->$key,
                    'status' => 'equally'
                ];
        }
    }, $keys);
}
