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

use function Differ\Differ\Parsers\buildAst;

/**
 * Парсинг файлов для сравнения и создание промежуточного представления
 *
 * @param string $pathToFile1 путь к первому сравниваемому файлу
 * @param string $pathToFile2 путь ко второму сравниваемому файлу
 *
 * @return array
 */
function parser(string $pathToFile1, string $pathToFile2)
{
    $data1 = parseFile($pathToFile1);
    $data2 = parseFile($pathToFile2);

    return buildAst($data1, $data2);
}

/**
 * Фабрика парсинга файлов yml и json
 *
 * @param string $pathToFile имя файла (полное или относительное)
 *
 * @return \stdClass
 */
function parseFile(string $pathToFile): \stdClass
{
    $rawData = getRawContent($pathToFile);

    $fileType = strtolower(pathinfo($pathToFile, PATHINFO_EXTENSION));

    if ($fileType === 'json') {
        $parsedData = jsonParse($rawData);
    } elseif ($fileType === 'yml' || $fileType === 'yaml') {
        $parsedData = Yaml::parse($rawData, Yaml::PARSE_OBJECT_FOR_MAP);
    } else {
        throw new Exception("Invalid file type: {$fileType}\n");
    }

    return $parsedData;
}

function getRawContent(string $pathToFile): string
{
    $realPath = realpath($pathToFile);

    if (!$realPath) {
        throw new Exception("Can't find the file {$pathToFile}");
    }

    if (empty(pathinfo($realPath, PATHINFO_FILENAME))) {
        throw new Exception("Unknown file name");
    }

    return file_get_contents($realPath);
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
        return $parsedData;
    } else {
        throw new Exception("JSON parse error: " . json_last_error_msg());
    }
}
