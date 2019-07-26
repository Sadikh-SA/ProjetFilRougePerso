<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Utilisateur;
use App\Entity\Partenaire;

/**
 * @Route("/api")
 */
class SecuriteController extends AbstractController
{
    /**
     * @Route("/register", name="register", methods={"POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());
        if(isset($values->username,$values->password)) {
            $user = new Utilisateur();
            $user->setLogin($values->username);
            $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
            $user->setPrenom($values->prenom);
            $user->setNom($values->nom);
            $user->setEmail($values->email);
            $user->setTel($values->tel);
            $user->setProfil($values->profil);
            if ($user->getProfil()=="Super-Admin") {
                $user->setRoles(['ROLE_Super-Admin']);
            }elseif ($user->getProfil()=="Admin-Partenaire") {
                $user->setRoles(['ROLE_Admin-Partenaire']);
            }elseif ($user->getProfil()=="Utilisateur") {
                $user->setRoles(['ROLE_Utilisateur']);
            }
            $idcompt=$user->setIdParte($this->getDoctrine()->getRepository(Partenaire::class)->find($values->idParte));
            $user->setIdParte($idcompt->getIdParte());
            $user->setStatus($values->status);
            $entityManager->persist($user);
            $entityManager->flush();

            $data = [
                'status' => 201,
                'message' => 'L\'utilisateur a été créé'
            ];

            return new JsonResponse($data, 201);
        }
        $data = [
            'status' => 500,
            'message' => 'Vous devez renseigner les clés username et password'
        ];
        return new JsonResponse($data, 500);
    }
}