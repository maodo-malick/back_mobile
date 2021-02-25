<?php

namespace App\Entity;

use App\Repository\AgencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 * @ORM\Entity(repositoryClass=AgencyRepository::class)
 * ApiResource
 */
class Agency
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
    private $nomAgence;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="agency")
     */
    private $employer;

    public function __construct()
    {
        $this->employer = new ArrayCollection();
    }

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAgence(): ?string
    {
        return $this->nomAgence;
    }

    public function setNomAgence(string $nomAgence): self
    {
        $this->nomAgence = $nomAgence;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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

    /**
     * @return Collection|User[]
     */
    public function getEmployer(): Collection
    {
        return $this->employer;
    }

    public function addEmployer(User $employer): self
    {
        if (!$this->employer->contains($employer)) {
            $this->employer[] = $employer;
            $employer->setAgency($this);
        }

        return $this;
    }

    public function removeEmployer(User $employer): self
    {
        if ($this->employer->removeElement($employer)) {
            // set the owning side to null (unless already changed)
            if ($employer->getAgency() === $this) {
                $employer->setAgency(null);
            }
        }

        return $this;
    }

   
}
