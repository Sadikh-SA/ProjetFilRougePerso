<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Utilisateur;


class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager, UserPasswordEncoderInterface $passwordEncoder)
    {
            $user = new Utilisateur();
                $user->setLogin("Sadikh");
                $user->setPassword($passwordEncoder->encodePassword($user, "Moimeme"));
                $user->setPrenom("Ababacar Sadikh");
                $user->setNom("GUEYE");
                $user->setEmail("abougueye96@yahoo.fr");
                $user->setTel(784408822);
                $user->setProfil("Super-Admin");
                if ($user->getProfil()=="Super-Admin") {
                    $user->setRoles(['ROLE_Super-Admin']);
                }elseif ($user->getProfil()=="Admin-Partenaire") {
                    $user->setRoles(['ROLE_Admin-Partenaire']);
                }elseif ($user->getProfil()=="Utilisateur") {
                    $user->setRoles(['ROLE_Utilisateur']);
                }
                $user->setStatus("Actif");
                $manager->persist($user);
        $manager->flush();
    }
}
