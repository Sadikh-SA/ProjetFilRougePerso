<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DepotControllerTest extends WebTestCase
{
    public function testAjoutCompteOK()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER'=>'Sadikh',
            'PHP_AUTH_PW' =>'Moimeme'
        ]);
        $crawler = $client->request('POST', '/api/depot/inserer',[],[],['CONTENT_TYPE'=>"application/json"],
        '{
            "montant":1250000,
            "idCompte": 2,
            "idPartenaire": 9
        }');
        $rep = $client->getResponse();
        $this->assertSame(201,$client->getResponse()->getStatusCode());
    }

    public function testAjoutUserKO()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER'=>'Sadikh',
            'PHP_AUTH_PW' =>'Moimeme'
        ]);
        $crawler = $client->request('POST', '/api/depot/inserer',[],[],['CONTENT_TYPE'=>"application/json"],
        '{
            "montant":"l1250000",
            "idCompte": 
            "idPartenaire": 2
        }');
        $rep = $client->getResponse();
        $this->assertSame(400,$client->getResponse()->getStatusCode());
    }
}
