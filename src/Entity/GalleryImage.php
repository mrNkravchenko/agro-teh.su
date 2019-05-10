<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GalleryImageRepository")
 */
class GalleryImage
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

    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path_thumbnail;

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
