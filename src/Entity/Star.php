<?php

namespace App\Entity;

use App\Entity\Ball;

class Star extends Ball
{
    /**
     * @return string
     */
    public function getType(): string
    {
        return 'special';
    }
}