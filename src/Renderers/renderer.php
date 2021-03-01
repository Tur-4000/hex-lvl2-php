<?php

<<<<<<< HEAD
namespace Differ\Differ\Renderer;
=======
/**
 * Создание текстового представления сравнения файлов
 * php version 7.4
 *
 * @category Library
 * @package  Differ\Differ
 * @author   Valeriy Turbanov <tur.4000@gmail.com>
 * @license  https://github.com/Tur-4000/hex-lvl2-php/LICENSE MIT
 * @link     https://github.com/Tur-4000/hex-lvl2-php
 */
>>>>>>> 97b4acc1545e2e82ebae2097cbffc5f3a8859b25

namespace Differ\Differ\Renderer;

use function Funct\false;
use function Funct\true;
use function Funct\null;

/**
 * Создание текстового представления сравнения файлов
 *
 * @param \stdClass $ast    промежуточное представление для вывода
 * @param string    $format формат вывода
 *
 * @return string
 */
function render(array $ast, string $format = 'stylish'): string
{
    $res = '{' . PHP_EOL;
    foreach ($ast as $key => $value) {
        switch ($value['status']) {
            case 'unchanged':
                $res .= "    {$key}: " . valueToString($value['value']) . PHP_EOL;
                break;
            case 'modified':
                $res .= "  - {$key}: " . valueToString($value['valueBefore']) . PHP_EOL;
                $res .= "  + {$key}: " . valueToString($value['valueAfter']) . PHP_EOL;
                break;
            case 'added':
                $res .= "  + {$key}: " . valueToString($value['value']) . PHP_EOL;
                break;
            case 'deleted':
                $res .= "  - {$key}: " . valueToString($value['value']) . PHP_EOL;
                break;
        }
    }

    $res .= '}';

    return $res;
}

/**
 * Преобразование значения в строку
 *
 * @param mixed $value данные
 *
 * @return string
 */
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
