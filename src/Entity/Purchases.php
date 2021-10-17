<?php

namespace App\Entity;

use App\Repository\PurchasesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PurchasesRepository::class)
 */
class Purchases
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $item;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="purchases")
     */
    private $person;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ordering;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItem(): ?string
    {
        return $this->item;
    }

    public function setItem(string $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getOrdering(): ?int
    {
        return $this->ordering;
    }

    public function setOrdering(?int $ordering): self
    {
        $this->ordering = $ordering;

        return $this;
    }
}
