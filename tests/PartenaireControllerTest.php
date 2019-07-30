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
            "regCom":"AZERTY",
            "ninea": "77788895222314",
            "localisation": "Keur Massar",
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
            "regCom":"QSDGF",
            "ninea": "7522555MLKSK",
            "localisation": ,
            "domaine": "Numérique",
            "idCompte": 
        }');
        $rep = $client->getResponse();
        $this->assertSame(400,$client->getResponse()->getStatusCode());
    }
}
