<?php

namespace Tur4000\Differ\Parsers;

function jsonParse(string $json)
{
    // $parsedData = json_decode($json, true);
    $parsedData = json_decode($json);

    if (json_last_error() === JSON_ERROR_NONE) {
        return (object) $parsedData;
    } else {
        die("JSON: " . json_last_error_msg() . PHP_EOL);
    }
}
