<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;

class PersonneController extends AbstractController
{
    #[Route('/personne', name: 'app_personne')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository= $doctrine->getRepository(Personne::class);
        $personnes = $repository->findAll();

        //dd($personnes);

        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }

    #[Route('/addpersonne', name: 'app_addpersonne')]
    public function addPersonne(ManagerRegistry $doctine): Response
    {

        $personne = new Personne();
        $personne->setFirstname("Jabnoun 2");
        $personne->setName("Amel 2");
        $personne->setAge(30);
        $personne->setJob("Web developper 2");
        $manager = $doctine->getManager();
        $manager->persist($personne);
        $manager->flush();

        //return new Response("Personne ajoutée avec succés ".$personne->getName());

        return $this->render('personne/index.html.twig', [
            'p' => $personne,
        ]);
    }
}
