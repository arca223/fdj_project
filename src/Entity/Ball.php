<?php

namespace App\Entity;

abstract class Ball
{
    /** @var int $id */
    private $id;

    /** @var int $value */
    private $value;

    /** @var string $esteLottery */
    private $esteLottery;

    /** @var int $drawIndex */
    private $drawIndex;

    public function __get(string $name)
    {
        return $this->$name;
    }

    public function __set(string $name, $value): void
    {
        $this->$name = $value;
    }


}