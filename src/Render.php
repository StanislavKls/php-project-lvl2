<?php

namespace Differ\Render;

function renderPlane(array $data): string
{
    $sign = ['added' => "+", 'deleted' => "-", 'equally' => " "];

    $arr = array_map(function ($item) use ($sign) {
        if ($item['status'] === 'modifed') {
            return "  {$sign['deleted']} {$item['key']}: {$item['valueBefore']}\n" .
            "  {$sign['added']} {$item['key']}: {$item['valueAfter']}";
        }
        return "  {$sign[$item['status']]} {$item['key']}: {$item['value']}";
    }, $data);
    return "{\n" . implode("\n", $arr) . "\n}\n";
}
