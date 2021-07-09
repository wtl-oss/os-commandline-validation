# PHPCoverageBadge

PHPCoverageBadge is a library for creating an SVG coverage badge from a PHPUnit Clover XML file.

## Installation

Composer!

`composer require --dev jaschilz/php-coverage-badger`

## Usage

1. Generate [XML Code Coverage](https://phpunit.de/manual/current/en/logging.html#logging.codecoverage.xml) using [PHPUnit](https://phpunit.de/manual/current/en/appendixes.configuration.html#appendixes.configuration.logging)
1. Run `vendor/bin/php-coverage-badger /path/to/clover.xml /path/to/badge/destination.svg`
    * e.g. `vendor/bin/php-coverage-badger build/clover.xml report/coverage.svg`

## Acknowledgements

This library is forked from [Michael Moussa's](https://github.com/ocramius) [php-coverage-checker](https://github.com/michaelmoussa/php-coverage-checker), derived from [Marco Pivetta's](https://github.com/ocramius) post on [CI test coverage checks](https://ocramius.github.io/blog/automated-code-coverage-check-for-github-pull-requests-with-travis/)

Inspiration for generating an SVG badge from coverage results is taken from the [coverage-badge](https://pypi.python.org/pypi/coverage-badge) Python library, derived from the [Shields.io](https://github.com/badges/shields/) project.

