<?php

namespace Tur4000\Differ\Parsers;

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

function mergeObjects(\stdClass $data1, \stdClass $data2): \stdClass
{
    $merged = clone $data1;
    foreach ($data2 as $key => $value) {
        $merged->$key = $value;
    }

    return $merged;
}
