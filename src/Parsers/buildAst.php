<?php

/**
 * Создание промежуточного представления для сравнения файлов
 * php version 7.4
 *
 * @category Library
 * @package  Differ\Differ
 * @author   Valeriy Turbanov <tur.4000@gmail.com>
 * @license  https://github.com/Tur-4000/hex-lvl2-php/LICENSE MIT
 * @link     https://github.com/Tur-4000/hex-lvl2-php
 */

namespace Differ\Differ\Parsers;

/*
function buildAst($data1, $data2)
{
    $mergedData = array_merge($data1, $data2);
    $ast = [];

    foreach ($mergedData as $key => $value) {
        if (!array_key_exists($key, $data1)) {
            $ast[$key] = [
                'status' => 'added',
                'value' => $value
            ];
        } elseif (!array_key_exists($key, $data2)) {
            $ast[$key] = [
                'status' => 'deleted',
                'value' => $value
            ];
        } elseif ($value === $data1[$key]) {
            $ast[$key] = [
                'status' => 'unchanged',
                'value' => $value
            ];
        } elseif ($value !== $data1[$key]) {
            $ast[$key] = [
                'status' => 'modified',
                'valueBefore' => $data1[$key],
                'valueAfter' => $value,
            ];
        }
    }

    ksort($ast);

    return $ast;
}
*/

/*
format
[
    'key' => [
        'status' => 'added|deleted|modified|unchanged',
        'valueBefore' => "scalar|array|object",
        'valueAfter' => "scalar|array|object"
    ]
]
// property_exists()
*/

/**
 * Создание промежуточного представления для сравнения
 *
 * @param \stdClass
 * @param \stdClass
 *
 * @return \stdClass
 */
function buildAst($data1, $data2)
{
    $mergedData = mergeObjects($data1, $data2);
    $ast = [];
    foreach ($mergedData as $key => $value) {
        if (!property_exists($data1, $key)) {
            $ast[$key] = [
                'status' => 'added',
                'value' => $value
            ];
        } elseif (!property_exists($data2, $key)) {
            $ast[$key] = [
                'status' => 'deleted',
                'value' => $value
            ];
        } elseif ($value === $data1->$key) {
            $ast[$key] = [
                'status' => 'unchanged',
                'value' => $value
            ];
        } elseif ($value !== $data1->$key) {
            $ast[$key] = [
                'status' => 'modified',
                'valueBefore' => $data1->$key,
                'valueAfter' => $value,
            ];
        }
    }

    ksort($ast);

    return $ast;
}

/**
 * Слияние двух обектов:
 * если свойство присутствует в обоих объектах - записывется значение второго объекта
 * в остальных случаях свойства переносятся со своими значениями
 *
 * @param \stdClass $data1 первый объект
 * @param \stdClass $data2 второй объект
 *
 * @return \stdClass
 */
function mergeObjects(\stdClass $data1, \stdClass $data2): \stdClass
{
    $merged = clone $data1;
    foreach ($data2 as $key => $value) {
        $merged->$key = $value;
    }

    return $merged;
}
