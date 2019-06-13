<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartnerTechRepository")
 */
class PartnerTech
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @Assert\Image(mimeTypes={ "image/jpg", "image/jpeg", "image/gif", "image/png" })
     */
    private $image_bin;

    /**
     * @Assert\Image(mimeTypes={ "image/jpg", "image/jpeg", "image/gif", "image/png" })
     */
    private $small_image_bin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $small_image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $short_name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $short_description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PartnerTechImage", mappedBy="tech")
     */
    private $slider;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSmallImage(): ?string
    {
        return $this->small_image;
    }

    public function setSmallImage(string $small_image): self
    {
        $this->small_image = $small_image;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->short_name;
    }

    public function setShortName(string $short_name): self
    {
        $this->short_name = $short_name;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(?string $short_description): self
    {
        $this->short_description = $short_description;

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

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageBin()
    {
        return $this->image_bin;
    }

    /**
     * @param mixed $image_bin
     */
    public function setImageBin($image_bin): void
    {
        $this->image_bin = $image_bin;
    }

    /**
     * @return mixed
     */
    public function getSmallImageBin()
    {
        return $this->small_image_bin;
    }

    /**
     * @param mixed $small_image_bin
     */
    public function setSmallImageBin($small_image_bin): void
    {
        $this->small_image_bin = $small_image_bin;
    }

    /**
     * @return mixed
     */
    public function getSlider()
    {
        return $this->slider;
    }

    /**
     * @param mixed $slider
     */
    public function setSlider($slider): void
    {
        $this->slider = $slider;
    }
}
