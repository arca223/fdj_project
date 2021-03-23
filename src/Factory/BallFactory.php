<?php

namespace App\Factory;

use App\Entity\Ball;
use App\Entity\Number;
use App\Entity\Star;

class BallFactory
{
    /**
     * Create a specific ball of type Number or Star
     * @param array $ballData
     * @return Ball
     */
    public function createBall($ballData): Ball
    {
        // Can add specific data to the diff types
        switch ($ballData['type']) {
            case 'special':
                $ball = new Star();
                break;
            case 'number':
            default:
                $ball = new Number();
                break;
        }

        $ball->setId($ballData['id'])
            ->setValue($ballData['value'])
            ->setEsteLotery($ballData['este_lotery'])
            ->setDrawIndex($ballData['draw_index']);

        return $ball;
    }
}