<?php

namespace Climberdav\HPLayerBundle\Fixtures\ORM;
use Climberdav\HPLayerBundle\Entity\Server;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadServerData
 *
 * @author David Dessertine <dessertine.david@gmail.com>
 * @package Climberdav\HPLayerBundle\Fixtures\ORM
 */
class LoadServerData implements FixtureInterface
{
    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->createServer('one', '10.10.10.10', 'foo', 'vsd65v41d', new\DateTime('2020-01-01'));
        $this->createServer('two', '10.1.1.10', 'bar', 'vsd65v41d', $this->randomDate(), 'new', 8181,'http' , 'true');
        $this->createServer('tree', '192.168.10.10', 'foo', 'vsd65v41d', $this->randomDate(), '16_17');
        $this->createServer('four', '172.17.31.10', 'foo', 'vsd65v41d', $this->randomDate());
    }

    /**
     * @param $name
     * @param $ip
     * @param int $port
     * @param string $root
     * @param $login
     * @param $password
     * @param $date
     * @param bool $disabled
     * @param $protocol
     */
    protected function createServer($name, $ip, $login, $password, $date, $root = 'hpsw',
                                     $port = 8080, $protocol = 'https', $disabled = false)
    {
        $server = new Server();
        $server->setName($name);
        $server->setPort($port);
        $server->setLogin($login);
        $server->setIp($ip);
        $server->setFirstDayOfServer($date);
        $server->setDisabled($disabled);
        $server->setProtocol($protocol);
        $server->setPassword($password);
        $server->setRoot($root);

        $this->manager->persist($server);
        $this->manager->flush();
    }

    /**
     * @return \DateTime
     */
    protected function randomDate()
    {
        $now = new \DateTime();
        $now->modify('- '.rand(1,12).' month');
        return $now;
    }

}