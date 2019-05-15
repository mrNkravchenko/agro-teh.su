<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SparePartsImageRepository")
 */
class SparePartsImage
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
    private $name_md5;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path_thumbnail;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SpareParts", inversedBy="images")
     */
    private $spare;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $first;

    /**
     * @Assert\Image(mimeTypes={ "image/jpg", "image/jpeg", "image/gif", "image/png" })
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    public function __construct()
    {
        $timeZone = new \DateTimeZone('Europe/Moscow');
        $this->created = new \DateTime('now', $timeZone);
        $this->updated = new \DateTime('now', $timeZone);
    }

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

    public function getNameMd5(): ?string
    {
        return $this->name_md5;
    }

    public function setNameMd5(string $name_md5): self
    {
        $this->name_md5 = $name_md5;

        return $this;
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

    public function getPathThumbnail(): ?string
    {
        return $this->path_thumbnail;
    }

    public function setPathThumbnail(string $path_thumbnail): self
    {
        $this->path_thumbnail = $path_thumbnail;

        return $this;
    }

    public function getSpare(): ?SpareParts
    {
        return $this->spare;
    }

    public function setSpare(?SpareParts $spare): self
    {
        $this->spare = $spare;

        return $this;
    }

    public function getFirst(): ?bool
    {
        return $this->first;
    }

    public function setFirst(?bool $first): self
    {
        $this->first = $first;

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
