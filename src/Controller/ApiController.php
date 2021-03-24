<?php

namespace App\Controller;

use App\Manager\DrawManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiController
 * @package App\Controller
 * @Route("/api")
 */
class ApiController
{
    /** @var DrawManager */
    private $drawManager;
    public function __construct(DrawManager $drawManager)
    {
        $this->drawManager = $drawManager;
    }

    /**
     * @Route("/draw")
     */
    public function __invoke()
    {
        return new JsonResponse($this->drawManager->getDrawApi()->getContent());
    }
}