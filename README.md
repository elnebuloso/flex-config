# flex-config

![abandoned](https://img.shields.io/badge/project-abandoned-red)

configuration for your environment

## about

- Returns Zend\Config for PHP Array Configurations from Files
- Optional merging of environment specific Configuration
- The Key represents the Configuration File
- e.g. foo = foo.php under directory
- e.g. foo = foo.staging.php for staging environment
- staging configurations will optionally be merged onto main configuration

## examples

``` php
\Flex\ConfigManager::setDirectory('configs');
\Flex\ConfigManager::get('app');
```

``` php
\Flex\ConfigManager::setDirectory('configs');
\Flex\ConfigManager::setEnvironment('staging');
\Flex\ConfigManager::get('app');
```