<?php

namespace Differ\Formatters\Plain;

function renderPlain($data, $children = []): string
{
    $filtredData = array_filter($data, fn($item) => $item['status'] !== 'equally');

    $result = array_map(function ($item) use ($children): string {
        $status = $item['status'];
        $path = array_merge($children, [$item['key']]);
        $name = implode('.', $path);
        switch ($status) {
            case 'added':
                $value = stringify($item['value']);
                return "Property '{$name}' was added with value: {$value}";
            case 'deleted':
                return "Property '{$name}' was removed";
            case 'modifed':
                $valueBefore = stringify($item['valueBefore']);
                $valueAfter = stringify($item['valueAfter']);
                return "Property '{$name}' was updated. From {$valueBefore} to {$valueAfter}";
            case 'nested':
                return renderPlain($item['value'], $path);
        }
        return "Unknown data";
    }, $filtredData);

    return implode("\n", $result);
}

function stringify($value): string
{
    if ($value === null) {
        return "null";
    }
    if (is_bool($value)) {
        return $value ? "true" : "false";
    }
    if (is_string($value)) {
        return "'{$value}'";
    }
    if (!is_object($value) && !is_array($value)) {
        return "{$value}";
    }
    return "[complex value]";
}
