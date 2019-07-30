<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Bundle\DoctrineBundle\Repository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Partenaire;
use App\Entity\Compte;

/**
 * @Route("/api")
 */
class PartenaireController extends AbstractController
{

    /**
     * @Route("/partenaire/inserer", name="inserer-partenaire", methods={"POST"})
     */

     public function inserer(Request $request, EntityManagerInterface $entityManager)
     {
        $values = json_decode($request->getContent());
        if (isset($values->ninea, $values->localisation, $values->domaine, $values->idCompte)) {
            if (is_numeric($values->ninea) && strlen($values->ninea)>7) {
                $partenaire = new Partenaire();
                $partenaire->setRegCom($values->regCom)
                    ->setNinea($values->ninea)
                    ->setLocalisation($values->localisation)
                    ->setDomaine($values->domaine);
                    $idcompt=$partenaire->setIdCompte($this->getDoctrine()->getRepository(Compte::class)->find($values->idCompte));
                    $partenaire->setIdCompte($idcompt->getIdCompte());
                $entityManager->persist($partenaire);
                $entityManager->flush();

                $data = [
                    'status' => 201,
                    'message' => 'Le Partenaire a été créé'
                ];

                return new JsonResponse($data, 201);
            }
            else {
                $data = [
                    'status1' => 400,
                    'message1' => 'NINEA est de type double donc numeric la taille doit supérieur à 7 caractères'
                ];

                return new JsonResponse($data, 400);
            }
            
        }
        else {
            $data = [
                'status' => 500,
                'message' => 'Vous devez renseigner les clés comme NINÉA'
            ];
            return new JsonResponse($data, 500);
        }

     }
}
