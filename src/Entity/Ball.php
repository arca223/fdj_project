<?php

namespace App\Entity;

abstract class Ball
{
    /** @var int $id */
    private $id;

    /** @var int $value */
    private $value;

    /** @var string $esteLotery */
    private $esteLotery;

    /** @var int $drawIndex */
    private $drawIndex;

    /**
     * @param int $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $esteLotery
     */
    public function setEsteLotery(string $esteLotery): self
    {
        $this->esteLotery = $esteLotery;
        return $this;
    }

    /**
     * @param int $drawIndex
     */
    public function setDrawIndex(int $drawIndex): self
    {
        $this->drawIndex = $drawIndex;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getEsteLotery(): string
    {
        return $this->esteLotery;
    }

    /**
     * @return int
     */
    public function getDrawIndex(): int
    {
        return $this->drawIndex;
    }
}