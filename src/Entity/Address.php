<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AddressRepository")
 */
class Address
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
    private $region;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $region_index;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $district;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $building;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $zip;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Angar", mappedBy="address")
     */
    private $angar;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Costumer", mappedBy="address")
     */
    private $costumer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coordinate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getRegionIndex(): ?string
    {
        return $this->region_index;
    }

    public function setRegionIndex(string $region_index): self
    {
        $this->region_index = $region_index;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(?string $district): self
    {
        $this->district = $district;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getBuilding(): ?string
    {
        return $this->building;
    }

    public function setBuilding(?string $building): self
    {
        $this->building = $building;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(?string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }

    /**
     * @param mixed $coordinate
     */
    public function setCoordinate($coordinate): void
    {
        $this->coordinate = $coordinate;
    }

    /**
     * @return mixed
     */
    public function getAngar()
    {
        return $this->angar;
    }

    /**
     * @param mixed $angar
     */
    public function setAngar($angar): void
    {
        $this->angar = $angar;
    }

    public function getFullAddress()
    {
        return $this->getRegion() . ' ' . $this->getRegionIndex() . ' ' . $this->getCity() . ' ' . $this->getDistrict() . ' ' . $this->getStreet() . ' ' . $this->getBuilding() . ' ' . $this->getZip();
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
}
