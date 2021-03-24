<?php

namespace App\Controller;

use App\Manager\DrawManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /** @var DrawManager */
    private $drawManager;

    public function __construct(DrawManager $drawManager)
    {
        $this->drawManager = $drawManager;
    }

    /**
     * Home Page with exercise Draw data from friday 19/03
     * @Route("/")
     * @return Response
     */
    public function __invoke(): Response
    {
        //TODO: Set the date as a parameter, default value with today

        //Setting date to 02-05 to match the requested data of the exercice
        $date = new \DateTime('2021-02-05');
        $draw = $this->drawManager->getDraw($date);

        return $this->render('home/home.html.twig', [
            'draw' => $draw
        ]);
    }
}