<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use function dump;
use function implode;
use function is_array;
use function is_object;
use function is_string;
use function json_decode;
use function parseArgs;
use function PHPSTORM_META\type;
use function strval;
use Symfony\Component\Validator\Constraints as Assert;
use function var_dump;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TechRepository")
 */
class Tech
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TechCategory", inversedBy="techs")
     *
     */
    private $category;



    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $small_image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mng_image;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $short_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $short_description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $manual;

    /**
     * @ORM\Column(type="text")
     */
    private $performance;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Complectation", mappedBy="tech")
     */
    private $complectation;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Dimensions", mappedBy="tech")
     */
    private $dimentions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TechImage", mappedBy="tech")
     */
    private $slider;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="tech")
     */
    private $video;

    /**
     *@ORM\OneToMany(targetEntity="App\Entity\TechFeedback", mappedBy="tech")
     */
    private $feedback;


    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

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
    public function getManual()
    {
        return $this->manual;
    }

    /**
     * @param mixed $manual
     */
    public function setManual($manual): void
    {
        $this->manual = $manual;
    }




    public function getId(): ?int
    {
        return $this->id;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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



    public function setContent(?string $content): self
    {
        $this->content = $content;

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
    public function getMngImage()
    {
        return $this->mng_image;
    }

    /**
     * @param mixed $mng_image
     */
    public function setMngImage($mng_image): void
    {
        $this->mng_image = $mng_image;
    }

    /**
     * @return mixed
     */
    public function getShortName()
    {
        return $this->short_name;
    }

    /**
     * @param mixed $short_name
     */
    public function setShortName($short_name): void
    {
        $this->short_name = $short_name;
    }

    /**
     * @return Collection|TechImage[]
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

    /**
     * @return mixed
     */
    public function getPerformance()
    {
        return $this->performance;
    }

    /**
     * @param mixed $performance
     */
    public function setPerformance($performance): void
    {
        $this->performance = $performance;
    }


    /**
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param mixed $video
     */
    public function setVideo($video): void
    {
        $this->video = $video;
    }

    /**
     * @return mixed
     */
    public function getParcePerformance()
    {
        return json_decode($this->getPerformance(), true);
    }

    public function getToStringPerformance()
    {
        $performanceArr = json_decode($this->getPerformance());
        $performanceString ='';
        foreach ($performanceArr as $row){
            if (is_array($row)) {
                $row = implode(':', $row);
                $performanceString .= $row.';';
            }
            elseif(is_object($row)) {
                foreach ($row as $prop => $value) {
                    $performanceString .= $prop .' : '.$value.';';
                }
            }


        }
        return ($performanceString);
    }

    /**
     * @return mixed
     */
    public function getComplectation()
    {
        return $this->complectation;
    }

    /**
     * @param mixed $complectation
     */
    public function setComplectation($complectation): void
    {
        $this->complectation = $complectation;
    }

    /**
     * @return mixed
     */
    public function getShortDescription()
    {
        return $this->short_description;
    }

    /**
     * @param mixed $short_description
     */
    public function setShortDescription($short_description): void
    {
        $this->short_description = $short_description;
    }

    /**
     * @return mixed
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * @param mixed $feedback
     */
    public function setFeedback($feedback): void
    {
        $this->feedback = $feedback;
    }

    public function __toString()
    {
        return (string) $this->name;
    }

    /**
     * @return mixed
     */
    public function getDimentions()
    {
        return $this->dimentions;
    }

    /**
     * @param mixed $dimentions
     */
    public function setDimentions($dimentions): void
    {
        $this->dimentions = $dimentions;
    }


}
