<?php

namespace Differ\Formatters\Stylish;

function render(array $data, $deep = 1, $replacer = ' '): string
{
    $sign = ['added' => "+", 'deleted' => "-", 'equally' => " "];
    $space = str_repeat($replacer, $deep * 4);
    $base_space = str_repeat($replacer, ($deep * 4) - 2);

    $arr = array_map(function ($item) use ($sign, $base_space, $deep, $space) {
        $key = $item['key'];

        if ($item['status'] === 'modifed') {
            $valueBefore = stringify($item['valueBefore'], $deep);
            $valueAfter = stringify($item['valueAfter'], $deep);

            return "{$base_space}{$sign['deleted']} {$key}: {$valueBefore}\n" .
            "{$base_space}{$sign['added']} {$key}: {$valueAfter}";
        }

        if ($item['status'] === 'nested') {
            $children  = render($item['value'], $deep + 1);
            return "{$base_space}  $key: {\n{$children}\n{$space}}";
        }
        $value = stringify($item['value'], $deep);
        return "{$base_space}{$sign[$item['status']]} {$key}: {$value}";
    }, $data);
    return implode("\n", $arr);
}

function stringify($value, $deep = 1): mixed
{
    if ($value === null) {
        return "null";
    }
    if (is_bool($value)) {
        return $value ? "true" : "false";
    }

    if (!is_object($value) && !is_array($value)) {
        return $value;
    }

    $keys = array_keys(get_object_vars($value));
    $baseSpace = str_repeat(' ', ($deep + 1) * 4);
    $space = str_repeat(' ', $deep * 4);

    $arr = array_map(function ($key) use ($value, $baseSpace, $deep) {
        $formattedValue = stringify($value->$key, $deep + 1);
        return "{$baseSpace}{$key}: {$formattedValue}";
    }, $keys);

    $str = implode("\n", $arr);

    return "{\n{$str}\n{$space}}";
}

function renderStylish($value): string
{
    $result = render($value);
    return "{\n{$result}\n}";
}
