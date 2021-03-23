<?php

namespace App\Entity;

use App\Entity\Ball;

class Number extends Ball
{
    public function getType(): string
    {
        return 'number';
    }
}