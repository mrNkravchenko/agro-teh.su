<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AngarCategoryRepository")
 */
class AngarCategory
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
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $small_image;

    /**
     * @Assert\Image(mimeTypes={ "image/jpg", "image/jpeg", "image/gif", "image/png" })
     */
    private $image_bin;

    /**
     * @Assert\Image(mimeTypes={ "image/jpg", "image/jpeg", "image/gif", "image/png" })
     */
    private $small_image_bin;
    /**
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Angar", mappedBy="category")
     */
    private $angars;

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

    /**
     * @return mixed
     */
    public function getSmallImage()
    {
        return $this->small_image;
    }

    /**
     * @param mixed $small_image
     */
    public function setSmallImage($small_image): void
    {
        $this->small_image = $small_image;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getAngars()
    {
        return $this->angars;
    }

    /**
     * @param mixed $angars
     */
    public function setAngars($angars): void
    {
        $this->angars = $angars;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
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
}
