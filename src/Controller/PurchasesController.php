<?php

namespace App\Controller;

use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PurchasesController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/purchases/{name}', name: 'purchases')]
    public function index(Request $request): Response
    {
        $name = $request->get('name');
        $person = $this->em->getRepository(Person::class)->find($name);
        return $this->render('purchases/index.html.twig', [
            'person'        => $person,
            'controller_name' => 'PurchasesController',
        ]);
    }
}
