<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TechImageRepository")
 */
class TechImage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tech", inversedBy="slider")
     * @ORM\JoinColumn(nullable=true)
     */
    private $tech;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_slider;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getTechId(): ?int
    {
        return $this->tech_id;
    }

    public function setTechId(int $tech_id): self
    {
        $this->tech_id = $tech_id;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getIsSlider(): ?bool
    {
        return $this->is_slider;
    }

    public function setIsSlider(?bool $is_slider): self
    {
        $this->is_slider = $is_slider;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTech()
    {
        return $this->tech;
    }

    /**
     * @param mixed $tech
     */
    public function setTech($tech): void
    {
        $this->tech = $tech;
    }
}
