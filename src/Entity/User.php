<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @ApiResource(
 * normalizationContext={"groups"={"users:read"}} ,
 * denormalizationContext={"groups"={"users:write"}},
 *  collectionOperations={
 *      "POST"={
 *              "path"="/users",
 *          "security_post_denormalize"="is_granted('ADD', object)",
 *          "security_message"="Cette tache est reserver au Administrateur"
 *         },
 *     "GET"={
 *    "path"= "/users",
 *    "security"="is_granted('VIEW_ALL', object)",
 *     "security_message"="Cette tache est reserver au Administrateur"
 * 
 *    }},
 * itemOperations={
 *     "GET"={
 *     "path"= "/users/{id}",
 *    "security"="is_granted('VIEW_ALL', object)",
*     "security_message"="Cette tache est reserver au Administrateur"
       
 * },
 *     "PUT"={
 *     "path"= "/users/{id}",
 *    "security"="is_granted('EDIT', object)",
 *     "security_message"="Cette tache est reserver au Administrateur"  
 *      },
 * "DELETE"={
 *     "path"= "/users/{id}",
 *    "security"="is_granted('DEL', object)",
 *     "security_message"="Cette tache est reserver au Administrateur"  
 *      }
 * }
 * 
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     *@Assert\NotBlank
     *@Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $email;

    
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     *  @Groups({"users:read"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     *  @Groups({"users:read"})
     */
    private $telephon;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     *  @Groups({"users:read"})
     */
    private $Adresse;

    /**
     * @ORM\Column(type="blob", nullable=true)
     * @Assert\File(
     *     mimeTypes = {"application/png", "application/jpeg"},
     *     mimeTypesMessage = "Please upload a valid picture"
     *  
     * )
     * @Groups({"users:read"})
     */
    private $avatar;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archiver;

    /**
     * @ORM\ManyToOne(targetEntity=Profile::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"profile:read"})
     */
    private $profile;

    /**
     * @ORM\OneToMany(targetEntity=Depot::class, mappedBy="user")
     */
    private $deposer;

   
    /**
     * @ORM\OneToMany(targetEntity=Transaction::class, mappedBy="user")
     */
    private $transactions;

    /**
     * @ORM\ManyToOne(targetEntity=Agency::class, inversedBy="utilisateur")
     * @Groups({"agency:read", "agency:write"})
     */
    private $agency;

    public function __construct()
    {
        $this->deposer = new ArrayCollection();
        $this->transactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'Role_'.$this->profile->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getTelephon(): ?string
    {
        return $this->telephon;
    }

    public function setTelephon(string $telephon): self
    {
        $this->telephon = $telephon;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getArchiver(): ?bool
    {
        return $this->archiver;
    }

    public function setArchiver(bool $archiver): self
    {
        $this->archiver = $archiver;

        return $this;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(?Profile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * @return Collection|Depot[]
     */
    public function getDeposer(): Collection
    {
        return $this->deposer;
    }

    public function addDeposer(Depot $deposer): self
    {
        if (!$this->deposer->contains($deposer)) {
            $this->deposer[] = $deposer;
            $deposer->setUser($this);
        }

        return $this;
    }

    public function removeDeposer(Depot $deposer): self
    {
        if ($this->deposer->removeElement($deposer)) {
            // set the owning side to null (unless already changed)
            if ($deposer->getUser() === $this) {
                $deposer->setUser(null);
            }
        }

        return $this;
    }

   

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions[] = $transaction;
            $transaction->setUser($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getUser() === $this) {
                $transaction->setUser(null);
            }
        }

        return $this;
    }

    public function getAgency(): ?Agency
    {
        return $this->agency;
    }

    public function setAgency(?Agency $agency): self
    {
        $this->agency = $agency;

        return $this;
    }
}
