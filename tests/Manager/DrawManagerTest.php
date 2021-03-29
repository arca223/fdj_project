<?php

namespace App\Tests\Manager;

use App\Entity\Draw;
use App\Factory\BallFactory;
use App\Manager\DrawManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\CurlHttpClient;

class DrawManagerTest extends TestCase
{
    public function testGetDrawApi(): void
    {
        $response = (new DrawManager(new CurlHttpClient(), new BallFactory()))->getDrawApi();
        //getting first index, the json is formatted this way
        $content = json_decode($response->getContent(), true)[0];

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('results', $content);
        $this->assertArrayHasKey('addons', $content);
    }

    public function testGetDrawOfFifthOfFebruary(): void
    {
        $date = new \DateTime('2021-02-05T21:30', new \DateTimeZone('Europe/Paris'));

        $draw = (new DrawManager(new CurlHttpClient(), new BallFactory()))->getDraw($date);

        $this->assertIsObject($draw);
        $this->assertInstanceOf(Draw::class, $draw);
        $this->assertObjectHasAttribute('id', $draw);
        $this->assertObjectHasAttribute('drawnAt', $draw);
        $this->assertEquals($date, $draw->getDrawnAt());
        $this->assertObjectHasAttribute('balls', $draw);
        $this->assertCount(7, $draw->getBalls());
    }
}