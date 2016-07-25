# flex-config

[![Build Status](https://travis-ci.org/elnebuloso/flex-config.svg?branch=master)](https://travis-ci.org/elnebuloso/flex-config)
[![Coverage Status](https://coveralls.io/repos/github/elnebuloso/flex-config/badge.svg?branch=master)](https://coveralls.io/github/elnebuloso/flex-config?branch=master)
[![Latest Stable Version](https://poser.pugx.org/elnebuloso/flex-config/version)](https://packagist.org/packages/elnebuloso/flex-config)
[![Total Downloads](https://poser.pugx.org/elnebuloso/flex-config/downloads)](https://packagist.org/packages/elnebuloso/flex-config)
[![Latest Unstable Version](https://poser.pugx.org/elnebuloso/flex-config/v/unstable)](//packagist.org/packages/elnebuloso/flex-config)
[![License](https://poser.pugx.org/elnebuloso/flex-config/license)](https://packagist.org/packages/elnebuloso/flex-config)
[![composer.lock available](https://poser.pugx.org/elnebuloso/flex-config/composerlock)](https://packagist.org/packages/elnebuloso/flex-config)

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