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

/**
 * Создание промежуточного представления для сравнения
 *
 * @param \stdClass $data1 первый объект
 * @param \stdClass $data2 второй объект
 *
 * @return \stdClass
 */
function buildAst(\stdClass $data1, \stdClass $data2)
{
    $mergedData = mergeObjects($data1, $data2);
    $ast = [];
    foreach ($mergedData as $key => $value) {
        if (!property_exists($data1, $key)) {
            $ast[$key] = ['status' => 'added',];
            if (\is_object($value)) {
                $ast[$key] += [
                    'type' => 'node',
                    'value' => buildAst($data1->$key, $value),
                ];
            } else {
                $ast[$key] += [
                    'type' => 'value',
                    'value' => $value
                ];
            }
        } elseif (!property_exists($data2, $key)) {
            $ast[$key] = ['status' => 'deleted',];
            if (\is_object($value)) {
                $ast[$key] += [
                    'type' => 'node',
                    'value' => buildAst($data1->$key, $value),
                ];
            } else {
                $ast[$key] += [
                    'type' => 'value',
                    'value' => $value
                ];
            }
        } elseif ($value === $data1->$key) {
            $ast[$key] = [
                'type' => 'value',
                'status' => 'unchanged',
                'value' => $value
            ];
        } elseif ($value !== $data1->$key) {
            $ast[$key] = ['status' => 'modified',];
            if (\is_object($value)) {
                $ast[$key] += [
                    'type' => 'node',
                    'value' => buildAst($data1->$key, $value),
                ];
            } else {
                $ast[$key] += [
                    'type' => 'value',
                    'valueBefore' => $data1->$key,
                    'valueAfter' => $value,
                ];
            }
        }
    }

    ksort($ast);

    return $ast;
}

function genAst(\stdClass $data1, \stdClass $data2)
{
    $keys = uniqKeys($data1, $data2);
    $ast = [];
    foreach ($keys as $key) {
        if (!property_exists($data2, $key)) {
            $ast[$key] = ['type' => 'deleted', 'value' => $data1->$key];
        } elseif (!property_exists($data1, $key)) {
            $ast[$key] = ['type' => 'added', 'value' => $data2->$key];
        } elseif (is_object($data1->$key) && is_object($data2->$key)) {
            $ast[$key] = [
                'type' => 'nested',
                'children' => genAst($data1->$key, $data2->$key),
            ];
        } elseif ($data1->$key === $data2->$key) {
            $ast[$key] = ['type' => 'unchanged', 'value' => $data1->$key];
        } elseif ($data1->$key !== $data2->$key) {
            $ast[$key] = ['type' => 'modified', 'old' => $data1->$key, 'new' => $data2->$key];
        }
    }

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

function uniqKeys(\stdClass $data1, \stdClass $data2): array
{
    $merged = array_merge((array) $data1, (array) $data2);

    $keys = array_keys($merged);
    sort($keys);

    return $keys;
}
