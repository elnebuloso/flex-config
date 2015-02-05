<?php
namespace FlexTest;

use Exception;
use Flex\ConfigManager;

/**
 * Class ConfigManagerTest
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class ConfigManagerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var string
     */
    private $directory;

    /**
     * @return void
     */
    public function setUp() {
        $this->directory = realpath(dirname(__FILE__) . '/../../resources/configs');
    }

    /**
     * @return void
     */
    public function tearDown() {
        ConfigManager::unsetInstance();
    }

    /**
     * @test
     * @expectedException Exception
     * @expectedExceptionMessage invalid directory foo/bar/baz
     */
    public function test_getConfig_invalidDirectory() {
        ConfigManager::setEnvironment(null);
        ConfigManager::setDirectory('foo/bar/baz');
    }

    /**
     * @test
     * @expectedException Exception
     * @expectedExceptionMessage missing configuration for key app
     */
    public function test_getConfig_missingConfig() {
        ConfigManager::setEnvironment(null);
        ConfigManager::setDirectory(null);
        ConfigManager::get('app');
    }

    /**
     * @test
     */
    public function test_getConfig() {
        ConfigManager::setEnvironment(null);
        ConfigManager::setDirectory($this->directory);

        $result = ConfigManager::get('app');
        $this->assertInstanceOf('\\Zend\\Config\\Config', $result);

        $this->assertEquals('bar', $result->get('name'));
        $this->assertEquals('foo', $result->get('username'));
        $this->assertEquals('123', $result->get('password'));

        $this->assertInstanceOf('\\Zend\\Config\\Config', $result->get('server'));
        $this->assertEquals('foo.de', $result->get('server')->get('host'));
        $this->assertEquals(3306, $result->get('server')->get('port'));
    }

    /**
     * @test
     */
    public function test_getConfig_environment_local() {
        ConfigManager::setEnvironment('local');
        ConfigManager::setDirectory($this->directory);

        $result = ConfigManager::get('app');
        $this->assertInstanceOf('\\Zend\\Config\\Config', $result);

        $this->assertEquals('bar', $result->get('name'));
        $this->assertEquals('foo', $result->get('username'));
        $this->assertEquals('456', $result->get('password'));

        $this->assertInstanceOf('\\Zend\\Config\\Config', $result->get('server'));
        $this->assertEquals('dev.foo.de', $result->get('server')->get('host'));
        $this->assertEquals(3306, $result->get('server')->get('port'));
    }

    /**
     * @test
     */
    public function test_getConfig_environment_staging() {
        ConfigManager::setEnvironment('staging');
        ConfigManager::setDirectory($this->directory);

        $result = ConfigManager::get('app');
        $this->assertInstanceOf('\\Zend\\Config\\Config', $result);

        $this->assertEquals('bar', $result->get('name'));
        $this->assertEquals('foo', $result->get('username'));
        $this->assertEquals('789', $result->get('password'));

        $this->assertInstanceOf('\\Zend\\Config\\Config', $result->get('server'));
        $this->assertEquals('staging.foo.de', $result->get('server')->get('host'));
        $this->assertEquals(3306, $result->get('server')->get('port'));
    }

    /**
     * @test
     * @expectedException Exception
     * @expectedExceptionMessage missing environment configuration for key app and environment foo
     */
    public function test_getConfig_environment_missing() {
        ConfigManager::setEnvironment('foo');
        ConfigManager::setDirectory($this->directory);
        ConfigManager::get('app');
    }

    /**
     * @test
     */
    public function test_getConfig_getOnceFromFile() {
        ConfigManager::setEnvironment(null);
        ConfigManager::setDirectory($this->directory);

        $this->assertFalse(ConfigManager::isRegistered('app'));
        ConfigManager::get('app');
        $this->assertTrue(ConfigManager::isRegistered('app'));
        ConfigManager::get('app');
        $this->assertTrue(ConfigManager::isRegistered('app'));
    }
}