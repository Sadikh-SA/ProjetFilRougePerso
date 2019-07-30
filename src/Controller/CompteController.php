<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Compte;

/**
 * @Route("/api")
 */
class CompteController extends AbstractController
{
    /**
     * @Route("/compte/inserer", name="inserer-compte", methods={"POST", "GET"})
     */
    public function inserer(Request $request, EntityManagerInterface $entityManager)
    {
        $values = json_decode($request->getContent());
        if(isset($values->numComp,$values->montant,$values->nom,$values->codeBank,$values->iban,$values->bic)) {
            if ($values->montant>0 && is_numeric($values->montant) && is_numeric($values->codeBank)) {
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
                    'status0' => 201,
                    'message0' => 'Le compte a été créé'
                ];

                return new JsonResponse($data, 201);
            }
            else {
                $data = [
                    'status' => 400,
                    'message' => 'Le montant doit être positif et est un double donc numérique'
                ];
                return new JsonResponse($data, 400);
            }
        }
        else {
            $data = [
                'status' => 500,
                'message' => 'Vous devez Renseignez tous les champs'
            ];
            return new JsonResponse($data, 500);
        }
        
    }

}
