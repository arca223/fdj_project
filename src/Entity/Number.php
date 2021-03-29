<?php

namespace App\Entity;

use App\Entity\Ball;

class Number extends Ball
{
    /**
     * @return string
     */
    public function getType(): string
    {
        return 'number';
    }
}