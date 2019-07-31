<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Entity\Utilisateur;
use App\Entity\Partenaire;

/**
 * @Route("/api")
 */
class UtilisateurController extends AbstractController
{

    
    /**
     * @Route("/utilisateur/inserer", name="inserer-utilisateur", methods={"POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());
        if(isset($values->username,$values->password,$values->prenom,$values->nom,$values->email,$values->tel,$values->profil)) {
            if (is_numeric($values->tel) && strlen($values->tel)==9 && $values->tel>0) {
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
                }else {
                    $data = [
                        'status2' => 405,
                        'message2' => 'Ce profil n\'existe pas c\'est soite Super-Admin ou Admin-Partenaire ou Utilisateur.Il faut respecter la casse'
                    ];
    
                    return new JsonResponse($data, 405);
                }
                $idcompt=$user->setIdParte($this->getDoctrine()->getRepository(Partenaire::class)->find($values->idParte));
                $user->setIdParte($idcompt->getIdParte());
                $user->setStatus("Actif");
                $entityManager->persist($user);
                $entityManager->flush();

                $data = [
                    'status0' => 201,
                    'message0' => 'L\'utilisateur a été créé'
                ];

                return new JsonResponse($data, 201);
            } else {
                $data = [
                    'status1' => 400,
                    'message1' => 'Le numéro de téléphone est un numérique et doit avoir 9 caratères'
                ];

                return new JsonResponse($data, 400);
            }
            
        }
        else {
            $data = [
            'status' => 500,
            'message' => 'Vous devez renseigner les clés username et password'
        ];
        return new JsonResponse($data, 500);
        }
    }

    /**
     * @Route("/utilisateur/status/{id}", name="update", requirements={"id":"\d+"}, methods={"PUT"})
     */
    public function update(Request $request, SerializerInterface $serializer, Utilisateur $user=null, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {
        if ($user==NULL) {
            $data = [
                'status10' => 404,
                'message10' => 'cet utilisateur n\'existe pas dans la base' 
            ];
            return new JsonResponse($data,404);
        } else {
            $actif = "Actif";
            $userModif = $entityManager->getRepository(Utilisateur::class)->find($user->getId());
            if ($user->getStatus()==$actif) {
                $userModif->SetStatus("Bloquer");
            }else {
                $userModif->SetStatus($actif);
            }
            // $errors = $validator->validate($userModif);
            // if(count($errors)) {
            //     $errors = $serializer->serialize($errors, 'json');
            //     return new Response($errors, 500, [
            //         'Content-Type' => 'application/json',
            //         'message' => 'Ce Id n\'existe pas vérifie bien' 
            //     ]);
            // }
            $entityManager->flush();
            $data = [
                'status1' => 200,
                'message1' => 'Le statut de cet utilisateur a bien été mis à jour'
            ];
            return new JsonResponse($data,200);
        }
        

    }

    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login(Request $request)
    {
        $user = $this->getUser();
        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles()
        ]);
    }
}