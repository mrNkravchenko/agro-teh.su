<?php

namespace App\Entity;

use App\Repository\AngarImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AngarImageRepository")
 */
class AngarImage
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
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Angar", inversedBy="images")
     */
    private $angar;

    /**
     * @ORM\Column(type="boolean")
     */
    private $first;

    /**
     * @Assert\Image(mimeTypes={ "image/jpg", "image/jpeg", "image/gif", "image/png" })
     */
    private $image;

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

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->first;
    }

    /**
     * @param mixed $first
     */
    public function setFirst($first): void
    {
        $this->first = $first;
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


    /*public function setFirstImage()
    {
        $firstImage = $this->findOneBy(['first' => true, 'angar' => $this->getAngarId()]);
        if ($firstImage) {
            $firstImage->setFirst(false);
            $this->setFirst(true);
        } else {
            $this->setFirst(true);
        }
    }*/
}
