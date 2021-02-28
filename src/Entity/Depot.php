<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DepotRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 
 * @ORM\Entity(repositoryClass=DepotRepository::class)
 * @ApiResource(
 *  * normalizationContext={"groups"={"depot:read"}} ,
 * denormalizationContext={"groups"={"depot:write"}},
 *  collectionOperations={
 *           "POST"={
 *                     "path"="/admin/depots",
 *                      "deserializationContext" = false
 *             
 *                },
 *         "GET"={
 *                    "path"= "/admin/depots",
 *    
 * 
 *             }},
 *   itemOperations={
 *              "GET"={
 *                     "path"= "/admin/depots/{id}"
 *    
       
 *                 },
 *             "PUT"={
 *                    "path"= "/admin/depots/{id}"
 *    
 *                  },
 *           "DELETE"={
 *                        "path"= "/admin/depots/{id}"
 *    
 *                    }
 * }
 * )
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
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"depot:read","depot:write"})
     */
    private $dateDepot;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"depot:read","depot:write"})
     * @Assert\NotBlank
     */
    private $montantDepot;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="deposer")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"users:read"})
     * @ApiSubresource()
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="depots")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"account:read","account:write"})
     * @ApiSubresource()
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
