<?php

namespace App\Manager;

use App\Entity\Draw;
use App\Factory\BallFactory;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class DrawManager
{
    //TODO : Put in env file for security
    const DRAW_URL = "https://www.fdj.fr/api/service-draws/v1/games/euromillions/draws?include=results&range=0-0";

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
     * @return ResponseInterface
     */
    public function getDrawApi(): ResponseInterface
    {
        return $this->httpClient->request('GET', self::DRAW_URL);
    }

    /**
     * @return Draw
     */
    public function getDraw(): Draw
    {
        return $this->manageDrawData($this->getDrawApi()->getContent());
    }

    /**
     * @param $drawApiJson
     * @return Draw
     */
    private function manageDrawData($drawApiJson): Draw
    {
        //TODO: unserialize into object
        //TODO: get a way to fetch a specific draw or render all draws by date
        $drawData = json_decode($drawApiJson, true);

        // Filter the date we want and get the first result of the array returned
        $drawTarget = current(array_filter($drawData, function($data) {
            return $data['drawn_at'] = "2021-03-19T21:30:00+01:00";
        }));

        $draw = (new Draw())
            ->setId($drawTarget['eid'])
            ->setDrawnAt(new \DateTime($drawTarget['drawn_at']))
            ->setPublished($drawTarget['published']);

        foreach ($drawTarget['results'] as $result) {
             $draw->addBall($this->ballFactory->createBall($result));
        }

        return $draw;
    }
}