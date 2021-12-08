<?php
use PHPUnit\Framework\TestCase;

final class AppConfigTest extends TestCase
{

    public function testAllowDebugBarIsNotEmptyConfig()
    {
        $this->assertNotEmpty(config()->get('app.allow_debugbar_for_client'), 'configuration allow debugbar for client should not be empty');
    }

    public function testAllowDebugBarIsAnArray()
    {
        $this->assertIsArray(config()->get('app.allow_debugbar_for_client'), 'allow debugbar for client value must be an array');
    }

    public function testShowDebugbarConfigIsBool()
    {
        $this->assertIsBool(config()->get('app.show_debugbar'), 'show debugbar config must be a boolean');
    }

    public function testOrmPathIsCorrect()
    {
        $this->assertEquals(module('app')->getBaseDir('Model/Orm/mapping'), config()->get('app.data.orm.paths')[0], 'orm entity path is wrong');
    }
}
