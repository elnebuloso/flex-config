# flex-config

[![Software License](https://img.shields.io/packagist/l/elnebuloso/bundler.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/elnebuloso/bundler/master.svg?style=flat-square)](https://travis-ci.org/elnebuloso/bundler)

## Requirements

The following versions of PHP are supported by this version.

- PHP 5.3
- PHP 5.4
- PHP 5.5
- PHP 5.6
- HHVM

## Installation / Usage

Via Composer

``` json
{
    "require": {
        "elnebuloso/flex-config": "~2.0"
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