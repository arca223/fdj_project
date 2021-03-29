<?php

namespace App\Manager;

use App\Entity\Draw;
use App\Factory\BallFactory;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class DrawManager
{
    //TODO : Put in env file for security
    private const DRAW_URL = "https://www.fdj.fr/api/service-draws/v1/games/euromillions/draws?include=results,addons&range=0-0";

    /** @var HttpClientInterface */
    private $httpClient;

    /** @var BallFactory */
    private $ballFactory;

    /**
     * DrawManager constructor.
     * @param HttpClientInterface $httpClient
     * @param BallFactory $ballFactory
     */
    public function __construct(HttpClientInterface $httpClient, BallFactory $ballFactory)
    {
        $this->httpClient = $httpClient;
        $this->ballFactory = $ballFactory;
    }

    /**
     * @param \DateTime|null $date
     * @return ResponseInterface
     */
    public function getDrawApi(\DateTime $date = null): ResponseInterface
    {
        $url = $date ? self::DRAW_URL . '&drawn_at=' . $date->format('Y-m-d') : self::DRAW_URL;

        return $this->httpClient->request('GET', $url);
    }

    /**
     * @param \DateTime|null $date
     * @return Draw
     */
    public function getDraw(\DateTime $date = null): Draw
    {
        return $this->manageDrawData($this->getDrawApi($date)->getContent());
    }

    /**
     * @param $drawApiJson
     * @return Draw
     */
    private function manageDrawData($drawApiJson): Draw
    {
        //TODO: unserialize into object

        // Fetch the first object, api returned json is formatted this way
        $drawData = json_decode($drawApiJson, true)[0];

        $draw = (new Draw())
            ->setId($drawData['eid'])
            ->setDrawnAt(new \DateTime($drawData['drawn_at']))
            ->setPublished($drawData['published'])
            ->setAddonValue($drawData['addons'][0]['value']);

        foreach ($drawData['results'] as $result) {
             $draw->addBall($this->ballFactory->createBall($result));
        }

        return $draw;
    }
}