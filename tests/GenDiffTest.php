<?php

namespace Tur4000\Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Tur4000\Differ\GenDiff\genDiff;

class GenDiffTest extends TestCase
{
    public function testGenDiff()
    {
        $plainExpected = file_get_contents('./tests/fixtures/plainExpected.txt');

        $pathToFile1 = './tests/fixtures/file01.json';
        $pathToFile2 = './tests/fixtures/file02.json';
        $this->assertEquals($plainExpected, genDiff($pathToFile1, $pathToFile2));

        $pathToFile3 = './tests/fixtures/file01.yaml';
        $pathToFile4 = './tests/fixtures/file02.yaml';
        $this->assertEquals($plainExpected, genDiff($pathToFile3, $pathToFile4));

        $pathToFile5 = './tests/fixtures/file01.json';
        $pathToFile6 = './tests/fixtures/file02.yaml';
        $this->assertEquals($plainExpected, genDiff($pathToFile5, $pathToFile6));
    }
}
