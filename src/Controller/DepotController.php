<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Depot;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Entity\Partenaire;
use Proxies\__CG__\App\Entity\Compte;

/**
 * @Route("/api")
 */
class DepotController extends AbstractController
{
    /**
     * @Route("/depot/inserer", name="depot", methods={"POST"})
     */
    public function inserer(Request $request, EntityManagerInterface $entityManager)
    {
       $values = json_decode($request->getContent());
       if (isset($values->idCompte , $values->idPartenaire)) {
           $depot = new Depot();
           $depot ->setDatedepot(new \DateTime())
                  ->setMontantDepot($values->montantDepot);
                  $idcompte=$depot->setIdCompte($this->getDoctrine()->getRepository(Compte::class)->find($values->idCompte));
                  $depot->setIdCompte($idcompte->getIdCompte());
                  $idparte=$depot->setIdPartenaire($this->getDoctrine()->getRepository(Partenaire::class)->find($values->idPartenaire));
                  $depot->setIdPartenaire($idparte->getIdPartenaire());
                  var_dump($idcompte->getIdCompte()->getMontant());
                  $idcompte->getIdCompte()->setMontant($idcompte->getIdCompte()->getMontant()+$values->montantDepot);
           $entityManager->persist($depot);
           $entityManager->flush();

           $data = [
               'status' => 201,
               'message' => 'Le dépot est fait avec succès'
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
