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
            "username" : "laye1",
            "password" : "laye",
            "nom": "laye",
            "prenom": "laye",
            "email" : "laye@gmail.com",
            "tel" : 784561112,
            "profil" : "Utilisateur",
            "status" : "Actif",
            "idParte" : 3
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
            "username" : "200896",
            "password" : "200896",
            "nom": ,
            "prenom": "Ibrahima",
            "email" : "guizzo@gmail.com",
            "tel" : 704125763,
            "profil" : "Utilisateur",
            "status" : "Actif",
            "idParte" : 3
        }');
        $rep = $client->getResponse();
        $this->assertSame(400,$client->getResponse()->getStatusCode());
    }
}
