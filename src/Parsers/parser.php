<?php

namespace Tur4000\Differ\Parsers;

use function Tur4000\Differ\Parsers\parserFabric;
use function Tur4000\Differ\Parsers\buildAst;

function parser(string $pathToFile1, string $pathToFile2)
{
    $data1 = parserFabric($pathToFile1);
    $data2 = parserFabric($pathToFile2);

    return buildAst($data1, $data2);
}
