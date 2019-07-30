<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompteControllerTest extends WebTestCase
{
    public function testAjoutCompteOK()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER'=>'Sadikh',
            'PHP_AUTH_PW' =>'Moimeme'
        ]);
        $crawler = $client->request('POST', '/api/compte/inserer',[],[],['CONTENT_TYPE'=>"application/json"],
        '{
            "nom": "Ababacar Asta",
            "codeBank": "AA2019",
            "numComp": "1852489632485",
            "iban": "GMBG-M521-7M85-4DI0 ",
            "bic": "451SD",
            "montant": 450800
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
        $crawler = $client->request('POST', '/api/compte/inserer',[],[],['CONTENT_TYPE'=>"application/json"],
        '{
            "nom": "Ababacar Asta",
            "codeBank": 
            "numComp": "1852489632485",
            "iban": 
            "bic": "451SD",
            "montant": 450800 
        }');
        $rep = $client->getResponse();
        $this->assertSame(400,$client->getResponse()->getStatusCode());
    }
}
