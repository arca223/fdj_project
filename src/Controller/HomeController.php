<?php

namespace App\Controller;

use App\Manager\DrawManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\ResponseInterface;

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
        // Set Locale to French until translated
        $draw = $this->drawManager->getDraw();

        return $this->render('home/home.html.twig', [
            'draw' => $draw
        ]);
    }
}