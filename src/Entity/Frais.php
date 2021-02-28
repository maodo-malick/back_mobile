<?php

namespace App\Entity;

use App\Repository\FraisRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FraisRepository::class)
 */
class Frais
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
    private $borneInf;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $borneSup;

   
    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fraisHt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBorneInf(): ?string
    {
        return $this->borneInf;
    }

    public function setBorneInf(string $borneInf): self
    {
        $this->borneInf = $borneInf;

        return $this;
    }

    public function getBorneSup(): ?string
    {
        return $this->borneSup;
    }

    public function setBorneSup(string $borneSup): self
    {
        $this->borneSup = $borneSup;

        return $this;
    }

    

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getFraisHt(): ?string
    {
        return $this->fraisHt;
    }

    public function setFraisHt(string $fraisHt): self
    {
        $this->fraisHt = $fraisHt;

        return $this;
    }
}
