<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TechCategoryRepository")
 */
class TechCategory
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $small_image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $side_bar_image;

    /**
     * @Assert\Image(mimeTypes={ "image/jpg", "image/jpeg", "image/gif", "image/png" })
     */
    private $small_image_bin;

    /**
     * @Assert\Image(mimeTypes={ "image/jpg", "image/jpeg", "image/gif", "image/png" })
     */
    private $side_bar_image_bin;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tech", mappedBy="category")
     */
    private $techs;

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
    public function getTechs()
    {
        return $this->techs;
    }

    /**
     * @param mixed $techs
     */
    public function setTechs($techs): void
    {
        $this->techs = $techs;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSideBarImage()
    {
        return $this->side_bar_image;
    }

    /**
     * @param mixed $side_bar_image
     */
    public function setSideBarImage($side_bar_image): void
    {
        $this->side_bar_image = $side_bar_image;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
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
    public function getSideBarImageBin()
    {
        return $this->side_bar_image_bin;
    }

    /**
     * @param mixed $side_bar_image_bin
     */
    public function setSideBarImageBin($side_bar_image_bin): void
    {
        $this->side_bar_image_bin = $side_bar_image_bin;
    }
}
