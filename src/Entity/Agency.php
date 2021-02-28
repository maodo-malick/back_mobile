<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AgencyRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AgencyRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"agence:read"}} ,
 * denormalizationContext={"groups"={"agence:write"}},
 *  collectionOperations={
 *      "POST"={
 *              "path"="/admin/agences",
 *             
 *         },
 *     "GET"={
 *    "path"= "/admin/agences",
 *    
 * 
 *    }},
 * itemOperations={
 *     "GET"={
 *     "path"= "/admin/agences/{id}"
 *    
       
 * },
 *     "PUT"={
 *     "path"= "/admin/agences/{id}"
 *    
 *      },
 * "DELETE"={
 *     "path"= "/admin/agences/{id}"
 *    
 *      }
 * }
 * )
 */
class Agency
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"agence:read","agence:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"agence:read","agence:write"})
     * @Assert\NotBlank
     */
    private $nomAgence;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups({"agence:read","agence:write"})
     * @Assert\NotBlank
     */
    private $adresse;

    /**
     * @ORM\Column(type="boolean")
     *  @Groups({"agence:read", "agence:write"})
     
     */
    private $status = false;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="agency")
     * @Groups({"users:read", "users:write"})
     * @Assert\NotBlank
     */
    private $utilisateur;

    /**
     * @ORM\OneToOne(targetEntity=Account::class, inversedBy="agency", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"account:read","account:write"})
     * ApiSubresource()
     */
    private $account;

    
    
    
    public function __construct()
    {
        $this->employer = new ArrayCollection();
        $this->utilisateur = new ArrayCollection();
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
    public function getUtilisateur(): Collection
    {
        return $this->utilisateur;
    }

    public function addUtilisateur(User $utilisateur): self
    {
        if (!$this->utilisateur->contains($utilisateur)) {
            $this->utilisateur[] = $utilisateur;
            $utilisateur->setAgency($this);
        }

        return $this;
    }

    public function removeUtilisateur(User $utilisateur): self
    {
        if ($this->utilisateur->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getAgency() === $this) {
                $utilisateur->setAgency(null);
            }
        }

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(Account $account): self
    {
        $this->account = $account;

        return $this;
    }

   

   
}
