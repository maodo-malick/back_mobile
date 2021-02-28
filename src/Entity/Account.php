<?php

namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiSubresource;
/**
 * @ORM\Entity(repositoryClass=AccountRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"acccount:read"}} ,
 * denormalizationContext={"groups"={"account:write"}},
 *  collectionOperations={
 *           "POST"={
 *                     "path"="/admin/accounts",
 *                      "deserializationContext" = false
 *             
 *                },
 *         "GET"={
 *                    "path"= "/admin/accounts",
 *    
 * 
 *             }},
 *   itemOperations={
 *              "GET"={
 *                     "path"= "/admin/accounts/{id}"
 *    
       
 *                 },
 *             "PUT"={
 *                    "path"= "/admin/accounts/{id}"
 *    
 *                  },
 *           "DELETE"={
 *                        "path"= "/admin/accounts/{id}"
 *    
 *                    }
 * }
 * )
 */
class Account
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"account:read","account:write"})
     */
    private $NumeroCompte;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"account:read","account:write"})
     */
    private $solde;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"account:read","account:write"})
     */
    private $statut = false;

    /**
     * @ORM\OneToMany(targetEntity=Depot::class, mappedBy="compteCibler")
     */
    private $depots;

    /**
     * @ORM\OneToMany(targetEntity=Transaction::class, mappedBy="account")
     */
    private $transaction;

    /**
     * @ORM\OneToOne(targetEntity=Agency::class, mappedBy="account", cascade={"persist", "remove"})
     */
    private $agency;

    /**
     * @ORM\Column(type="date")
     */
    private $creatAt;

    
    
   

    

    public function __construct()
    {
        $this->depots = new ArrayCollection();
        $this->transaction = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCompte(): ?string
    {
        return $this->NumeroCompte;
    }

    public function setNumeroCompte(string $NumeroCompte): self
    {
        $this->NumeroCompte = $NumeroCompte;

        return $this;
    }

    public function getSolde(): ?string
    {
        return $this->solde;
    }

    public function setSolde(string $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection|Depot[]
     */
    public function getDepots(): Collection
    {
        return $this->depots;
    }

    public function addDepot(Depot $depot): self
    {
        if (!$this->depots->contains($depot)) {
            $this->depots[] = $depot;
            $depot->setCompteCibler($this);
        }

        return $this;
    }

    public function removeDepot(Depot $depot): self
    {
        if ($this->depots->removeElement($depot)) {
            // set the owning side to null (unless already changed)
            if ($depot->getCompteCibler() === $this) {
                $depot->setCompteCibler(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransaction(): Collection
    {
        return $this->transaction;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transaction->contains($transaction)) {
            $this->transaction[] = $transaction;
            $transaction->setAccount($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transaction->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getAccount() === $this) {
                $transaction->setAccount(null);
            }
        }

        return $this;
    }

    public function getAgency(): ?Agency
    {
        return $this->agency;
    }

    public function setAgency(Agency $agency): self
    {
        // set the owning side of the relation if necessary
        if ($agency->getAccount() !== $this) {
            $agency->setAccount($this);
        }

        $this->agency = $agency;

        return $this;
    }

    public function getCreatAt(): ?\DateTimeInterface
    {
        return $this->creatAt;
    }

    public function setCreatAt(\DateTimeInterface $creatAt): self
    {
        $this->creatAt = $creatAt;

        return $this;
    }

   

   

}
