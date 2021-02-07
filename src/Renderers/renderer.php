<?php

namespace Differ\Differ\Renderer;

use function Funct\false;
use function Funct\true;
use function Funct\null;

function render(array $ast, string $format = 'stylish'): string
{
    $result = '{' . PHP_EOL;
    foreach ($ast as $key => $value) {
        switch ($value['status']) {
            case 'unchanged':
                $result .= "    {$key}: " . valueToString($value['value']) . PHP_EOL;
                break;
            case 'modified':
                $result .= "  - {$key}: " . valueToString($value['valueBefore']) . PHP_EOL;
                $result .= "  + {$key}: " . valueToString($value['valueAfter']) . PHP_EOL;
                break;
            case 'added':
                $result .= "  + {$key}: " . valueToString($value['value']) . PHP_EOL;
                break;
            case 'deleted':
                $result .= "  - {$key}: " . valueToString($value['value']) . PHP_EOL;
                break;
        }
    }

    $result .= '}';

    return $result;
}

function valueToString($value): string
{
    if (true($value)) {
        return 'true';
    }

    if (false($value)) {
        return 'false';
    }

    if (null($value)) {
        return 'null';
    }

    if (is_array($value)) {
        return '[' . implode(', ', $value) . ']';
    }

    return "{$value}";
}
