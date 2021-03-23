<?php

namespace App\Manager;

use App\Entity\Draw;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DrawManager
{
    const DRAW_URL = "https://www.fdj.fr/api/service-draws/v1/games/euromillions/draws?include=results&range=0-0";

    /** @var HttpClientInterface */
    private $httpClient;

    /**
     * DrawManager constructor.
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return json
     */
    public function getDrawApi(): json
    {
        return json_decode($this->httpClient->request('GET', self::DRAW_URL)->getContent());
    }

    /**
     * @return Draw
     */
    public function getDraw(): Draw
    {
        $drawApiJson = $this->getDrawApi();
        return $this->manageDrawData($drawApiJson);
    }

    /**
     * @param $drawApiJson
     * @return Draw
     */
    private function manageDrawData($drawApiJson): Draw
    {
        //TODO unserialize into object
    }
}