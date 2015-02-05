<?php
namespace Flex;

use ArrayObject;
use Exception;
use Zend\Config\Config;

/**
 * Class Registry
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class ConfigManager extends ArrayObject {

    /**
     * @var string
     */
    private static $environment = null;

    /**
     * @var string
     */
    private static $directory = null;

    /**
     * @var ConfigManager
     */
    private static $manager = null;

    /**
     * @param string $environment
     */
    public static function setEnvironment($environment) {
        self::$environment = $environment;
    }

    /**
     * @param string $directory
     * @throws Exception
     */
    public static function setDirectory($directory) {
        self::$directory = realpath($directory);

        if(self::$directory === false) {
            throw new Exception("invalid directory {$directory}");
        }
    }

    /**
     * @return ConfigManager
     */
    public static function getInstance() {
        if(self::$manager === null) {
            self::$manager = new self();
        }

        return self::$manager;
    }

    /**
     * @param string $key
     * @return Config
     * @throws Exception
     */
    public static function get($key) {
        $instance = self::getInstance();

        if($instance->offsetExists($key)) {
            return $instance->offsetGet($key);
        }

        $baseConfigFile = self::$directory . '/' . $key . '.php';
        $environmentConfigFile = self::$directory . '/' . $key . '.' . self::$environment . '.php';

        if(!file_exists($baseConfigFile)) {
            throw new Exception("missing configuration for key {$key}");
        }

        /** @noinspection PhpIncludeInspection */
        $config = new Config(include $baseConfigFile);

        // optional environment configuration
        if(!empty(self::$environment) && !file_exists($environmentConfigFile)) {
            throw new Exception("missing environment configuration for key {$key} and environment " . self::$environment);
        }

        if(!empty(self::$environment)) {
            /** @noinspection PhpIncludeInspection */
            $config->merge(new Config(include $environmentConfigFile));
        }

        $instance->offsetSet($key, $config);

        return $config;
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function isRegistered($key) {
        if(self::$manager === null) {
            return false;
        }

        return self::$manager->offsetExists($key);
    }

    /**
     * @return void
     */
    public static function unsetInstance() {
        self::$manager = null;
    }

    /**
     * workaround for http://bugs.php.net/bug.php?id=40442
     *
     * @param string $key
     * @return bool
     */
    public function offsetExists($key) {
        return array_key_exists($key, $this);
    }
}