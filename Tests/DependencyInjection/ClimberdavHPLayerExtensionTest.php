<?php

namespace Climberdav\HPLayerBundle\Tests\DependencyInjection;

use Climberdav\HPLayerBundle\DependencyInjection\ClimberdavHPLayerExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Yaml;

class ClimberdavHPLayerExtensionTest extends TestCase
{
    /**
     * @dataProvider provideConfiguration
     *
     * @param string $rootNode
     * @param array $config
     * @param array $expected
     */
    public function testConfiguration($rootNode, $config, $expected)
    {
        $builder = new ContainerBuilder();
        $ext = new ClimberdavHPLayerExtension();
        $ext->load($config, $builder);
        foreach ($expected[$rootNode] as $key => $value) {
            $this->assertEquals($value, $builder->getParameter($rootNode . '.' . $key));
        }
    }
    public function provideConfiguration()
    {
        $rootNode = 'climberdav_hp_layer';
        $dir = __DIR__ . '/configuration_set/';
        $configFiles = glob($dir . 'config_*.yml');
        $resultFiles = glob($dir . 'result_*.yml');
        sort($configFiles);
        sort($resultFiles);
        $tests = array();
        foreach ($configFiles as $k => $file) {
            $config = Yaml::parse(file_get_contents($file));
            $expected = Yaml::parse(file_get_contents($resultFiles[$k]));
            $tests[] = array($rootNode, $config, $expected);
        }
        return $tests;
    }
}