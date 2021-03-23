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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDrawnAt(): \DateTime
    {
        return $this->drawnAt;
    }

    /**
     * @return int
     */
    public function getPublished(): int
    {
        return $this->published;
    }

    /**
     * @return ArrayCollection
     */
    public function getBalls(): ArrayCollection
    {
        return $this->balls;
    }
}