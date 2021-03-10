<?php

namespace Differ\Parsers;

use function Funct\Collection\union;

function buildDiff($data1, $data2): array
{
    $keys = union(array_keys(get_object_vars($data1)), array_keys(get_object_vars($data2)));
    sort($keys); /* @phpstan-ignore-line */

    return array_map(function ($key) use ($data1, $data2) {
        if (!property_exists($data1, $key)) {
            return [
                'key' => $key,
                'value' => $data2->$key, /* @phpstan-ignore-line */
                'status' => 'added'
            ];
        }
        if (!property_exists($data2, $key)) {
            return [
                'key' => $key,
                'value' => $data1->$key, /* @phpstan-ignore-line */
                'status' => 'deleted'
            ];
        }
        if (is_object($data1->$key) && is_object($data2->$key)) { /* @phpstan-ignore-line */
            return [
                'key' => $key,
                'value' => buildDiff($data1->$key, $data2->$key), /* @phpstan-ignore-line */
                'status' => 'nested'
            ];
        }
        if ($data1->$key !== $data2->$key) { /* @phpstan-ignore-line */
            return [
                    'key' => $key,
                    'valueBefore' => $data1->$key, /* @phpstan-ignore-line */
                    'valueAfter' => $data2->$key, /* @phpstan-ignore-line */
                    'status' => 'modifed'
                ];
        }
        if ($data1->$key === $data2->$key) { /* @phpstan-ignore-line */
            return [
                    'key' => $key,
                    'value' => $data1->$key, /* @phpstan-ignore-line */
                    'status' => 'equally'
                ];
        }
    }, $keys);
}
