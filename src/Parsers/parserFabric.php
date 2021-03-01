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

use Exception;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * Фабрика парсинга файлов
 *
 * @param string $pathToFile имя файла (полное или относительное)
 *
 * @return \stdClass
 */
function parserFabric(string $pathToFile): \stdClass
{
    $fileType = getFileType($pathToFile);
    $data = file_get_contents($pathToFile);

    if ($fileType === '.json') {
        $parsedData = jsonParse($data);
    } elseif ($fileType === '.yaml' || $fileType === '.yml') {
        $parsedData = yamlParse($data);
    } else {
        die("Udefined file format: {$fileType}\n");
    }

    return $parsedData;
}

function parseFile(string $pathToFile)
{
    $realPath = realpath($pathToFile);

    if (!$realPath) {
        throw new Exception("Не могу найти файл {$pathToFile}");
    }

    $fileInfo = pathinfo($realPath);

    if ($fileInfo['filename']) {
        throw new Exception("Неизвестное имя файла");
    }

    $fileType = strtolower($fileInfo['extension']);
    $rawData = file_get_contents($realPath);

    if ($fileType === 'json') {
        $parsedData = jsonParse($rawData);
    } elseif ($fileType === 'yml' || $fileType === 'yaml') {
        $parsedData = yamlParse($rawData);
    } else {
        throw new Exception("Udefined file format: {$fileType}\n");
    }

    return $parsedData;
}

/**
 * Определение типа файла по его расширению
 *
 * @param string $pathToFile имя файла (полное или относительное)
 *
 * @return string
 */
function getFileType(string $pathToFile): string
{
    $fileType = substr($pathToFile, strrpos($pathToFile, '.'));

    return strtolower($fileType);
}

/**
 * Парсинг JSON
 *
 * @param string $json данные в JSON формате
 *
 * @return \stdClass
 */
function jsonParse(string $json): \stdClass
{
    $parsedData = json_decode($json);

    if (json_last_error() === JSON_ERROR_NONE) {
        return (object) $parsedData;
    } else {
        die("JSON: " . json_last_error_msg() . PHP_EOL);
    }
}

/**
 * Парсинг YAML
 *
 * @param string $yaml данные в YAML формате
 *
 * @return \stdClass
 */
function yamlParse(string $yaml): \stdClass
{
    try {
        return Yaml::parse($yaml, Yaml::PARSE_OBJECT_FOR_MAP);
    } catch (ParseException $exception) {
        die("Unable to parse the YAML string: {$exception->getMessage()}");
    }
}
