<?php

namespace Differ\Render;

function renderPlane(array $data): string
{
    $sign = ['added' => "+", 'deleted' => "-", 'equally' => " "];

    $arr = array_map(function ($item) use ($sign) {
        if ($item['status'] === 'modifed') {
            $item['valueBefore'] = is_bool($item['valueBefore']) ?
                                    var_export($item['valueBefore'], true) : $item['valueBefore'];
            $item['valueAfter'] = is_bool($item['valueAfter']) ?
                                    var_export($item['valueAfter'], true) : $item['valueAfter'];

            return "  {$sign['deleted']} {$item['key']}: {$item['valueBefore']}\n" .
            "  {$sign['added']} {$item['key']}: {$item['valueAfter']}";
        }
        $item['value'] = is_bool($item['value']) ? var_export($item['value'], true) : $item['value'];
        return "  {$sign[$item['status']]} {$item['key']}: {$item['value']}";
    }, $data);
    return "{\n" . implode("\n", $arr) . "\n}\n";
}
