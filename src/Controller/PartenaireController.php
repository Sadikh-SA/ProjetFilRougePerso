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
 * @Route("/api/partenaire")
 */
class PartenaireController extends AbstractController
{

    /**
     * @Route("/inserer", name="inserer", methods={"POST"})
     */

     public function inserer(Request $request, EntityManagerInterface $entityManager)
     {
        $values = json_decode($request->getContent());
        if (isset($values->ninea)) {
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
