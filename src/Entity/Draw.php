<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Draw
{
    /** @var int */
    private $id;

    /** @var \DateTime */
    private $drawnAt;

    /** @var bool */
    private $published;

    /** @var ArrayCollection */
    private $balls;

    /**
     * Draw constructor.
     */
    public function __construct()
    {
        $this->balls = new ArrayCollection();
    }

    /**
     * @param int $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param \DateTime $drawnAt
     */
    public function setDrawnAt(\DateTime $drawnAt): self
    {
        $this->drawnAt = $drawnAt;
        return $this;
    }

    /**
     * @param bool $published
     */
    public function setPublished(int $published): self
    {
        $this->published = $published;
        return $this;
    }

    /**
     * @param ArrayCollection $balls
     */
    public function setBalls(ArrayCollection $balls)
    {
        $this->balls = $balls;
    }

    /**
     * @param Ball $ball
     */
    public function addBall(Ball $ball): void
    {
        $this->balls->add($ball);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->$name;
    }
}