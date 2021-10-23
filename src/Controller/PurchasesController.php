<?php

namespace App\Controller;

use App\Entity\Person;
use App\Entity\Purchases;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    #[Route('/purchases/check', name: 'purchase_check', methods: ['POST'])]
    public function purchaseCheck(Request $request): Response
    {
        $order      = $request->get('ordering');
        $person     = $request->get('id');
        $data       = $this->em->getRepository(Purchases::class)->findByPersonAndOrder($person, $order);

        $response = [
            'item'  => $data[0]->getItem(),
            'image' => $data[0]->getImagePath(),
            'about' => $data[0]->getText()
        ];




//        $name = $request->get('name');
//        $person = $this->em->getRepository(Person::class)->find($name);
        return new JsonResponse($response);
    }

    #[Route('/purchases/{name}', name: 'purchases')]
    public function index(Request $request): Response
    {
        $name               = $request->get('name');
        $person             = $this->em->getRepository(Person::class)->findOneBy(['slug' => $name]);

        if (empty($person)) {
            // stop cheating. That person doesn't exist in the system.
            return $this->redirectToRoute('home');
        }
        $earningsPerSecond  = $person->getEarningsPerSecond() / 100;
        // so we know whether to load an image or show the default avatar

        $imagePath = 'build/images/avatar.png';
        if (empty($person->getImagePath())) {
           $person->setImagePath($imagePath);
        }

        return $this->render('purchases/index.html.twig', [
            'person'   => $person,
            'earnings' => number_format($earningsPerSecond,2)
        ]);
    }


}
