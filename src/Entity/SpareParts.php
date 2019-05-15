<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SparePartsRepository")
 */
class SpareParts
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tech", inversedBy="spareParts")
     * @var Collection
     */
    private $techs;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SparePartsImage", mappedBy="spare")
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->techs = new ArrayCollection();
        $timeZone = new \DateTimeZone('Europe/Moscow');
        $this->created = new \DateTime('now', $timeZone);
        $this->updated = new \DateTime('now', $timeZone);
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * @return Collection|SparePartsImage[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(SparePartsImage $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setTech($this);
        }

        return $this;
    }

    public function removeImage(SparePartsImage $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getTech() === $this) {
                $image->setTech(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return Collection
     */
    public function getTechs(): Collection
    {
        return $this->techs;
    }

    /**
     * @param Collection $techs
     */
    public function setTechs(Collection $techs): void
    {
        $this->techs = $techs;
    }

}
