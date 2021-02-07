<?php

namespace Differ\Differ\Parsers;

use function Differ\Differ\Parsers\parserFabric;
use function Differ\Differ\Parsers\buildAst;

function parser(string $pathToFile1, string $pathToFile2)
{
    $data1 = parserFabric($pathToFile1);
    $data2 = parserFabric($pathToFile2);

    return buildAst($data1, $data2);
}
