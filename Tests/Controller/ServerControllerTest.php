<?php
/**
 * Created by PhpStorm.
 * User: ddessertine
 * Date: 29/05/2018
 * Time: 15:09
 */

namespace Climberdav\HPLayerBundle\Tests\Controller;

use Climberdav\HPLayerBundle\Controller\ServerController;
use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Class ServerControllerTest
 * @package Climberdav\HPLayerBundle\Tests\Controller
 */
class ServerControllerTest extends WebTestCase
{
    public function testIndexAction()
    {
        $this->loadFixtures(array());
        $client = parent::createClient();
        $crawler = $client->request('GET', '/server/new');
        $this->assertEquals(1, $crawler->filter('button[id="server_save"]')->count());
    }

    public function testNewAction()
    {
        // create records
        $this->loadFixtureClass([
            'Climberdav\HPLayerBundle\Fixtures\ORM\LoadServerData'
        ]);

        $client = parent::createClient();
        $crawler = $client->request('GET', '/server/new');
        $this->assertEquals(1, $crawler->filter('button[id="server_save"]')->count());
        $buttonCrawlerNode = $crawler->selectButton('Save');
        $form = $buttonCrawlerNode->form();
        $fixtureSet = array(
            'server[name]' => "five",
            'server[ip]' => "10.6.6.6",
            'server[port]' => "8082",
            'server[protocol]' => "http",
            'server[login]' => "testlogin",
            'server[firstDateOfBase]' => new \DateTime(),
            'server[password]' => "test",
            'server[root]' => "testroot",
            'server[disabled]' => "false",
        );

        $crawler = $client->submit($form);
        $this->assertEquals("wtc", trim($crawler->filter('td')->eq(1)->text()));

    }

    public function testEditAction()
    {
        $this->loadFixtureClass([
            'Climberdav\HPLayerBundle\Fixtures\ORM\LoadServerData'
        ]);

        $client = parent::createClient();
        $crawler = $client->request('GET', '/server/1/edit');
        $this->assertEquals(1, $crawler->filter('button[id="server_save"]')->count());
        $buttonCrawlerNode = $crawler->selectButton('Save');
        $form = $buttonCrawlerNode->form();
        $form->get('server[name]')->setValue('edited one');
        $crawler = $client->submit($form);
        $this->assertEquals("edited one", trim($crawler->filter('td')->eq(1)->text()));
    }
}
