<?php

namespace App\Tests\Factory;

use App\Entity\Number;
use App\Entity\Star;
use App\Factory\BallFactory;
use PHPUnit\Framework\TestCase;

class BallFactoryTest extends TestCase
{
    public function testCreateBall()
    {
        $factory = new BallFactory();

        $ballOne = $factory->createBall([
            'id' => 1,
            'value' => 10,
            'type' => 'number',
            'este_lotery' => 'este',
            'draw_index' => 1,
        ]);

        $ballTwo = $factory->createBall([
            'id' => 2,
            'value' => 20,
            'type' => 'special',
            'este_lotery' => 'este',
            'draw_index' => 1,
        ]);

        $this->assertInstanceOf(Number::class, $ballOne);
        $this->assertInstanceOf(Star::class, $ballTwo);
    }
}