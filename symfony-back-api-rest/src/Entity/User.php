<?php

namespace App\Entity;

use App\Repository\UserRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource()]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: NoteFrais::class)]
    private Collection $noteFrais;

    public function __construct()
    {
        $this->noteFrais = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * @return Collection<int, NoteFrais>
     */
    public function getNoteFrais(): Collection
    {
        return $this->noteFrais;
    }

    public function addNoteFrai(NoteFrais $noteFrai): static
    {
        if (!$this->noteFrais->contains($noteFrai)) {
            $this->noteFrais->add($noteFrai);
            $noteFrai->setUser($this);
        }

        return $this;
    }

    public function removeNoteFrai(NoteFrais $noteFrai): static
    {
        if ($this->noteFrais->removeElement($noteFrai)) {
            // set the owning side to null (unless already changed)
            if ($noteFrai->getUser() === $this) {
                $noteFrai->setUser(null);
            }
        }

        return $this;
    }
}
