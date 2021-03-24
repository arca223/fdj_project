<?php

namespace App\Tests\Manager;

use App\Entity\Draw;
use App\Factory\BallFactory;
use App\Manager\DrawManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Component\HttpClient\MockHttpClient;

class DrawManagerTest extends TestCase
{
    public function testGetDrawApi()
    {
        $response = (new DrawManager(new CurlHttpClient(), new BallFactory()))->getDrawApi();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetDraw()
    {
        $draw = (new DrawManager(new CurlHttpClient(), new BallFactory()))->getDraw();

        $this->assertIsObject($draw);
        $this->assertInstanceOf(Draw::class, $draw);
        $this->assertObjectHasAttribute('id', $draw);
        $this->assertObjectHasAttribute('drawnAt', $draw);
        $date = new \DateTime('2021-03-23T21:30:00+01:00');
        $this->assertEquals($date, $draw->getDrawnAt());
        $this->assertObjectHasAttribute('balls', $draw);
        $this->assertCount(7, $draw->getBalls());

    }
}