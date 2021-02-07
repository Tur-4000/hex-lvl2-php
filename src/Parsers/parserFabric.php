<?php

namespace Differ\Differ\Parsers;

// use function Funct\Strings\endsWith;
use function Differ\Differ\Parsers\jsonParse;
use function Differ\Differ\Parsers\yamlParse;

function parserFabric(string $pathToFile)
{
    $fileType = getFileType($pathToFile);
    $data = file_get_contents($pathToFile);

    // if (endsWith($pathToFile, '.json')) {
    //     $parsedData = jsonParse($data);
    // } elseif (endsWith($pathToFile, '.yaml')) {
    //     $parsedData = yamlParse($data);
    // } else {
    //     die("Udefined file format: {$fileType}\n");
    // }

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
