[![Actions Status](https://github.com/Tur-4000/php-project-lvl2/workflows/hexlet-check/badge.svg)](https://github.com/Tur-4000/php-project-lvl2/actions)
[![PHP CI](https://github.com/Tur-4000/hex-lvl2-php/workflows/PHP%20CI/badge.svg)](https://github.com/Tur-4000/hex-lvl2-php/actions)
[![Maintainability](https://api.codeclimate.com/v1/badges/5b2377fd8621da38ad0c/maintainability)](https://codeclimate.com/github/Tur-4000/hex-lvl2-php/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/5b2377fd8621da38ad0c/test_coverage)](https://codeclimate.com/github/Tur-4000/hex-lvl2-php/test_coverage)
# GenDiff

Утилита для сравнения двух файлов JSON и YAML.

## Setup

```sh
$ git clone https://github.com/Tur-4000/php-project-lvl2.git

$ make install
```

## Run tests

```sh
$ make test
```

## Usage

```sh
gendiff -h

Generate diff

Usage:
  gendiff (-h|--help)
  gendiff (-v|--version)
  gendiff [--format <fmt>] FIRST_FILE SECOND_FILE

Options:
  -h --help                     Show this screen
  -v --version                  Show version
  --format <fmt>                Report format [default: stylish]
```

[![asciicast](https://asciinema.org/a/388341.svg)](https://asciinema.org/a/388341)
