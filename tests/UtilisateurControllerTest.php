<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Utilisateur;
class UtilisateurControllerTest extends WebTestCase
{
    public function testAjoutUserOK()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER'=>'Sadikh',
            'PHP_AUTH_PW' =>'Moimeme'
        ]);
        $crawler = $client->request('POST', '/api/utilisateur/inserer',[],[],['CONTENT_TYPE'=>"application/json"],
        '{
            "username" : "NDIOUFA",
            "password" : "NDIOUFA",
            "nom": "NDIOUFA",
            "prenom": "Doudou",
            "email" : "ndioufa1@gmail.com",
            "tel" : 765865423,
            "profil" : "Utilisateur",
            "status" : "Actif",
            "idParte" : 4
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
        $crawler = $client->request('POST', '/api/utilisateur/inserer',[],[],['CONTENT_TYPE'=>"application/json"],
        '{
            "username" : "dmg2",
            "password" : "dmg2",
            "nom": ,
            "prenom": "Doudou1",
            "email" : "dmg1@gmail.com",
            "tel" : 774586203,
            "profil" : ,
            "status" : "Actif",
            "idParte" : 4
        }');
        $rep = $client->getResponse();
        $this->assertSame(400,$client->getResponse()->getStatusCode());
    }

    public function testupdateUserOK()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER'=>'Sadikh',
            'PHP_AUTH_PW' =>'Moimeme'
        ]);
        $crawler = $client->request('PUT', '/api/utilisateur/status/4',[],[],['CONTENT_TYPE'=>"application/json"],
        '{
            "status" : "Actif"
        }');
        $rep = $client->getResponse();
        $this->assertSame(200,$client->getResponse()->getStatusCode());
    }

    public function testupdateUserKO()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER'=>'Sadikh',
            'PHP_AUTH_PW' =>'Moimeme'
        ]);
        $crawler = $client->request('PUT', '/api/utilisateur/status/4',[],[],['CONTENT_TYPE'=>"application/json"],
        '{
            "status" :
        }');
        $rep = $client->getResponse();
        $this->assertSame(400,$client->getResponse()->getStatusCode());
    }
}
