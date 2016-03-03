# flex-config

[![Build Status](https://travis-ci.org/elnebuloso/flex-config.svg?branch=master)](https://travis-ci.org/elnebuloso/flex-config)
[![Coverage Status](https://coveralls.io/repos/github/elnebuloso/flex-config/badge.svg?branch=master)](https://coveralls.io/github/elnebuloso/flex-config?branch=master)

## Requirements

The following versions of PHP are supported by this version.

* PHP 5.4
* PHP 5.5
* PHP 5.6
* PHP 7.0
* HHVM

## Coding Standards

Flex follows the standards defined in the PSR-0, PSR-1, PSR-2 and PSR-4 documents.

## Installation / Usage

Via Composer

``` json
{
    "require": {
        "elnebuloso/flex-config": "~3.0"
    }
}
```

## About

- Returns Zend\Config for PHP Array Configurations from Files
- Optional merging of environment specific Configuration
- The Key represents the Configuration File
- e.g. foo = foo.php under directory
- e.g. foo = foo.staging.php for staging environment
- staging configurations will optionally be merged onto main configuration

## Examples

``` php
\Flex\ConfigManager::setDirectory('configs');
\Flex\ConfigManager::get('app');
```

``` php
\Flex\ConfigManager::setDirectory('configs');
\Flex\ConfigManager::setEnvironment('staging');
\Flex\ConfigManager::get('app');
```