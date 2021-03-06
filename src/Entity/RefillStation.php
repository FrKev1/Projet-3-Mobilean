<?php

namespace App\Entity;

use App\Repository\RefillStationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RefillStationRepository::class)
 */
class RefillStation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank()
     */
    private string $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Positive()
     */
    private ?int $debit;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Choice({"Intérieur", "Extérieur, Les deux"})
     */
    private ?string $installation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Positive()
     */
    private ?int $refillTime;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\Type(type="bool")
     */
    private ?bool $additionalStorage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private ?string $photo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDebit(): ?int
    {
        return $this->debit;
    }

    public function setDebit(?int $debit): self
    {
        $this->debit = $debit;

        return $this;
    }

    public function getInstallation(): ?string
    {
        return $this->installation;
    }

    public function setInstallation(?string $installation): self
    {
        $this->installation = $installation;

        return $this;
    }

    public function getRefillTime(): ?int
    {
        return $this->refillTime;
    }

    public function setRefillTime(?int $refillTime): self
    {
        $this->refillTime = $refillTime;

        return $this;
    }

    public function getAdditionalStorage(): ?bool
    {
        return $this->additionalStorage;
    }

    public function setAdditionalStorage(?bool $additionalStorage): self
    {
        $this->additionalStorage = $additionalStorage;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
}
