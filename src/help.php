<?php

/**
 * Константы для конфигурирования docopt
 * php version 7.4
 * 
 * @category Library
 * @package  Tur4000\Differ
 * @author   Valeriy Turbanov <tur.4000@gmail.com>
 * @license  MIT
 * @link 
 */
namespace Tur4000\Differ\Help;

const VERSION = "0.0.0";
const DOC = <<<DOC
Generate diff

Usage:
  gendiff (-h|--help)
  gendiff (-v|--version)
  gendiff [--format <fmt>] FIRST_FILE SECOND_FILE

Options:
  -h --help                     Show this screen
  -v --version                  Show version
  --format <fmt>                Report format [default: stylish]

DOC;
