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
            "username" : "mbacké1",
            "password" : "Mbacké",
            "nom": "Mbaye",
            "prenom": "Mbacké",
            "email" : "mbackémbaye1@gmail.com",
            "tel" : 777878745,
            "profil" : "Admin-Partenaire",
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
            "username" : "45226",
            "password" : "45226",
            "nom": ,
            "prenom": "Asffez",
            "email" : "ddfssz@gmail.com",
            "tel" : 784561235,
            "profil" : "Utilisateur",
            "status" : "Actif",
            "idParte" : 3
        }');
        $rep = $client->getResponse();
        $this->assertSame(400,$client->getResponse()->getStatusCode());
    }
}
