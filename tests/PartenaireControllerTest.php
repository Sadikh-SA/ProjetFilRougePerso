<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PartenaireControllerTest extends WebTestCase
{
    public function testAjoutPartenaireOK()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER'=>'Sadikh',
            'PHP_AUTH_PW' =>'Moimeme'
        ]);
        $crawler = $client->request('POST', '/api/partenaire/inserer',[],[],['CONTENT_TYPE'=>"application/json"],
        '{
            "regCom":"MDSJ54",
            "ninea": "78524553685",
            "localisation": "tHIAROYE",
            "domaine": "Numérique",
            "idCompte": 2
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
        $crawler = $client->request('POST', '/api/partenaire/inserer',[],[],['CONTENT_TYPE'=>"application/json"],
        '{
            "regCom":"MCdc54",
            "ninea": "1651124525000",
            "localisation": ,
            "domaine": "Numérique",
            "idCompte": 
        }');
        $rep = $client->getResponse();
        $this->assertSame(400,$client->getResponse()->getStatusCode());
    }
}
