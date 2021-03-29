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

    /** @var string */
    private $addonValue;

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
    public function setBalls(ArrayCollection $balls): self
    {
        $this->balls = $balls;
        return $this;
    }

    /**
     * @param Ball $ball
     */
    public function addBall(Ball $ball): void
    {
        $this->balls->add($ball);
    }

    /**
     * @param string $addValue
     * @return $this
     */
    public function setAddonValue(string $addonValue): self
    {
        $this->addonValue = $addonValue;
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

    /**
     * @return string
     */
    public function getAddonValue(): string
    {
        return $this->addonValue;
    }
}