<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Compte;

/**
 * @Route("/api/compte")
 */
class CompteController extends AbstractController
{
    /**
     * @Route("/inserer", name="inserer", methods={"POST", "GET"})
     */
    public function inserer(Request $request, EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());
        if(isset($values->numComp,$values->montant)) {
            $compte = new Compte();
            $compte->setNom($values->nom)
                   ->setCodeBank($values->codeBank)
                   ->setNumComp($values->numComp)
                   ->setIban($values->iban)
                   ->setBic($values->bic)
                   ->setMontant($values->montant);
            $entityManager->persist($compte);
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
