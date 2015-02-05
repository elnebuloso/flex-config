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

* Return Zend\Config for PHP Array Configurations with optional merging of environment Configuration
* The Key represents the Configuration File
* e.g. foo = foo.php under directory
* e.g. foo = foo.staging.php for staging environment (will optionally be merged onto main configuration)

``` php
ConfigManager::setDirectory('configs');
ConfigManager::get('app');
```

``` php
ConfigManager::setDirectory('configs');
ConfigManager::setEnvironment('staging');
ConfigManager::get('app');
```