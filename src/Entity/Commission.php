<?php

namespace App\Entity;

use App\Repository\CommissionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommissionRepository::class)
 */
class Commission
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
    private $partEtat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartEtat(): ?string
    {
        return $this->partEtat;
    }

    public function setPartEtat(string $partEtat): self
    {
        $this->partEtat = $partEtat;

        return $this;
    }
}
