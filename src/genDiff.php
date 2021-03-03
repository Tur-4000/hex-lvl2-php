<?php

/**
 * Библиотека сравнения файлов json и yaml
 * php version 7.4
 *
 * @category Library
 * @package  Differ\Differ
 * @author   Valeriy Turbanov <tur.4000@gmail.com>
 * @license  https://github.com/Tur-4000/hex-lvl2-php/LICENSE MIT
 * @link     https://github.com/Tur-4000/hex-lvl2-php
 */

namespace Differ\Differ\GenDiff;

use Exception;
use Symfony\Component\Yaml\Exception\ParseException;

use function Differ\Differ\Parsers\parseFile;
use function Differ\Differ\Parsers\buildAst;
use function Differ\Differ\Renderer\render;

const VERSION = "0.0.0";

/**
 * Generate diff fromm 2 json or yaml files
 *
 * @param string $file1  path to first file
 * @param string $file2  path to second file
 * @param string $format format of output report, default 'stylish'
 *
 * @return string
 */
function genDiff(string $file1, string $file2, string $format = 'stylish'): string
{
    try {
        $data1 = parseFile($file1);
        $data2 = parseFile($file2);
    } catch (ParseException $e) {
        return $e->getMessage();
    } catch (Exception $e) {
        return $e->getMessage();
    }

    $diffAst = buildAst($data1, $data2);

    $diff = render($diffAst, $format);

    return $diff;
}
