<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DepotRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=DepotRepository::class)
 */
class Depot
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
    private $dateDepot;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $montantDepot;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="deposer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="depots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compteCibler;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDepot(): ?string
    {
        return $this->dateDepot;
    }

    public function setDateDepot(string $dateDepot): self
    {
        $this->dateDepot = $dateDepot;

        return $this;
    }

    public function getMontantDepot(): ?string
    {
        return $this->montantDepot;
    }

    public function setMontantDepot(string $montantDepot): self
    {
        $this->montantDepot = $montantDepot;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCompteCibler(): ?Account
    {
        return $this->compteCibler;
    }

    public function setCompteCibler(?Account $compteCibler): self
    {
        $this->compteCibler = $compteCibler;

        return $this;
    }
}
