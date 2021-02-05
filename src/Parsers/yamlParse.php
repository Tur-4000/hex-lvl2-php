<?php

namespace Tur4000\Differ\Parsers;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

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
