<?php

namespace App\Entity;

use App\Entity\Ball;

class Star extends Ball
{
    public function getType(): string
    {
        return 'special';
    }
}