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

        $this->assertEquals(200, $response->getStatusCode());
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

    public function testGetDrawOfToday(): void
    {
        $date = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
        // Check if time > 21:30, if so, today's draft is released, otherwise it'll be yesterday
        $testDate = (new \DateTime('now'))->setTime(21, 30);
        if ($date < $testDate) {
            $date->sub(new \DateInterval('P1D'))->setTime(21, 30);
        }
        $draw = (new DrawManager(new CurlHttpClient(), new BallFactory()))->getDraw();

        $this->assertIsObject($draw);
        $this->assertInstanceOf(Draw::class, $draw);
        $this->assertObjectHasAttribute('id', $draw);
        $this->assertObjectHasAttribute('drawnAt', $draw);
        $this->assertEquals($date, $draw->getDrawnAt());
        $this->assertObjectHasAttribute('balls', $draw);
        $this->assertCount(7, $draw->getBalls());
    }
}