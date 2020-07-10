<?php

namespace SafeBoardBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AssociationControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/add');
    }

    public function testGetallassociations()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getAllAssociations');
    }

    public function testGetassociation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getAssociation');
    }

    public function testUpdateassociation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/updateAssociation');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/delete');
    }

}
