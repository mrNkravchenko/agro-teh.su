<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AngarRepository")
 */
class Angar
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $width;

    /**
     * @ORM\Column(type="float")
     */
    private $length;

    /**
     * @ORM\Column(type="float")
     */
    private $square;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Costumer", inversedBy="angars")
     */
    private $costumer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AngarImage", mappedBy="angar")
     */
    private $images;
    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Address", inversedBy="angar")
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AngarCategory", inversedBy="angars")
     */
    private $category;

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

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(float $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(float $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getSquare(): ?float
    {
        return $this->square;
    }

    public function setSquare(float $square): self
    {
        $this->square = $square;

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
    public function getCostumer()
    {
        return $this->costumer;
    }

    /**
     * @param mixed $costumer
     */
    public function setCostumer($costumer): void
    {
        $this->costumer = $costumer;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images): void
    {
        $this->images = $images;
    }

    /**
     * @return mixed
     */
    public function getAddressId()
    {
        return $this->address_id;
    }

    /**
     * @param mixed $address_id
     */
    public function setAddressId($address_id): void
    {
        $this->address_id = $address_id;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }
}
