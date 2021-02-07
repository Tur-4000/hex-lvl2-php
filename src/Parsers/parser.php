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

use function Differ\Differ\Parsers\parserFabric;
use function Differ\Differ\Parsers\buildAst;

function parser(string $pathToFile1, string $pathToFile2)
{
    $data1 = parserFabric($pathToFile1);
    $data2 = parserFabric($pathToFile2);

    return buildAst($data1, $data2);
}
