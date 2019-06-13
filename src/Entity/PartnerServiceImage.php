<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartnerServiceImageRepository")
 */
class PartnerServiceImage
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_slider;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PartnerTech", inversedBy="slider")
     * @ORM\JoinColumn(nullable=true)
     */
    private $tech;

    private $image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

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

    public function getIsSlider(): ?bool
    {
        return $this->is_slider;
    }

    public function setIsSlider(?bool $is_slider): self
    {
        $this->is_slider = $is_slider;

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

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }
}