<?php

namespace Climberdav\HPLayerBundle\Tests\Controller;

use Climberdav\HPLayerBundle\Controller\ServerController;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class ServerControllerTest
 * @package Climberdav\HPLayerBundle\Tests\Controller
 */
class ServerControllerTest extends WebTestCase
{
    public function testUrls()
    {
        $this->loadFixtures(array(
            'Climberdav\HPLayerBundle\Fixtures\ORM\LoadServerData'
        ));
        $client = $this->makeClient();

        $path = $this->getUrl('climberdav_hp_layer_server_index');
        $client->request('GET', $path);
        $this->isSuccessful($client->getResponse());

        $path = $this->getUrl('climberdav_hp_layer_server_edit', ['id' => 1]);
        $client->request('GET', $path);
        $this->isSuccessful($client->getResponse());

        $path = $this->getUrl('climberdav_hp_layer_server_new');
        $client->request('GET', $path);
        $this->isSuccessful($client->getResponse());

        $path = $this->getUrl('climberdav_hp_layer_server_toggle', ['id' => 1]);
        $client->request('GET', $path);
        $this->assertStatusCode(302, $client);
    }

    public function testIndexAction()
    {
        // create records
        $this->loadFixtures(array(
            'Climberdav\HPLayerBundle\Fixtures\ORM\LoadServerData'
        ));
        $client = $this->makeClient();
        $client->request('GET', '/server-hyperplanning');
        $crawler = $client->followRedirect();
        $this->assertStatusCode(200, $client);
        $this->assertEquals(4, $crawler->filter('a[href^="/server-hyperplanning/edit"]')->count());
        $this->assertEquals(4, $crawler->filter('a[href^="/server-hyperplanning/toggle"]')->count());
        $this->assertEquals(4, $crawler->filter('a[href^="/server-hyperplanning/test"]')->count());
        $this->assertEquals(4, $crawler->filter('form[method^="post"]')->count());
        $this->assertEquals(1, $crawler->filter('a[href^="/server-hyperplanning/new"]')->count());
    }

    public function testNewAction()
    {
        // create records
        $this->loadFixtures(array());

        $client = $this->makeClient();
        $crawler = $client->request('GET', '/server-hyperplanning/new');
        $this->assertStatusCode(200, $client);
        $this->assertEquals(1, $crawler->filter('button[id="climberdav_hplayer_bundle_server_form_save"]')->count());
        $form = $crawler->selectButton('climberdav_hplayer_bundle_server_form[save]')->form();
        $form->setValues(array(
            'climberdav_hplayer_bundle_server_form[name]' => "five",
            'climberdav_hplayer_bundle_server_form[ip]' => "10.6.6.6",
            'climberdav_hplayer_bundle_server_form[port]' => "8082",
            'climberdav_hplayer_bundle_server_form[protocol]' => "http",
            'climberdav_hplayer_bundle_server_form[login]' => "testlogin",
            'climberdav_hplayer_bundle_server_form[firstDayOfServer][day]' => "1",
            'climberdav_hplayer_bundle_server_form[firstDayOfServer][month]' => "6",
            'climberdav_hplayer_bundle_server_form[firstDayOfServer][year]' => "2018",
            'climberdav_hplayer_bundle_server_form[password]' => "test",
            'climberdav_hplayer_bundle_server_form[root]' => "testroot",
            'climberdav_hplayer_bundle_server_form[disabled]' => "1",
        ));
        $client->submit($form);
        $this->assertStatusCode(302, $client);
        $crawler = $client->followRedirect();
        $this->assertEquals(1, $crawler->filter('a[href^="/server-hyperplanning/test"]')->count());
        $this->assertEquals("five", trim($crawler->filter('td')->eq(1)->text()));

    }

    public function testEditAction()
    {
        $this->loadFixtures([
            'Climberdav\HPLayerBundle\Fixtures\ORM\LoadServerData'
        ]);

        $client = $this->makeClient();
        $crawler = $client->request('GET', '/server-hyperplanning/edit/1');
        $this->assertEquals(1, $crawler->filter('button[id="climberdav_hplayer_bundle_server_form_save"]')->count());
        $form = $crawler->selectButton('climberdav_hplayer_bundle_server_form[save]')->form();
        $form->get('climberdav_hplayer_bundle_server_form[name]')->setValue('edited one');
        $form->get('climberdav_hplayer_bundle_server_form[password]')->setValue('dfgbdfeb');
        $client->submit($form);
        $this->assertStatusCode(302, $client);
        $crawler = $client->followRedirect();
        $this->assertEquals("edited one", trim($crawler->filter('td')->eq(1)->text()));
    }

    public function testRemove()
    {
        $this->loadFixtures([
            'Climberdav\HPLayerBundle\Fixtures\ORM\LoadServerData'
        ]);
        $client = $this->makeClient();
        $client->request('DELETE', '/server-hyperplanning/1');
        $this->assertEquals(302, $client);
    }

}
