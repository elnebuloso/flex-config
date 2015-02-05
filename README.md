# flex-config

configuration for your environment

## Requirements

The following versions of PHP are supported by this version.

* PHP 5.3
* PHP 5.4
* PHP 5.5
* PHP 5.6
* HHVM

## Description

* Returns Zend\Config for PHP Array Configurations from Files
* Optional merging of environment specific Configuration
* The Key represents the Configuration File
* e.g. foo = foo.php under directory
* e.g. foo = foo.staging.php for staging environment
* staging configurations will optionally be merged onto main configuration

``` php
\Flex\ConfigManager::setDirectory('configs');
\Flex\ConfigManager::get('app');
```

``` php
\Flex\ConfigManager::setDirectory('configs');
\Flex\ConfigManager::setEnvironment('staging');
\Flex\ConfigManager::get('app');
```