<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UtilisateurControllerTest extends WebTestCase
{
    public function testAjoutUserOK()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/utilisateur/inserer',[],[],['CONTENT_TYPE'=>"application/json"],
        '{
            "username" : "Saliou",
            "password" : "Saliou",
            "nom": "GNING",
            "prenom": "Saliou",
            "email" : "ngingsaliou@gmail.com",
            "tel" : 781542387,
            "profil" : "Admin-Partenaire",
            "status" : "Actif",
            "idParte" : 3
        }');
        $rep = $client->getResponse();
        $this->assertEquals(201,$rep->getStatusCode());
    }
}
