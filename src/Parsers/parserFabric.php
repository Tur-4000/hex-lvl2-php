<?php

/**
 * Парсер файлов json и yaml
 * php version 7.4
 *
 * @category Library
 * @package  Differ\Differ
 * @author   Valeriy Turbanov <tur.4000@gmail.com>
 * @license  https://github.com/Tur-4000/hex-lvl2-php/LICENSE MIT
 * @link     https://github.com/Tur-4000/hex-lvl2-php
 */

namespace Differ\Differ\Parsers;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

function parserFabric(string $pathToFile)
{
    $fileType = getFileType($pathToFile);
    $data = file_get_contents($pathToFile);

    if ($fileType === '.json') {
        $parsedData = jsonParse($data);
    } elseif ($fileType === '.yaml') {
        $parsedData = yamlParse($data);
    } else {
        die("Udefined file format: {$fileType}\n");
    }

    return $parsedData;
}

function getFileType(string $pathToFile): string
{
    $fileType = substr($pathToFile, strrpos($pathToFile, '.'));

    return strtolower($fileType);
}

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

function yamlParse(string $yaml)
{
    try {
        $parsedData = Yaml::parse($yaml, Yaml::PARSE_OBJECT_FOR_MAP);
        // $parsedData = Yaml::parse($yaml);

        return $parsedData;
    } catch (ParseException $exception) {
        die("Unable to parse the YAML string: {$exception->getMessage()}");
        // printf('Unable to parse the YAML string: %s', $exception->getMessage());
    }
}
