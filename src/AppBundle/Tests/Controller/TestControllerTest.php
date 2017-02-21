<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestControllerTest extends WebTestCase
{
    public function testTest1()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/test1');
    }

}
