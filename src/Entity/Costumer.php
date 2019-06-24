<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CostumerRepository")
 */
class Costumer
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
     * @ORM\Column(type="string", length=12)
     */
    private $inn;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contacts;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;
    /**
     *@ORM\OneToMany(targetEntity="App\Entity\Angar", mappedBy="costumer")
     */
    private $angars;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Address", inversedBy="costumer")
     */
    private $address;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getInn(): ?int
    {
        return $this->inn;
    }

    public function setInn(int $inn): self
    {
        $this->inn = $inn;

        return $this;
    }

    public function getContacts(): ?string
    {
        return $this->contacts;
    }

    public function setContacts(?string $contacts): self
    {
        $this->contacts = $contacts;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

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
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }
}
